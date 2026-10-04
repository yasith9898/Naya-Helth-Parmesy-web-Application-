@extends('layouts.app')

@section('title', 'Create Slide')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create New Slide</h3>
                </div>
                <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                           value="{{ old('title') }}" placeholder="Enter slide title">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order">Order</label>
                                    <input type="number" name="order" id="order" class="form-control"
                                           value="{{ old('order', 0) }}" placeholder="Display order">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"
                                      rows="3" placeholder="Enter slide description">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="button_text">Button Text</label>
                                    <input type="text" name="button_text" id="button_text" class="form-control"
                                           value="{{ old('button_text') }}" placeholder="e.g., Learn More">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="button_link">Button Link</label>
                                    <input type="text" name="button_link" id="button_link" class="form-control"
                                           value="{{ old('button_link') }}" placeholder="e.g., /about">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">Slide Image</label>
                            <div class="custom-file">
                                <input type="file" name="image" id="image" class="form-control" required>
                            </div>
                            <small class="form-text text-muted">Recommended size: 1920x1080px, Max size: 2MB</small>
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create Slide</button>
                        <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

