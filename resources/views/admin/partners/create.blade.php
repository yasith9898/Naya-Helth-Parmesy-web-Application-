@extends('layouts.app')

@section('title', isset($title) ? $title : 'Create Partner')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($title) ? $title : 'Create Partner' }}</h1>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Partners
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <h4>English</h4>
                        <div class="form-group">
                            <label for="name_en">Name (English) *</label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror"
                                   id="name_en" name="name_en"
                                   value="{{ old('name_en') }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description_en">Description (English)</label>
                            <textarea class="form-control @error('description_en') is-invalid @enderror"
                                      id="description_en" name="description_en" rows="3">{{ old('description_en') }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h4>Spanish</h4>
                        <div class="form-group">
                            <label for="name_es">Name (Spanish) *</label>
                            <input type="text" class="form-control @error('name_es') is-invalid @enderror"
                                   id="name_es" name="name_es"
                                   value="{{ old('name_es') }}" required>
                            @error('name_es')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description_es">Description (Spanish)</label>
                            <textarea class="form-control @error('description_es') is-invalid @enderror"
                                      id="description_es" name="description_es" rows="3">{{ old('description_es') }}</textarea>
                            @error('description_es')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="website_link">Website Link</label>
                            <input type="url" class="form-control @error('website_link') is-invalid @enderror"
                                   id="website_link" name="website_link"
                                   value="{{ old('website_link') }}">
                            @error('website_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="order">Order</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror"
                                   id="order" name="order"
                                   value="{{ old('order', 0) }}" min="0">
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Partner Image</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                           id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Max size: 2MB. Accepted: JPEG, PNG, GIF</small>
                    <div class="mt-2">
                        <img id="imagePreview" src="" alt="Image preview" style="max-width: 200px; max-height: 200px; display: none; border-radius: 4px;">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Create Partner
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const preview = document.getElementById('imagePreview');
            preview.src = event.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
        console.log('Image selected:', file.name, 'Size:', file.size, 'bytes');
    }
});
</script>
@endsection
