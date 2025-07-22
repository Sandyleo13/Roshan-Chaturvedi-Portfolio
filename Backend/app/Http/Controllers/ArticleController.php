<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
     public function index()
{
    $articles = Article::latest()->get();
    return view('admin.articles.index', compact('articles'));
}



    public function showBySlug($slug)
{
    $article = Article::where('slug', $slug)->first();

    if (!$article) {
        return response()->json(['message' => 'Article not found'], 404);
    }

    return response()->json($article);
}


    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category' => 'nullable|string',
        'difficulty' => 'nullable|string',
        'tags' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_latest' => 'nullable|boolean',
    ]);

    // Generate slug
    $data['slug'] = Str::slug($data['title']);

    // Handle image upload
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/articles'), $imageName);
        $data['image'] = 'uploads/articles/' . $imageName;
    }

    // Ensure only one article is marked as latest
    if ($request->has('is_latest')) {
        \App\Models\Article::where('is_latest', true)->update(['is_latest' => false]);
        $data['is_latest'] = true;
    } else {
        $data['is_latest'] = false;
    }

    Article::create($data);

    return redirect()->route('articles.index')->with('success', 'Article created successfully!');
}


    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

   public function update(Request $request, Article $article)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category' => 'nullable|string',
        'difficulty' => 'nullable|string',
        'tags' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'is_latest' => 'nullable|boolean',
    ]);

    // Regenerate slug only if the title is changed
    if ($data['title'] !== $article->title) {
        $data['slug'] = Str::slug($data['title']);
    }

    // Handle image upload
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads/articles'), $imageName);
        $data['image'] = 'uploads/articles/' . $imageName;
    }

    // Ensure only one article marked as latest
    if ($request->has('is_latest')) {
        \App\Models\Article::where('id', '!=', $article->id)->update(['is_latest' => false]);
        $data['is_latest'] = true;
    } else {
        $data['is_latest'] = false;
    }

    $article->update($data);

    return redirect()->route('articles.index')->with('success', 'Article updated successfully!');
}

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }

    public function apiIndex()
    {
        return response()->json(Article::all());
    }

    public function show(Article $article)
    {
        return response()->json([
            'id' => $article->id,
            'title' => $article->title,
            'body' => $article->content,
            'category' => $article->category ?? 'General',
            'publishDate' => $article->created_at->toDateString(),
            'readTime' => '5 min read',
            'difficulty' => $article->difficulty ?? 'Beginner',
            'views' => 100,
            'likes' => 10,
            'comments' => 2,
            'excerpt' => substr($article->content, 0, 200) . '...',
            'tags' => explode(',', $article->tags ?? ''),
            'image' => $article->image ? asset($article->image) : null,
            'relatedArticles' => [],
            'content' => '<p>' . e($article->content) . '</p>',
        ]);
    }
    public function latest()
{
    $article = \App\Models\Article::where('is_latest', true)->first();
    if (!$article) {
        $article = \App\Models\Article::orderBy('created_at', 'desc')->first();
        if (!$article) {
            return response()->json(['error' => 'No articles found'], 404);
        }
    }
    return response()->json([
        'title' => $article->title,
        'excerpt' => isset($article->content) ? substr(strip_tags($article->content), 0, 200) . '...' : '',
        'category' => $article->category ?? 'General',
        'readTime' => $article->read_time ?? '10 min read',
        'difficulty' => $article->difficulty ?? 'Beginner',
        'slug' => $article->slug,
    ]);
}

}
