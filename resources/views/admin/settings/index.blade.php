@extends('layouts.app')

@section('title', 'Settings Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Website Settings</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.bulk-update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Company Information -->
                        @if(isset($settings['company']))
                        <div class="row mb-5">
                            <div class="col-12">
                                <h4 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-building me-2"></i>
                                    Company Information
                                </h4>
                            </div>
                            @foreach($settings['company'] as $setting)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                        {{ ucfirst(str_replace('_', ' ', $setting->key)) }}
                                        @if($setting->description)
                                            <small class="text-muted d-block mt-1">{{ $setting->description }}</small>
                                        @endif
                                    </label>

                                    @if($setting->type === 'textarea')
                                        <textarea name="{{ $setting->key }}" id="{{ $setting->key }}"
                                            class="form-control" rows="5"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">{{ old($setting->key, $setting->value) }}</textarea>
                                    @else
                                        <input type="{{ $setting->type }}" name="{{ $setting->key }}"
                                            id="{{ $setting->key }}" class="form-control"
                                            value="{{ old($setting->key, $setting->value) }}"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">
                                    @endif

                                    @error($setting->key)
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- Images -->
                        @if(isset($settings['images']))
                        <div class="row mb-5">
                            <div class="col-12">
                                <h4 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-image me-2"></i>
                                    Images & Media
                                </h4>
                            </div>
                            @foreach($settings['images'] as $setting)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                        {{ ucfirst(str_replace('_', ' ', $setting->key)) }}
                                        @if($setting->description)
                                            <small class="text-muted d-block mt-1">{{ $setting->description }}</small>
                                        @endif
                                    </label>

                                    @if($setting->type === 'image')
                                        <div class="mb-2">
                                            @php
                                                $storageExists = $setting->value && \Illuminate\Support\Facades\Storage::disk('public')->exists($setting->value);
                                                $publicExists = $setting->value && file_exists(public_path($setting->value));
                                                $imgUrl = $storageExists ? asset('storage/' . $setting->value) : ($publicExists ? asset($setting->value) : null);
                                            @endphp

                                            @if($imgUrl)
                                                <img src="{{ $imgUrl }}"
                                                     alt="{{ $setting->key }}"
                                                     style="max-height: 120px; max-width: 250px;"
                                                     class="img-thumbnail">
                                                <div class="mt-1">
                                                    <small class="text-muted">Current file: {{ $setting->value }}</small>
                                                </div>
                                            @elseif($setting->value)
                                                <div class="alert alert-warning py-1">
                                                    <small>Image not found: {{ $setting->value }}</small>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" name="{{ $setting->key }}" id="{{ $setting->key }}"
                                            class="form-control" accept="image/*">
                                        @if($setting->key === 'about_image')
                                            <small class="text-muted">Recommended size: 400x400px</small>
                                        @elseif($setting->key === 'logo')
                                            <small class="text-muted">Recommended size: 125x125px</small>
                                        @endif
                                    @else
                                        <input type="{{ $setting->type }}" name="{{ $setting->key }}"
                                            id="{{ $setting->key }}" class="form-control"
                                            value="{{ old($setting->key, $setting->value) }}"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">
                                    @endif

                                    @error($setting->key)
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- Hero Section -->
                        @if(isset($settings['hero']))
                        <div class="row mb-5">
                            <div class="col-12">
                                <h4 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-star me-2"></i>
                                    Hero Section
                                </h4>
                            </div>
                            @foreach($settings['hero'] as $setting)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                        {{ ucfirst(str_replace('_', ' ', $setting->key)) }}
                                        @if($setting->description)
                                            <small class="text-muted d-block mt-1">{{ $setting->description }}</small>
                                        @endif
                                        @if(str_contains($setting->key, '_en'))
                                            <span class="badge bg-primary ms-1">EN</span>
                                        @elseif(str_contains($setting->key, '_es'))
                                            <span class="badge bg-success ms-1">ES</span>
                                        @endif
                                    </label>

                                    @if($setting->type === 'textarea')
                                        <textarea name="{{ $setting->key }}" id="{{ $setting->key }}"
                                            class="form-control" rows="3"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">{{ old($setting->key, $setting->value) }}</textarea>
                                    @else
                                        <input type="{{ $setting->type }}" name="{{ $setting->key }}"
                                            id="{{ $setting->key }}" class="form-control"
                                            value="{{ old($setting->key, $setting->value) }}"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">
                                    @endif

                                    @error($setting->key)
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- About Section -->
                        @if(isset($settings['about']))
                        <div class="row mb-5">
                            <div class="col-12">
                                <h4 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-info-circle me-2"></i>
                                    About Section
                                </h4>
                                <div class="alert alert-info mb-3">
                                    <h6 class="alert-heading"><i class="bi bi-lightbulb me-2"></i>About Section Preview</h6>
                                    <p class="mb-0">The About section will display: Main title, description with image, and three feature boxes (Mission & Vision, Why Choose Us, Our Values) with their respective titles and descriptions in both English and Spanish.</p>
                                </div>
                            </div>
                            @foreach($settings['about'] as $setting)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                        {{ ucfirst(str_replace('_', ' ', $setting->key)) }}
                                        @if($setting->description)
                                            <small class="text-muted d-block mt-1">{{ $setting->description }}</small>
                                        @endif
                                        @if(str_contains($setting->key, '_en'))
                                            <span class="badge bg-primary ms-1">EN</span>
                                        @elseif(str_contains($setting->key, '_es'))
                                            <span class="badge bg-success ms-1">ES</span>
                                        @endif
                                    </label>

                                    @if($setting->type === 'textarea')
                                        <textarea name="{{ $setting->key }}" id="{{ $setting->key }}"
                                            class="form-control" rows="5"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">{{ old($setting->key, $setting->value) }}</textarea>
                                    @elseif($setting->type === 'image')
                                        <div class="mb-2">
                                            @php
                                                $storageExists = $setting->value && \Illuminate\Support\Facades\Storage::disk('public')->exists($setting->value);
                                                $publicExists = $setting->value && file_exists(public_path($setting->value));
                                                $imgUrl = $storageExists ? asset('storage/' . $setting->value) : ($publicExists ? asset($setting->value) : null);
                                            @endphp

                                            @if($imgUrl)
                                                <img src="{{ $imgUrl }}"
                                                     alt="{{ $setting->key }}"
                                                     style="max-height: 120px; max-width: 250px;"
                                                     class="img-thumbnail">
                                                <div class="mt-1">
                                                    <small class="text-muted">Current file: {{ $setting->value }}</small>
                                                </div>
                                            @elseif($setting->value)
                                                <div class="alert alert-warning py-1">
                                                    <small>Image not found: {{ $setting->value }}</small>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" name="{{ $setting->key }}" id="{{ $setting->key }}"
                                            class="form-control" accept="image/*">
                                        <small class="text-muted">Recommended size: 400x400px</small>
                                    @else
                                        <input type="{{ $setting->type }}" name="{{ $setting->key }}"
                                            id="{{ $setting->key }}" class="form-control"
                                            value="{{ old($setting->key, $setting->value) }}"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">
                                    @endif

                                    @error($setting->key)
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- Quality Assurance Section -->
                        @if(isset($settings['quality']))
                        <div class="row mb-5">
                            <div class="col-12">
                                <h4 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-award me-2"></i>
                                    Quality Assurance Section
                                </h4>
                                <div class="alert alert-info mb-3">
                                    <h6 class="alert-heading"><i class="bi bi-lightbulb me-2"></i>Quality Section Preview</h6>
                                    <p class="mb-0">The Quality Assurance section displays a main title and three cards (Strategy, Quality, Manufacturing) with images, titles, descriptions, and links in both English and Spanish.</p>
                                </div>
                            </div>

                            @php
                                // Group quality settings by their prefixes to avoid duplicates
                                $qualityGroups = [
                                    'main_title' => ['quality_title_en', 'quality_title_es'],
                                    'strategy' => ['strategy_image', 'strategy_title_en', 'strategy_title_es', 'strategy_description_en', 'strategy_description_es', 'strategy_link'],
                                    'quality_card' => ['quality_card_image', 'quality_card_title_en', 'quality_card_title_es', 'quality_card_description_en', 'quality_card_description_es', 'quality_card_link'],
                                    'manufacturing' => ['manufacturing_image', 'manufacturing_title_en', 'manufacturing_title_es', 'manufacturing_description_en', 'manufacturing_description_es', 'manufacturing_link']
                                ];
                            @endphp

                            <!-- Main Title -->
                            <div class="col-12">
                                <h5 class="text-primary mb-3">Main Title</h5>
                            </div>
                            @foreach($settings['quality'] as $setting)
                                @if(in_array($setting->key, $qualityGroups['main_title']))
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                            {{ ucfirst(str_replace('_', ' ', $setting->key)) }}
                                            @if($setting->description)
                                                <small class="text-muted d-block mt-1">{{ $setting->description }}</small>
                                            @endif
                                            @if(str_contains($setting->key, '_en'))
                                                <span class="badge bg-primary ms-1">EN</span>
                                            @elseif(str_contains($setting->key, '_es'))
                                                <span class="badge bg-success ms-1">ES</span>
                                            @endif
                                        </label>
                                        <input type="{{ $setting->type }}" name="{{ $setting->key }}"
                                            id="{{ $setting->key }}" class="form-control"
                                            value="{{ old($setting->key, $setting->value) }}"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">
                                        @error($setting->key)
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                            @endforeach

                            <!-- Strategy Card -->
                            <div class="col-12 mt-4">
                                <h5 class="text-primary mb-3">Strategy Card</h5>
                            </div>
                            @foreach($settings['quality'] as $setting)
                                @if(in_array($setting->key, $qualityGroups['strategy']))
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                            {{ ucfirst(str_replace(['strategy_', '_en', '_es'], '', $setting->key)) }}
                                            @if($setting->description)
                                                <small class="text-muted d-block mt-1">{{ $setting->description }}</small>
                                            @endif
                                            @if(str_contains($setting->key, '_en'))
                                                <span class="badge bg-primary ms-1">EN</span>
                                            @elseif(str_contains($setting->key, '_es'))
                                                <span class="badge bg-success ms-1">ES</span>
                                            @endif
                                        </label>

                                        @if($setting->type === 'image')
                                                <div class="mb-2">
                                                    @php
                                                        $storageExists = $setting->value && \Illuminate\Support\Facades\Storage::disk('public')->exists($setting->value);
                                                        $publicExists = $setting->value && file_exists(public_path($setting->value));
                                                        $imgUrl = $storageExists ? asset('storage/' . $setting->value) : ($publicExists ? asset($setting->value) : null);
                                                    @endphp

                                                    @if($imgUrl)
                                                        <img src="{{ $imgUrl }}"
                                                             alt="{{ $setting->key }}"
                                                             style="max-height: 120px; max-width: 250px;"
                                                             class="img-thumbnail">
                                                        <div class="mt-1">
                                                            <small class="text-muted">Current file: {{ $setting->value }}</small>
                                                        </div>
                                                    @elseif($setting->value)
                                                        <div class="alert alert-warning py-1">
                                                            <small>Image not found: {{ $setting->value }}</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            <input type="file" name="{{ $setting->key }}" id="{{ $setting->key }}"
                                                class="form-control" accept="image/*">
                                            <small class="text-muted">Recommended size: 400x300px</small>
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="{{ $setting->key }}" id="{{ $setting->key }}"
                                                class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">{{ old($setting->key, $setting->value) }}</textarea>
                                        @else
                                            <input type="{{ $setting->type }}" name="{{ $setting->key }}"
                                                id="{{ $setting->key }}" class="form-control"
                                                value="{{ old($setting->key, $setting->value) }}"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">
                                        @endif

                                        @error($setting->key)
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                            @endforeach

                            <!-- Quality Card -->
                            <div class="col-12 mt-4">
                                <h5 class="text-primary mb-3">Quality Card</h5>
                            </div>
                            @foreach($settings['quality'] as $setting)
                                @if(in_array($setting->key, $qualityGroups['quality_card']))
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                            {{ ucfirst(str_replace(['quality_card_', '_en', '_es'], '', $setting->key)) }}
                                            @if($setting->description)
                                                <small class="text-muted d-block mt-1">{{ $setting->description }}</small>
                                            @endif
                                            @if(str_contains($setting->key, '_en'))
                                                <span class="badge bg-primary ms-1">EN</span>
                                            @elseif(str_contains($setting->key, '_es'))
                                                <span class="badge bg-success ms-1">ES</span>
                                            @endif
                                        </label>

                                        @if($setting->type === 'image')
                                            <div class="mb-2">
                                                @php
                                                    $storageExists = $setting->value && \Illuminate\Support\Facades\Storage::disk('public')->exists($setting->value);
                                                    $publicExists = $setting->value && file_exists(public_path($setting->value));
                                                    $imgUrl = $storageExists ? asset('storage/' . $setting->value) : ($publicExists ? asset($setting->value) : null);
                                                @endphp

                                                @if($imgUrl)
                                                    <img src="{{ $imgUrl }}"
                                                         alt="{{ $setting->key }}"
                                                         style="max-height: 120px; max-width: 250px;"
                                                         class="img-thumbnail">
                                                    <div class="mt-1">
                                                        <small class="text-muted">Current file: {{ $setting->value }}</small>
                                                    </div>
                                                @elseif($setting->value)
                                                    <div class="alert alert-warning py-1">
                                                        <small>Image not found: {{ $setting->value }}</small>
                                                    </div>
                                                @endif
                                            </div>
                                            <input type="file" name="{{ $setting->key }}" id="{{ $setting->key }}"
                                                class="form-control" accept="image/*">
                                            <small class="text-muted">Recommended size: 400x300px</small>
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="{{ $setting->key }}" id="{{ $setting->key }}"
                                                class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">{{ old($setting->key, $setting->value) }}</textarea>
                                        @else
                                            <input type="{{ $setting->type }}" name="{{ $setting->key }}"
                                                id="{{ $setting->key }}" class="form-control"
                                                value="{{ old($setting->key, $setting->value) }}"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">
                                        @endif

                                        @error($setting->key)
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                            @endforeach

                            <!-- Manufacturing Card -->
                            <div class="col-12 mt-4">
                                <h5 class="text-primary mb-3">Manufacturing Card</h5>
                            </div>
                            @foreach($settings['quality'] as $setting)
                                @if(in_array($setting->key, $qualityGroups['manufacturing']))
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                            {{ ucfirst(str_replace(['manufacturing_', '_en', '_es'], '', $setting->key)) }}
                                            @if($setting->description)
                                                <small class="text-muted d-block mt-1">{{ $setting->description }}</small>
                                            @endif
                                            @if(str_contains($setting->key, '_en'))
                                                <span class="badge bg-primary ms-1">EN</span>
                                            @elseif(str_contains($setting->key, '_es'))
                                                <span class="badge bg-success ms-1">ES</span>
                                            @endif
                                        </label>

                                        @if($setting->type === 'image')
                                            <div class="mb-2">
                                                @php
                                                    $storageExists = $setting->value && \Illuminate\Support\Facades\Storage::disk('public')->exists($setting->value);
                                                    $publicExists = $setting->value && file_exists(public_path($setting->value));
                                                    $imgUrl = $storageExists ? asset('storage/' . $setting->value) : ($publicExists ? asset($setting->value) : null);
                                                @endphp

                                                @if($imgUrl)
                                                    <img src="{{ $imgUrl }}"
                                                         alt="{{ $setting->key }}"
                                                         style="max-height: 120px; max-width: 250px;"
                                                         class="img-thumbnail">
                                                    <div class="mt-1">
                                                        <small class="text-muted">Current file: {{ $setting->value }}</small>
                                                    </div>
                                                @elseif($setting->value)
                                                    <div class="alert alert-warning py-1">
                                                        <small>Image not found: {{ $setting->value }}</small>
                                                    </div>
                                                @endif
                                            </div>
                                            <input type="file" name="{{ $setting->key }}" id="{{ $setting->key }}"
                                                class="form-control" accept="image/*">
                                            <small class="text-muted">Recommended size: 400x300px</small>
                                        @elseif($setting->type === 'textarea')
                                            <textarea name="{{ $setting->key }}" id="{{ $setting->key }}"
                                                class="form-control" rows="3"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">{{ old($setting->key, $setting->value) }}</textarea>
                                        @else
                                            <input type="{{ $setting->type }}" name="{{ $setting->key }}"
                                                id="{{ $setting->key }}" class="form-control"
                                                value="{{ old($setting->key, $setting->value) }}"
                                                placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">
                                        @endif

                                        @error($setting->key)
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                        @endif

                        <!-- Contact Section -->
                        @if(isset($settings['contact']))
                        <div class="row mb-5">
                            <div class="col-12">
                                <h4 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-telephone me-2"></i>
                                    Contact Section
                                </h4>
                            </div>
                            @foreach($settings['contact'] as $setting)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                        {{ ucfirst(str_replace('_', ' ', $setting->key)) }}
                                        @if($setting->description)
                                            <small class="text-muted d-block mt-1">{{ $setting->description }}</small>
                                        @endif
                                        @if(str_contains($setting->key, '_en'))
                                            <span class="badge bg-primary ms-1">EN</span>
                                        @elseif(str_contains($setting->key, '_es'))
                                            <span class="badge bg-success ms-1">ES</span>
                                        @endif
                                    </label>

                                    @if($setting->type === 'textarea')
                                        <textarea name="{{ $setting->key }}" id="{{ $setting->key }}"
                                            class="form-control" rows="4"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">{{ old($setting->key, $setting->value) }}</textarea>
                                    @else
                                        <input type="{{ $setting->type }}" name="{{ $setting->key }}"
                                            id="{{ $setting->key }}" class="form-control"
                                            value="{{ old($setting->key, $setting->value) }}"
                                            placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">
                                    @endif

                                    @error($setting->key)
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- Navigation Labels -->
                        @if(isset($settings['navigation']))
                        <div class="row mb-5">
                            <div class="col-12">
                                <h4 class="border-bottom pb-2 mb-3">
                                    <i class="bi bi-list me-2"></i>
                                    Navigation Labels
                                </h4>
                                <div class="alert alert-info mb-3">
                                    <h6 class="alert-heading"><i class="bi bi-translate me-2"></i>Multilingual Navigation</h6>
                                    <p class="mb-0">These labels control the navigation menu text in both English and Spanish versions of your website.</p>
                                </div>
                            </div>
                            @foreach($settings['navigation'] as $setting)
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="{{ $setting->key }}" class="form-label fw-semibold">
                                        {{ ucfirst(str_replace(['nav_', '_en', '_es'], '', $setting->key)) }}
                                        @if($setting->description)
                                            <small class="text-muted d-block mt-1">{{ $setting->description }}</small>
                                        @endif
                                        @if(str_contains($setting->key, '_en'))
                                            <span class="badge bg-primary ms-1">EN</span>
                                        @elseif(str_contains($setting->key, '_es'))
                                            <span class="badge bg-success ms-1">ES</span>
                                        @endif
                                    </label>

                                    <input type="{{ $setting->type }}" name="{{ $setting->key }}"
                                        id="{{ $setting->key }}" class="form-control"
                                        value="{{ old($setting->key, $setting->value) }}"
                                        placeholder="Enter {{ str_replace('_', ' ', $setting->key ) }}">

                                    @error($setting->key)
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <div class="form-group mt-4">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i>Update All Settings
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-2"></i>Back to Dashboard
                                </a>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Reset Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }
    .form-control:focus {
        border-color: #9859C5;
        box-shadow: 0 0 0 0.2rem rgba(152, 89, 197, 0.25);
    }
    .card {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 12px;
    }
    .card-header {
        background: linear-gradient(135deg, #9859C5, #7B4CA0);
        color: white;
        border-radius: 12px 12px 0 0 !important;
        border: none;
        padding: 1.5rem;
    }
    .card-title {
        margin: 0;
        font-weight: 600;
    }
    h4 {
        color: #9859C5;
        font-weight: 600;
    }
    .alert-info {
        background-color: #EDD8FF;
        border-color: #9859C5;
        color: #5a287d;
    }
    .badge {
        font-size: 0.7em;
    }
    .border-bottom {
        border-color: #9859C5 !important;
    }
</style>
@endsection
