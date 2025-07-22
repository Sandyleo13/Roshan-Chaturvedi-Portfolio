@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Work</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('works.update', $work->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $work->title) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $work->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="link">View Link (Optional)</label>
                            <input type="url" name="link" class="form-control" value="{{ old('link', $work->link) }}">
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            @if ($work->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $work->image) }}" alt="Image" width="150">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control-file">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Work</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
