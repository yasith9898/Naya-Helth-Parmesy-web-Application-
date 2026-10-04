@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Edit Item</h4>
    <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i> Back to Items
    </a>
</div>

@if($errors->any())
<div class="alert alert-danger">
    <h5>Validation Errors:</h5>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.items.update', $item) }}" method="POST" enctype="multipart/form-data" id="itemForm">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Item Name (English) *</label>
                    <input type="text" class="form-control" name="name_en" value="{{ old('name_en', $item->name_en) }}" required>
                    @error('name_en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Item Name (Spanish)</label>
                    <input type="text" class="form-control" name="name_es" value="{{ old('name_es', $item->name_es) }}">
                    @error('name_es')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h6 class="mt-4 mb-3">Product Information</h6>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Trade Name (English)</label>
                    <input type="text" class="form-control" name="trade_name_en" value="{{ old('trade_name_en', $item->trade_name_en) }}">
                    @error('trade_name_en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trade Name (Spanish)</label>
                    <input type="text" class="form-control" name="trade_name_es" value="{{ old('trade_name_es', $item->trade_name_es) }}">
                    @error('trade_name_es')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">Origin (English)</label>
                    <input type="text" class="form-control" name="origin_en" value="{{ old('origin_en', $item->origin_en) }}" placeholder="e.g., USA, China, Germany">
                    @error('origin_en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Origin (Spanish)</label>
                    <input type="text" class="form-control" name="origin_es" value="{{ old('origin_es', $item->origin_es) }}" placeholder="e.g., EE. UU., China, Alemania">
                    @error('origin_es')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-12">
                    <label class="form-label">Packaging (English)</label>
                    <textarea class="form-control" name="packaging_en" rows="3" placeholder="Packaging information in English">{{ old('packaging_en', $item->packaging_en) }}</textarea>
                    @error('packaging_en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-12">
                    <label class="form-label">Packaging (Spanish)</label>
                    <textarea class="form-control" name="packaging_es" rows="3" placeholder="Información de empaque en español">{{ old('packaging_es', $item->packaging_es) }}</textarea>
                    @error('packaging_es')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-12">
                    <label class="form-label">Composition (English)</label>
                    <textarea class="form-control" name="composition_en" rows="3" placeholder="Product composition/ingredients in English">{{ old('composition_en', $item->composition_en) }}</textarea>
                    @error('composition_en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-12">
                    <label class="form-label">Composition (Spanish)</label>
                    <textarea class="form-control" name="composition_es" rows="3" placeholder="Composición/ingredientes del producto en español">{{ old('composition_es', $item->composition_es) }}</textarea>
                    @error('composition_es')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h6 class="mt-4 mb-3">Images</h6>
            <div class="row g-3">
                <!-- Enhanced Cover Image Upload -->
                <div class="col-md-6">
                    <div class="image-upload-container">
                        <label class="form-label">Cover Image</label>

                        @if($item->cover_image)
                        <!-- Current Cover Image Display -->
                        <div class="current-image-container mb-3 p-3 border rounded">
                            <label class="form-label small text-muted mb-2">Current Cover Image:</label>
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $item->cover_image_url }}"
                                     alt="{{ $item->name_en }}"
                                     class="img-thumbnail current-cover-image"
                                     style="width: 80px; height: 80px; object-fit: cover;"
                                     onerror="this.src='{{ asset('images/default-item.png') }}'">
                                <div class="flex-grow-1">
                                    <p class="mb-1 small text-muted">Upload new image to replace</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_cover_image" value="1" id="removeCoverImage">
                                        <label class="form-check-label small text-danger" for="removeCoverImage">
                                            <i class="bi bi-trash me-1"></i> Remove current image
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Enhanced Upload Area -->
                        <div class="upload-area @if($item->cover_image) d-none @endif" id="uploadArea">
                            <div class="upload-placeholder">
                                <i class="bi bi-cloud-upload display-4 text-muted"></i>
                                <p class="mt-2 mb-1">Click to upload or drag and drop</p>
                                <p class="small text-muted">PNG, JPG, JPEG (Max 2MB)</p>
                            </div>
                            <input type="file" class="form-control d-none" name="cover_image"
                                   accept="image/png, image/jpeg, image/jpg" id="coverImageInput">
                        </div>

                        <!-- New Image Preview -->
                        <div class="preview-container mt-3" id="previewContainer" style="display: none;">
                            <div class="d-flex align-items-center p-3 border rounded bg-light">
                                <img id="coverPreview" src="" alt="New Cover Preview"
                                     class="img-thumbnail me-3" style="width:80px; height:80px; object-fit:cover;">
                                <div class="flex-grow-1">
                                    <p class="mb-1 small" id="fileName"></p>
                                    <p class="mb-2 small text-muted">This will replace the current cover image</p>
                                    <button type="button" class="btn btn-sm btn-outline-danger" id="removeImage">
                                        <i class="bi bi-trash me-1"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Progress -->
                        <div class="progress mt-2" id="uploadProgress" style="display: none; height: 6px;">
                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>

                        <div class="form-text">Main product image (Recommended: 500x500px)</div>

                        @error('cover_image')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Gallery Images -->
                <div class="col-md-6">
                    <label class="form-label">Gallery Images</label>
                    <input type="file" class="form-control" name="gallery_images[]" multiple accept="image/*">
                    <div class="form-text">Multiple images for product gallery (Max 5 images)</div>
                    @error('gallery_images')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    @error('gallery_images.*')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror

                    @if($item->gallery_images && count($item->gallery_images) > 0)
                    <div class="mt-3">
                        <label class="form-label">Current Gallery Images:</label>
                        <div class="d-flex flex-wrap gap-3">
                            @foreach($item->gallery_images as $galleryImage)
                            <div class="position-relative gallery-image-container">
                                @php
                                    $galleryUrl = null;
                                    if (\Illuminate\Support\Facades\Storage::disk('public')->exists($galleryImage)) {
                                        $galleryUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($galleryImage);
                                    } elseif (file_exists(public_path('storage/' . $galleryImage))) {
                                        $galleryUrl = asset('storage/' . $galleryImage);
                                    } elseif (file_exists(public_path($galleryImage))) {
                                        $galleryUrl = asset($galleryImage);
                                    } else {
                                        $galleryUrl = asset('images/default-item.png');
                                    }
                                @endphp
                                <img src="{{ $galleryUrl }}"
                                     alt="Gallery Image"
                                     class="img-thumbnail gallery-thumbnail"
                                     style="width: 80px; height: 80px; object-fit: cover;"
                                     onerror="this.src='{{ asset('images/default-item.png') }}'">
                                <div class="form-check position-absolute top-0 start-0 m-1">
                                    <input class="form-check-input gallery-checkbox"
                                           type="checkbox"
                                           name="remove_gallery_images[]"
                                           value="{{ $galleryImage }}"
                                           id="remove_gallery_{{ $loop->index }}">
                                    <label class="form-check-label" for="remove_gallery_{{ $loop->index }}"></label>
                                </div>
                                <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-50 text-white text-center small py-1">
                                    Remove
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-muted mt-2 d-block">Check images you want to remove</small>
                    </div>
                    @endif
                </div>
            </div>

            <div class="mt-4">
                <label class="form-label d-block mb-2">Status</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $item->is_active) ? 'checked' : '' }}
                        style="width: 3em; height: 1.5em; background-color: #9859C5;">
                    <label class="form-check-label">Active Item</label>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-chip" id="submitBtn">
                    <i class="bi bi-check-circle me-2"></i> Update Item
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const coverImageInput = document.getElementById('coverImageInput');
    const previewContainer = document.getElementById('previewContainer');
    const coverPreview = document.getElementById('coverPreview');
    const fileName = document.getElementById('fileName');
    const removeImageBtn = document.getElementById('removeImage');
    const uploadProgress = document.getElementById('uploadProgress');
    const progressBar = uploadProgress.querySelector('.progress-bar');
    const removeCoverImageCheckbox = document.getElementById('removeCoverImage');
    const currentCoverImage = document.querySelector('.current-cover-image');

    // Initialize based on current state
    if (currentCoverImage) {
        uploadArea.classList.add('d-none');
    }

    // Click on upload area to trigger file input
    if (uploadArea) {
        uploadArea.addEventListener('click', function() {
            coverImageInput.click();
        });
    }

    // Drag and drop functionality
    if (uploadArea) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            uploadArea.classList.add('highlight');
        }

        function unhighlight() {
            uploadArea.classList.remove('highlight');
        }

        // Handle dropped files
        uploadArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;

            if (files.length > 0) {
                coverImageInput.files = files;
                handleFileSelection(files[0]);
            }
        }
    }

    // Handle file input change
    if (coverImageInput) {
        coverImageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                handleFileSelection(this.files[0]);
            }
        });
    }

    // Handle file selection and validation
    function handleFileSelection(file) {
        // Validate file type
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!validTypes.includes(file.type)) {
            showError('Please select a valid image file (JPEG, JPG, or PNG)');
            resetUpload();
            return;
        }

        // Validate file size (2MB max)
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes
        if (file.size > maxSize) {
            showError('Image size must be less than 2MB');
            resetUpload();
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            coverPreview.src = e.target.result;
            fileName.textContent = file.name;
            previewContainer.style.display = 'block';
            if (uploadArea) uploadArea.style.display = 'none';
            if (currentCoverImage) currentCoverImage.parentElement.parentElement.style.display = 'none';
        };
        reader.readAsDataURL(file);

        // Simulate upload progress (for demo purposes)
        simulateUploadProgress();
    }

    // Remove new image functionality
    if (removeImageBtn) {
        removeImageBtn.addEventListener('click', function() {
            resetUpload();
        });
    }

    // Handle remove cover image checkbox
    if (removeCoverImageCheckbox) {
        removeCoverImageCheckbox.addEventListener('change', function() {
            if (this.checked) {
                if (uploadArea) uploadArea.style.display = 'block';
                if (previewContainer) previewContainer.style.display = 'none';
                if (coverImageInput) coverImageInput.value = '';
            }
        });
    }

    // Reset upload area
    function resetUpload() {
        if (coverImageInput) coverImageInput.value = '';
        if (previewContainer) previewContainer.style.display = 'none';
        if (uploadArea) uploadArea.style.display = 'block';
        if (uploadProgress) uploadProgress.style.display = 'none';
        if (progressBar) progressBar.style.width = '0%';
        if (currentCoverImage && !removeCoverImageCheckbox?.checked) {
            currentCoverImage.parentElement.parentElement.style.display = 'block';
        }
    }

    // Show error message
    function showError(message) {
        // Remove existing error alerts
        const existingAlerts = document.querySelectorAll('.upload-error');
        existingAlerts.forEach(alert => alert.remove());

        // Create new error alert
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-danger upload-error mt-2';
        errorDiv.textContent = message;

        if (uploadArea) {
            uploadArea.parentNode.insertBefore(errorDiv, uploadArea.nextSibling);
        }

        // Auto remove after 5 seconds
        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }

    // Simulate upload progress (for demo)
    function simulateUploadProgress() {
        if (!uploadProgress || !progressBar) return;

        uploadProgress.style.display = 'block';
        let width = 0;
        const interval = setInterval(() => {
            if (width >= 100) {
                clearInterval(interval);
            } else {
                width += Math.random() * 10;
                progressBar.style.width = Math.min(width, 100) + '%';
            }
        }, 100);
    }

    // Gallery image selection styling
    const galleryCheckboxes = document.querySelectorAll('.gallery-checkbox');
    galleryCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const container = this.closest('.gallery-image-container');
            if (this.checked) {
                container.classList.add('image-to-remove');
            } else {
                container.classList.remove('image-to-remove');
            }
        });
    });

    // Form submission handler
    document.getElementById('itemForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Updating...';
    });
});
</script>

