@extends('admin.layouts.master')

@section('content')

<style>
#datatable-works thead th,
.table#datatable-works thead th,
.card .table#datatable-works thead th,
div.dataTables_wrapper .table#datatable-works thead th,
div.dataTables_wrapper table thead th,
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
/* Add shadow for visual “pop” */
.card .table-responsive {
    box-shadow: 0 6px 24px rgb(30 34 67 / 10%);
}
</style>

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <h4 class="text-primary">Works</h4>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Works List</h4>
            <a href="{{ route('works.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Create New Work
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable-works" class="table custom-table table-striped table-bordered mb-0">
                    <thead>
                        <tr>
                            <th style="width: 48px;">ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($works as $work)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $work->title }}</td>
                                <td>{{ Str::limit($work->description, 50) }}</td>
                                <td>
                                    @if($work->image)
                                        <img src="{{ asset($work->image) }}" alt="Work Image" width="70" style="border-radius:6px;">
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('works.edit', $work->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('works.destroy', $work->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this work?')">
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
