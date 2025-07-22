@extends('admin.layouts.master')

@section('content')
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <h4 class="text-primary">Articles</h4>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Articles List</h4>
            <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm">Create New Article</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-dark text-white">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Difficulty</th>
                        <th>Tags</th>
                        <th>Image</th>
                        <th>Publish Date</th>
                        <th>Latest</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->category ?? '-' }}</td>
                                <td>{{ $article->difficulty ?? '-' }}</td>
                                <td>{{ $article->tags ?? '-' }}</td>
                                <td>
                                    @if($article->image)
                                        <img src="{{ asset($article->image) }}" alt="Image" width="80">
                                    @else
                                        No image
                                    @endif
                                </td>
                                <td>{{ $article->publish_date ?? ($article->created_at ? $article->created_at->format('Y-m-d') : '-') }}</td>
                                <td>
                                    @if(isset($article->is_latest) && $article->is_latest)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this article?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9">No articles found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
