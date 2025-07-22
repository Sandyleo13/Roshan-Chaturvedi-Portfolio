@extends('admin.layouts.master')

@section('title', 'Edit Article')

@section('content')
    <h2>Edit Article</h2>

    <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Title</label>
            <input name="title" class="form-control" value="{{ old('title', $article->title) }}" required>
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="6" required>{{ old('content', $article->content) }}</textarea>
        </div>

        <div class="form-group">
            <label>Category</label>
            <input name="category" class="form-control" value="{{ old('category', $article->category) }}">
        </div>

        <div class="form-group">
            <label>Difficulty</label>
            <input name="difficulty" class="form-control" value="{{ old('difficulty', $article->difficulty) }}">
        </div>

        <div class="form-group">
            <label>Tags</label>
            <input name="tags" class="form-control" value="{{ old('tags', $article->tags) }}">
        </div>

        <div class="form-group">
            <label>Current Image</label><br>
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="image" width="100">
                <br><br>
            @else
                No image uploaded.
            @endif
        </div>

        <div class="form-group">
            <label>New Image</label>
            <input type="file" name="image" class="form-control-file" accept="image/*">
        </div>

        <!-- Mark as Latest Insight Checkbox -->
        <div class="form-group form-check">
            <input type="checkbox" name="is_latest" value="1" class="form-check-input"
                   {{ old('is_latest', $article->is_latest) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_latest">Mark as Latest Insight</label>
        </div>

        <hr class="my-4" />
        <h5>SEO & Social Meta <small class="text-muted">(optional)</small></h5>

        <div class="form-group">
            <label>SEO Title (meta_title)</label>
            <input type="text" name="meta_title" class="form-control"
                   value="{{ old('meta_title', $article->meta_title) }}"
                   placeholder="SEO title (overrides article title for search)">
        </div>

        <div class="form-group">
            <label>SEO Description (meta_description)</label>
            <textarea name="meta_description" class="form-control" rows="2"
                      placeholder="Summary for Google/socials">{{ old('meta_description', $article->meta_description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Meta Keywords (comma separated)</label>
            <input type="text" name="meta_keywords" class="form-control"
                   value="{{ old('meta_keywords', $article->meta_keywords) }}"
                   placeholder="e.g. iOS, Swift, ARKit">
        </div>

        <div class="form-group">
            <label>Meta Image URL (optional for SEO/social)</label>
            <input type="text" name="meta_image" class="form-control"
                   value="{{ old('meta_image', $article->meta_image) }}"
                   placeholder="eg. /storage/your-meta-image.jpg">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
