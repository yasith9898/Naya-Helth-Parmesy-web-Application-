@extends('layouts.app')

@section('title', 'Add New Item')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Add New Item</h4>
    <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i> Back to Items
    </a>
</div>

<!-- Debug Info -->
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

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data" id="itemForm">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Item Name (English) *</label>
                    <input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}" required>
                    @error('name_en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Item Name (Spanish)</label>
                    <input type="text" class="form-control" name="name_es" value="{{ old('name_es') }}">
                    @error('name_es')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h6 class="mt-4 mb-3">Product Information</h6>

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Trade Name (English)</label>
                    <input type="text" class="form-control" name="trade_name_en" value="{{ old('trade_name_en') }}">
                    @error('trade_name_en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trade Name (Spanish)</label>
                    <input type="text" class="form-control" name="trade_name_es" value="{{ old('trade_name_es') }}">
                    @error('trade_name_es')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <label class="form-label">Origin (English)</label>
                    <input type="text" class="form-control" name="origin_en" value="{{ old('origin_en') }}" placeholder="e.g., USA, China, Germany">
                    @error('origin_en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Origin (Spanish)</label>
                    <input type="text" class="form-control" name="origin_es" value="{{ old('origin_es') }}" placeholder="e.g., EE. UU., China, Alemania">
                    @error('origin_es')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-12">
                    <label class="form-label">Packaging (English)</label>
                    <textarea class="form-control" name="packaging_en" rows="3" placeholder="Packaging information in English">{{ old('packaging_en') }}</textarea>
                    @error('packaging_en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-12">
                    <label class="form-label">Packaging (Spanish)</label>
                    <textarea class="form-control" name="packaging_es" rows="3" placeholder="Información de empaque en español">{{ old('packaging_es') }}</textarea>
                    @error('packaging_es')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-12">
                    <label class="form-label">Composition (English)</label>
                    <textarea class="form-control" name="composition_en" rows="3" placeholder="Product composition/ingredients in English">{{ old('composition_en') }}</textarea>
                    @error('composition_en')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row g-3 mt-2">
                <div class="col-12">
                    <label class="form-label">Composition (Spanish)</label>
                    <textarea class="form-control" name="composition_es" rows="3" placeholder="Composición/ingredientes del producto en español">{{ old('composition_es') }}</textarea>
                    @error('composition_es')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <h6 class="mt-4 mb-3">Cover Image</h6>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="image-upload-container">
                        <label class="form-label">Cover Image *</label>
                        <div class="upload-area" id="uploadArea">
                            <div class="upload-placeholder">
                                <i class="bi bi-cloud-upload display-4 text-muted"></i>
                                <p class="mt-2 mb-1">Click to upload or drag and drop</p>
                                <p class="small text-muted">PNG, JPG, JPEG (Max 2MB)</p>
                            </div>
                            <input type="file" class="form-control d-none" name="cover_image"
                                   accept="image/png, image/jpeg, image/jpg" id="coverImageInput" required>
                        </div>
                        <div class="form-text">Main product image (Recommended: 500x500px)</div>

                        <!-- Preview Container -->
                        <div class="preview-container mt-3" id="previewContainer" style="display: none;">
                            <div class="d-flex align-items-center">
                                <img id="coverPreview" src="" alt="Cover Preview"
                                     class="img-thumbnail me-3" style="width:100px; height:100px; object-fit:cover;">
                                <div>
                                    <p class="mb-1 small" id="fileName"></p>
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

                        @error('cover_image')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="form-label d-block mb-2">Status</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                        {{ old('is_active', true) ? 'checked' : '' }}
                        style="width: 3em; height: 1.5em; background-color: #9859C5;">
                    <label class="form-check-label">Active Item</label>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.items.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-chip" id="submitBtn">
                    <i class="bi bi-plus-circle me-2"></i> Create Item
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

    // Click on upload area to trigger file input
    uploadArea.addEventListener('click', function() {
        coverImageInput.click();
    });

    // Drag and drop functionality
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

    // Handle file input change
    coverImageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            handleFileSelection(this.files[0]);
        }
    });

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
            uploadArea.style.display = 'none';
        };
        reader.readAsDataURL(file);

        // Simulate upload progress (for demo purposes)
        simulateUploadProgress();
    }

    // Remove image functionality
    removeImageBtn.addEventListener('click', function() {
        resetUpload();
    });

    // Reset upload area
    function resetUpload() {
        coverImageInput.value = '';
        previewContainer.style.display = 'none';
        uploadArea.style.display = 'block';
        uploadProgress.style.display = 'none';
        progressBar.style.width = '0%';
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

        uploadArea.parentNode.insertBefore(errorDiv, uploadArea.nextSibling);

        // Auto remove after 5 seconds
        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }

    // Simulate upload progress (for demo)
    function simulateUploadProgress() {
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

    // Form submission handler
    document.getElementById('itemForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Creating...';
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
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 1rem;
    background: #f8f9fa;
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    background-color: #9859C5;
    border-radius: 10px;
    transition: width 0.3s ease;
}
</style>
@endsection
