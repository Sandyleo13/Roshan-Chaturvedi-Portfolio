@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Blog</h4>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="form-control" rows="5" required>{{ old('content', $blog->content) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control" value="{{ old('category', $blog->category) }}">
                        </div>

                        <div class="form-group">
                            <label>Publish Date</label>
                            <input type="date" name="publish_date" class="form-control"
                                   value="{{ old('publish_date', $blog->publish_date ? \Carbon\Carbon::parse($blog->publish_date)->format('Y-m-d') : '') }}">
                        </div>

                        <!-- Mark as Latest Insight -->
                        <div class="form-group form-check">
                            <input type="checkbox" name="is_latest" value="1"
                                class="form-check-input"
                                id="isLatestCheck"
                                {{ old('is_latest', $blog->is_latest) ? 'checked' : '' }} />
                            <label class="form-check-label" for="isLatestCheck">Mark as Latest Insight</label>
                        </div>

                        <div class="form-group">
                            <label>Image</label><br>
                            @if ($blog->image)
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Image" class="img-thumbnail mb-2" width="200">
                            @endif
                            <input type="file" name="image" class="form-control-file" accept="image/*">
                        </div>

                        <hr class="my-4" />
                        <h5>SEO & Social Meta <small class="text-muted">(optional)</small></h5>

                        <div class="form-group">
                            <label>SEO Title (meta_title)</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}" class="form-control" placeholder="SEO title (overrides blog title for search)">
                        </div>
                        <div class="form-group">
                            <label>SEO Description (meta_description)</label>
                            <textarea name="meta_description" class="form-control" rows="2" placeholder="Summary for Google/socials">{{ old('meta_description', $blog->meta_description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords (comma separated)</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $blog->meta_keywords) }}" class="form-control" placeholder="e.g. AI, coding, startups">
                        </div>
                        <div class="form-group">
                            <label>Meta Image URL (optional for SEO/social)</label>
                            <input type="text" name="meta_image" value="{{ old('meta_image', $blog->meta_image) }}" class="form-control" placeholder="eg. /storage/your-meta-image.jpg">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Blog</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
