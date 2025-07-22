@extends('admin.layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <h4>{{ isset($blog) ? 'Edit' : 'Create' }} Blog</h4>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ isset($blog) ? route('blogs.update', $blog->id) : route('blogs.store') }}" enctype="multipart/form-data">
                @csrf
                @if(isset($blog))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title', $blog->title ?? '') }}" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" class="form-control" rows="5" required>{{ old('content', $blog->content ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Excerpt</label>
                    <textarea name="excerpt" class="form-control" rows="3">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" value="{{ old('category', $blog->category ?? '') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Read Time</label>
                    <input type="text" name="read_time" value="{{ old('read_time', $blog->read_time ?? '') }}" class="form-control">
                </div>

                <div class="form-group">
                    <label>Publish Date</label>
                    <input type="date" name="publish_date" value="{{ old('publish_date', isset($blog->publish_date) ? \Carbon\Carbon::parse($blog->publish_date)->format('Y-m-d') : '') }}" class="form-control">
                </div>

                {{-- Mark as Latest Insight checkbox (replace featured) --}}
                <div class="form-group form-check">
                    <input type="checkbox" name="is_latest" class="form-check-input" id="isLatestCheck" value="1" {{ old('is_latest', $blog->is_latest ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="isLatestCheck">Mark as Latest Insight</label>
                </div>

                {{-- Image Upload Button (placed here, immediately after is_latest) --}}
                <div class="form-group">
                    <label>Upload Image</label>
                    <input type="file" name="image" class="form-control-file" accept="image/*">
                </div>

                <hr class="my-4" />
                <h5>SEO & Social Meta <small class="text-muted">(optional)</small></h5>

                <div class="form-group">
                    <label>SEO Title (meta_title)</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $blog->meta_title ?? '') }}" class="form-control" placeholder="SEO title (overrides blog title for search)">
                </div>
                <div class="form-group">
                    <label>SEO Description (meta_description)</label>
                    <textarea name="meta_description" class="form-control" rows="2" placeholder="Summary for Google/socials">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Meta Keywords (comma separated)</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}" class="form-control" placeholder="e.g. AI, coding, startups">
                </div>
                <div class="form-group">
                    <label>Meta Image URL (optional for SEO/social)</label>
                    <input type="text" name="meta_image" value="{{ old('meta_image', $blog->meta_image ?? '') }}" class="form-control" placeholder="eg. /storage/your-meta-image.jpg">
                </div>

                <button type="submit" class="btn btn-success">{{ isset($blog) ? 'Update' : 'Save' }} Blog</button>
            </form>
        </div>
    </div>
</div>
@endsection
