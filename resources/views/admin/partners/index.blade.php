@extends('layouts.app')

@section('title', 'Partners')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Partners</h1>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Partner
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Website</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($partners as $partner)
                        <tr>
                            <td>{{ $partner->order }}</td>
                            <td>
                                @if($partner->image)
                                    <img src="{{ $partner->image_url }}"
                                         alt="{{ $partner->name['en'] }}"
                                         style="width: 80px; height: 80px; object-fit: cover;"
                                         onerror="this.src='{{ asset('images/default-image.png') }}'">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center"
                                         style="width: 80px; height: 80px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $partner->name['en'] }}</td>
                            <td>
                                @if($partner->website_link)
                                    <a href="{{ $partner->website_link }}" target="_blank">
                                        {{ Str::limit($partner->website_link, 30) }}
                                    </a>
                                @else
                                    <span class="text-muted">No link</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $partner->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $partner->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a href="{{ route('admin.partners.edit', $partner) }}"
                                       class="btn btn-sm btn-primary" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.partners.toggle-status', $partner) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-warning" title="Toggle Status">
                                            <i class="bi {{ $partner->is_active ? 'bi-toggle-on' : 'bi-toggle-off' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.partners.destroy', $partner) }}"
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')" title="Delete">
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
        </div>
    </div>
</div>
@endsection
