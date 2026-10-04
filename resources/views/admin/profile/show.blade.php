@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Profile Settings</h4>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Profile Information -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body text-center">
                    <!-- Avatar Display -->
                    <div class="mb-3">
                        @php
                            $avatarExists = $user->avatar && Storage::disk('public')->exists($user->avatar);
                        @endphp

                        @if($avatarExists)
                            <img src="{{ asset('storage/' . $user->avatar) }}"
                                 alt="Avatar"
                                 class="rounded-circle border"
                                 width="120"
                                 height="120"
                                 style="object-fit: cover;">
                            <div class="mt-2">
                                <small class="text-success">✓ Avatar loaded successfully</small>
                            </div>
                        @else
                            <div class="rounded-circle bg-secondary d-inline-flex align-items-center justify-content-center border"
                                 style="width: 120px; height: 120px;">
                                <span class="text-white fs-2">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    @if($user->avatar)
                                        <span class="text-warning">⚠ Avatar file not found in storage</span>
                                    @else
                                        Default avatar
                                    @endif
                                </small>
                            </div>
                        @endif
                    </div>

                    <h5>{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                    <p class="text-muted small">Member since {{ $user->created_at->format('M Y') }}</p>

                    <!-- Avatar Upload Form -->
                    <form action="{{ route('admin.profile.update-avatar') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Upload New Avatar</label>
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                   name="avatar" id="avatar" accept="image/*" required>
                            <div class="form-text">Max file size: 2MB. Supported formats: JPEG, PNG, JPG, GIF</div>
                            @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="bi bi-upload me-1"></i>Upload Avatar
                        </button>
                    </form>

                    <!-- Clear Avatar Button -->
                    @if($user->avatar)
                    <form action="{{ route('admin.profile.clear-avatar') }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100"
                                onclick="return confirm('Are you sure you want to clear your avatar?')">
                            <i class="bi bi-trash me-1"></i>Clear Avatar
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Update Profile & Password -->
        <div class="col-md-8">
            <!-- Update Profile Form -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Update Profile</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>

            <!-- Update Password Form -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Update Password</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update-password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                           id="current_password" name="current_password" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                           id="password" name="password" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control"
                                           id="password_confirmation" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
