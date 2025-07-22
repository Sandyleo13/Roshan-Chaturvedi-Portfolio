<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category' => 'nullable|string|max:255',
        'publish_date' => 'nullable|date',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'is_latest' => 'nullable|boolean',

        // Add Meta fields here:
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
        'meta_keywords' => 'nullable|string|max:255',
        'meta_image' => 'nullable|string|max:255',
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('blog_images', 'public');
        $data['image'] = $path;
    }

    // Ensure only one blog is 'latest'
    if ($request->has('is_latest')) {
        \App\Models\Blog::where('is_latest', true)->update(['is_latest' => false]);
        $data['is_latest'] = true;
    } else {
        $data['is_latest'] = false;
    }

    Blog::create($data);

    return redirect()->route('blogs.index')->with('success', 'Blog created.');
}
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

   public function update(Request $request, Blog $blog)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category' => 'nullable|string|max:255',
        'publish_date' => 'nullable|date',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'is_latest' => 'nullable|boolean',

        // Add Meta fields here:
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:255',
        'meta_keywords' => 'nullable|string|max:255',
        'meta_image' => 'nullable|string|max:255',
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('blog_images', 'public');
        $data['image'] = $path;
    }

    // Ensure only one blog is 'latest'
    if ($request->has('is_latest')) {
        \App\Models\Blog::where('id', '!=', $blog->id)->update(['is_latest' => false]);
        $data['is_latest'] = true;
    } else {
        $data['is_latest'] = false;
    }

    $blog->update($data);

    return redirect()->route('blogs.index')->with('success', 'Blog updated.');
}
    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted.');
    }

    public function apiIndex()
    {
        return response()->json(Blog::all());
    }

    public function show($slug)
{
    $blog = Blog::where('slug', $slug)->firstOrFail();
    return response()->json($blog);
}


    public function apiShow($slug)
{
    $blog = Blog::where('slug', $slug)->firstOrFail();
    return response()->json($blog);
}
public function showBySlug($slug)
{
    $blog = Blog::where('slug', $slug)->firstOrFail();
    return response()->json($blog);
}
public function latest()
{
    $blog = \App\Models\Blog::where('is_latest', true)->first();
    if (!$blog) {
        // fallback to most recent by created_at if none marked as latest
        $blog = \App\Models\Blog::orderBy('created_at', 'desc')->first();
        if (!$blog) {
            return response()->json(['error' => 'No blogs found'], 404);
        }
    }
    return response()->json([
        'title' => $blog->title,
        'excerpt' => isset($blog->content) ? substr(strip_tags($blog->content), 0, 180) . '...' : '',
        'category' => $blog->category ?? 'General',
        'readTime' => '5 min read',
        'slug' => $blog->slug,
    ]);
}

}
