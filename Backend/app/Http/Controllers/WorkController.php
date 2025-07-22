<?php

namespace App\Http\Controllers;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WorkController extends Controller
{
    public function index()
{
    $works = Work::latest()->get();
    return view('admin.works.index', compact('works'));
}

    public function apiIndex()
    {
        $works = Work::select('id', 'title', 'description', 'image', 'link', 'slug')->get()->map(function ($work) {
            $work->image = $work->image ? asset('storage/' . $work->image) : null;
            return $work;
        });

        return response()->json($works);
    }

    public function showBySlug($slug)
    {
        $work = Work::where('slug', $slug)->firstOrFail();
        $work->image = $work->image ? asset('storage/' . $work->image) : null;

        return response()->json($work);
    }

    public function create()
    {
        return view('admin.works.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('works', 'public');
        }

        $work = new Work($data);
        $work->slug = Str::slug($data['title']) . '-' . uniqid(); // Unique slug
        $work->save();

        return redirect()->route('works.index')->with('success', 'Work created successfully.');
    }

    public function edit(Work $work)
    {
        return view('admin.works.edit', compact('work'));
    }

    public function update(Request $request, Work $work)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($work->image) {
                Storage::disk('public')->delete($work->image);
            }
            $data['image'] = $request->file('image')->store('works', 'public');
        }

        // If title is changed, regenerate slug
        if ($data['title'] !== $work->title) {
            $data['slug'] = Str::slug($data['title']) . '-' . uniqid();
        }

        $work->update($data);

        return redirect()->route('works.index')->with('success', 'Work updated successfully.');
    }

    public function destroy(Work $work)
    {
        if ($work->image) {
            Storage::disk('public')->delete($work->image);
        }

        $work->delete();

        return redirect()->route('works.index')->with('success', 'Work deleted successfully.');
    }

    public function show($id)
    {
        $work = Work::find($id);

        if (!$work) {
            return response()->json(['error' => 'Work not found'], 404);
        }

        $work->image = $work->image ? asset('storage/' . $work->image) : null;

        return response()->json($work);
    }
}
