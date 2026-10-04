@extends('layouts.app')

@section('title', 'Manage Slides')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Homepage Slides</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.slides.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add New Slide
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($slides->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="50">Order</th>
                                        <th width="100">Image</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th width="100">Status</th>
                                        <th width="150">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($slides as $slide)
                                    <tr>
                                        <td>{{ $slide->order }}</td>
                                        <td>
                                            @if($slide->image)
                                                <img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->title }}"
                                                     class="img-thumbnail" style="width: 80px; height: 60px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td>{{ $slide->title ?? 'No Title' }}</td>
                                        <td>{{ Str::limit($slide->description, 50) ?? 'No Description' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $slide->is_active ? 'success' : 'danger' }}">
                                                {{ $slide->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.slides.edit', $slide) }}"
                                                   class="btn btn-sm btn-info" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.slides.toggle-status', $slide) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-{{ $slide->is_active ? 'warning' : 'success' }}"
                                                            title="{{ $slide->is_active ? 'Deactivate' : 'Activate' }}">
                                                        <i class="bi bi-{{ $slide->is_active ? 'eye-slash' : 'eye' }}"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.slides.destroy', $slide) }}"
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this slide?')" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> No slides found.
                            <a href="{{ route('admin.slides.create') }}" class="alert-link">Create your first slide</a>.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