<style>
.btn-chip {
    background: #9859C5;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    padding: 0.5rem 1.5rem;
    transition: all 0.2s ease;
}

.btn-chip:hover {
    background: #7a3da8;
    color: white;
    transform: translateY(-1px);
}

.form-label {
    font-weight: 500;
    color: #333;
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 0.75rem;
    transition: all 0.2s ease;
}

.form-control:focus, .form-select:focus {
    border-color: #9859C5;
    box-shadow: 0 0 0 0.2rem rgba(152, 89, 197, 0.25);
}

.card {
    border-radius: 12px;
}

h6 {
    color: #9859C5;
    font-weight: 600;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f0f0f0;
}

/* Upload Area Styles */
.upload-area {
    border: 2px dashed #ddd;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #fafafa;
}

.upload-area:hover, .upload-area.highlight {
    border-color: #9859C5;
    background: #f8f4ff;
}

.upload-placeholder {
    color: #6c757d;
}

.preview-container {
    border-radius: 8px;
}

.current-image-container {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    background-color: #9859C5;
    border-radius: 10px;
    transition: width 0.3s ease;
}

/* Gallery Images */
.gallery-image-container {
    transition: all 0.3s ease;
    border-radius: 8px;
}

.gallery-image-container:hover {
    transform: translateY(-2px);
}

.gallery-image-container.image-to-remove .gallery-thumbnail {
    border: 3px solid #dc3545;
    opacity: 0.7;
}

.gallery-checkbox {
    transform: scale(1.2);
}

.gallery-checkbox:checked {
    background-color: #dc3545;
    border-color: #dc3545;
}

.img-thumbnail {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.img-thumbnail:hover {
    transform: scale(1.05);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .upload-area {
        padding: 1.5rem;
    }

    .upload-placeholder i {
        font-size: 2rem !important;
    }

    .gallery-thumbnail {
        width: 60px !important;
        height: 60px !important;
    }
}
</style>
@endsection
