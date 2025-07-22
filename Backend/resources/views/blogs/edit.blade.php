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
            <form method="POST" action="{{ isset($blog) ? route('blogs.update', $blog->id) : route('blogs.store') }}">
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

                <div class="form-group">
                    <label>Image URL</label>
                    <input type="text" name="image" value="{{ old('image', $blog->image ?? '') }}" class="form-control">
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" name="featured" class="form-check-input" id="featuredCheck" value="1" {{ old('featured', $blog->featured ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="featuredCheck">Featured</label>
                </div>

                <button type="submit" class="btn btn-success">{{ isset($blog) ? 'Update' : 'Save' }} Blog</button>
            </form>
        </div>
    </div>
</div>
@endsection
