@extends('admin.layouts.master')

@section('content')

<style>
#datatable-blogs thead th,
.table#datatable-blogs thead th,
.card .table#datatable-blogs thead th,
div.dataTables_wrapper .table#datatable-blogs thead th,
div.dataTables_wrapper table#datatable-blogs thead th,
.card .table.custom-table thead th,
.custom-table thead th {
    background: #23272b !important;
    color: #fff !important;
    font-weight: bold !important;
    font-size: 1rem !important;
    border-color: #23272b !important;
    text-align: left !important;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    border-bottom: 2px solid #475056;
    letter-spacing: 0.02em;
}
.custom-table th, .custom-table td {
    vertical-align: middle !important;
}
.card .table-responsive {
    box-shadow: 0 6px 24px rgb(30 34 67 / 10%);
}
</style>

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <h4 class="text-primary">Blogs</h4>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Blogs List</h4>
            <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Create New Blog
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable-blogs" class="table custom-table table-striped table-bordered mb-0">
                    <thead>
                        <tr>
                            <th style="width: 48px;">ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Publish Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->category ?? '-' }}</td>
                                <td>
                                    @if($blog->image)
                                        @if(Str::startsWith($blog->image, ['http://', 'https://', '/storage']))
                                            <img src="{{ $blog->image }}" alt="Blog Image" width="70" style="border-radius:6px;">
                                        @else
                                            <img src="{{ asset('storage/'.$blog->image) }}" alt="Blog Image" width="70" style="border-radius:6px;">
                                        @endif
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $blog->publish_date ?? ($blog->created_at ? $blog->created_at->format('Y-m-d') : '-') }}</td>
                                <td>
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this blog?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
