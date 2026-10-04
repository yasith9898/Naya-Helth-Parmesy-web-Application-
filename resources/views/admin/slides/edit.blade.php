@extends('layouts.app')

@section('title', 'Edit Slide')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Slide</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Slides
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.slides.update', $slide) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
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

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                           value="{{ old('title', $slide->title) }}" placeholder="Enter slide title">
                                    @error('title')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="order" class="form-label">Order</label>
                                    <input type="number" name="order" id="order" class="form-control"
                                           value="{{ old('order', $slide->order) }}" placeholder="Display order">
                                    @error('order')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control"
                                      rows="3" placeholder="Enter slide description">{{ old('description', $slide->description) }}</textarea>
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="button_text" class="form-label">Button Text</label>
                                    <input type="text" name="button_text" id="button_text" class="form-control"
                                           value="{{ old('button_text', $slide->button_text) }}" placeholder="e.g., Learn More">
                                    @error('button_text')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="button_link" class="form-label">Button Link</label>
                                    <input type="text" name="button_link" id="button_link" class="form-control"
                                           value="{{ old('button_link', $slide->button_link) }}" placeholder="e.g., /about">
                                    @error('button_link')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Slide Image</label>

                            <!-- Current Image Preview -->
                            @if($slide->image)
                                <div class="mb-3">
                                    <label class="form-label">Current Image:</label>
                                    <div>
                                        <img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->title }}"
                                             class="img-thumbnail" style="max-width: 300px; max-height: 200px;">
                                        <div class="mt-2">
                                            <a href="{{ Storage::url($slide->image) }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i> View Full Size
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="custom-file">
                                <input type="file" name="image" id="image" class="form-control">
                                <small class="form-text text-muted">Leave empty to keep current image. Recommended size: 1920x1080px, Max size: 2MB</small>
                            </div>
                            @error('image')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="is_active" class="form-check-input" id="is_active"
                                       value="1" {{ old('is_active', $slide->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active Slide</label>
                            </div>
                            @error('is_active')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Slide Preview Section -->
                        <div class="form-group mt-4">
                            <label class="form-label">Slide Preview:</label>
                            <div class="border rounded p-3 bg-light">
                                <div class="row">
                                    <div class="col-md-4">
                                        @if($slide->image)
                                            <img src="{{ Storage::url($slide->image) }}" alt="Preview"
                                                 class="img-fluid rounded" style="max-height: 150px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded"
                                                 style="height: 150px;">
                                                No Image
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <h5 class="preview-title">{{ $slide->title ?? 'Slide Title' }}</h5>
                                        <p class="preview-description text-muted">
                                            {{ $slide->description ? Str::limit($slide->description, 100) : 'Slide description will appear here...' }}
                                        </p>
                                        @if($slide->button_text)
                                            <button type="button" class="btn btn-primary btn-sm preview-button">
                                                {{ $slide->button_text }}
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check"></i> Update Slide
                        </button>
                        <a href="{{ route('admin.slides.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x"></i> Cancel
                        </a>

                        <!-- Delete Button -->
                        <div class="float-end">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bi bi-trash"></i> Delete Slide
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this slide? This action cannot be undone.
                @if($slide->image)
                    <div class="mt-3">
                        <strong>Current Image:</strong><br>
                        <img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->title }}"
                             class="img-thumbnail mt-2" style="max-width: 200px;">
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Slide</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Live preview updates
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const buttonTextInput = document.getElementById('button_text');
    const previewTitle = document.querySelector('.preview-title');
    const previewDescription = document.querySelector('.preview-description');
    const previewButton = document.querySelector('.preview-button');
    const imageInput = document.getElementById('image');

    // Update title preview
    titleInput.addEventListener('input', function() {
        previewTitle.textContent = this.value || 'Slide Title';
    });

    // Update description preview
    descriptionInput.addEventListener('input', function() {
        previewDescription.textContent = this.value ?
            (this.value.length > 100 ? this.value.substring(0, 100) + '...' : this.value) :
            'Slide description will appear here...';
    });

    // Update button preview
    buttonTextInput.addEventListener('input', function() {
        if (this.value) {
            if (!previewButton) {
                const buttonHtml = `<button type="button" class="btn btn-primary btn-sm preview-button">${this.value}</button>`;
                document.querySelector('.col-md-8').insertAdjacentHTML('beforeend', buttonHtml);
            } else {
                previewButton.textContent = this.value;
            }
        } else if (previewButton) {
            previewButton.remove();
        }
    });

    // Image preview
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.querySelector('.preview-image');
                if (preview) {
                    preview.src = e.target.result;
                } else {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-fluid rounded preview-image';
                    img.style.maxHeight = '150px';
                    img.style.objectFit = 'cover';
                    document.querySelector('.col-md-4').innerHTML = '';
                    document.querySelector('.col-md-4').appendChild(img);
                }
            }
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endsection
