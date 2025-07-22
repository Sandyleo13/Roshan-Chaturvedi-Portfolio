@extends('admin.layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <h4 class="text-primary">Create Article</h4>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">New Article</h4>
                    <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Article Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="content" rows="5" required>{{ old('content') }}</textarea>
                        </div>

                        <div class="form-group form-check mb-3">
                            <input type="checkbox" name="is_latest" value="1" class="form-check-input" id="is_latest" {{ old('is_latest') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_latest">Mark as Latest Insight</label>
                        </div>

                        <div class="form-group">
                            <label for="image">Article Image</label>
                            <input type="file" class="form-control-file" name="image" id="image" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" name="category" id="category" value="{{ old('category') }}">
                        </div>

                        <div class="form-group">
                            <label for="difficulty">Difficulty</label>
                            <input type="text" class="form-control" name="difficulty" id="difficulty" value="{{ old('difficulty') }}">
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags (comma separated)</label>
                            <input type="text" class="form-control" name="tags" id="tags" value="{{ old('tags') }}">
                        </div>

                        <hr class="my-4" />
                        <h5>SEO & Social Meta <small class="text-muted">(optional)</small></h5>

                        <div class="form-group">
                            <label>SEO Title (meta_title)</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="form-control" placeholder="SEO title (overrides article title for search)">
                        </div>
                        <div class="form-group">
                            <label>SEO Description (meta_description)</label>
                            <textarea name="meta_description" class="form-control" rows="2" placeholder="Summary for Google/socials">{{ old('meta_description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords (comma separated)</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" class="form-control" placeholder="e.g. iOS, swift, testing">
                        </div>
                        <div class="form-group">
                            <label>Meta Image URL (optional for SEO/social)</label>
                            <input type="text" name="meta_image" value="{{ old('meta_image') }}" class="form-control" placeholder="eg. /storage/your-meta-image.jpg">
                        </div>

                        <button type="submit" class="btn btn-primary">Create Article</button>
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
