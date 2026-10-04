@extends('layouts.app')

@section('title', 'Items Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Items Management</h4>
    <a href="{{ route('admin.items.create') }}" class="btn btn-chip">
        <i class="bi bi-plus-circle me-2"></i> Add New Item
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Item Name</th>
                        <th>Trade Name</th>
                        <th>Origin</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>ITEM-{{ $item->id }}</td>
                        <td>
                            @if($item->cover_image_url)
                                <img src="{{ $item->cover_image_url }}" alt="{{ $item->name_en }}"
                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 8px;"
                                     onerror="this.onerror=null; this.src='{{ asset('images/default-item.png') }}'">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                     style="width: 50px; height: 50px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="fw-medium">{{ $item->name_en }}</div>
                            @if($item->name_es)
                            <small class="text-muted d-block">{{ $item->name_es }}</small>
                            @endif
                        </td>
                        <td>
                            @if($item->trade_name_en)
                                <div class="fw-medium text-primary">{{ $item->trade_name_en }}</div>
                                @if($item->trade_name_es)
                                <small class="text-muted d-block">{{ $item->trade_name_es }}</small>
                                @endif
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if($item->origin_en)
                                <div class="fw-medium">{{ $item->origin_en }}</div>
                                @if($item->origin_es)
                                <small class="text-muted d-block">{{ $item->origin_es }}</small>
                                @endif
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            <div class="form-switch switch-purple d-inline-block">
                                <input class="form-check-input status-toggle" type="checkbox"
                                    data-id="{{ $item->id }}"
                                    {{ $item->is_active ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td>{{ $item->created_at->format('d-M-Y') }}</td>
                        <td class="text-end">
                            <div class="d-inline-flex">
                                <a href="{{ route('admin.items.edit', $item) }}" class="btn btn-sm btn-outline-primary me-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.items.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                            <p class="text-muted mt-2">No items found</p>
                            <a href="{{ route('admin.items.create') }}" class="btn btn-chip btn-sm">
                                <i class="bi bi-plus-circle me-1"></i> Add First Item
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($items->hasPages())
        <div class="d-flex justify-content-center mt-3">
            {{ $items->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@section('styles')
<style>
/* Custom Colors */
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

/* Table Styles */
.table {
    margin-bottom: 0;
}

.table th {
    font-weight: 600;
    border-bottom: 2px solid #9859C5;
    background: #f8f9fa;
    padding: 1rem 0.75rem;
}

.table td {
    padding: 1rem 0.75rem;
    vertical-align: middle;
    border-bottom: 1px solid #f1f3f4;
}

.table-hover tbody tr:hover {
    background-color: rgba(152, 89, 197, 0.04);
}

/* Switch Styles */
.switch-purple.form-switch .form-check-input {
    width: 45px;
    height: 23px;
    cursor: pointer;
    background-color: #9859C5;
    border-color: #9859C5;
}

.switch-purple.form-switch .form-check-input:checked {
    background-color: #9859C5;
    border-color: #9859C5;
}

/* Badge Styles */
.badge {
    font-size: 0.75rem;
    font-weight: 500;
    padding: 0.35rem 0.65rem;
}

/* Button Styles */
.btn-outline-primary {
    border-color: #9859C5;
    color: #9859C5;
}

.btn-outline-primary:hover {
    background-color: #9859C5;
    border-color: #9859C5;
    color: white;
}

.btn-outline-danger {
    border-color: #dc3545;
    color: #dc3545;
}

.btn-outline-danger:hover {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

/* Empty State */
.bi-inbox {
    font-size: 3rem !important;
}

/* Image Styles */
.table img {
    border: 2px solid #e9ecef;
    transition: transform 0.2s ease;
}

.table img:hover {
    transform: scale(1.05);
}

/* Text Styles */
.text-primary {
    color: #9859C5 !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .table-responsive {
        border: 1px solid #dee2e6;
        border-radius: 8px;
    }

    .table th,
    .table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
    }

    .btn-chip {
        padding: 0.4rem 1rem;
        font-size: 0.875rem;
    }

    .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
}

/* Pagination Styles */
.pagination {
    margin-bottom: 0;
}

.page-link {
    color: #9859C5;
    border: 1px solid #dee2e6;
}

.page-item.active .page-link {
    background-color: #9859C5;
    border-color: #9859C5;
    color: white;
}

.page-link:hover {
    color: #7a3da8;
    background-color: #f8f9fa;
    border-color: #dee2e6;
}
</style>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Image error handling with fallback
    $('.table img').on('error', function() {
        console.log('Image failed to load, using fallback');
        $(this).attr('src', '{{ asset("images/default-item.png") }}');
    });

    // Status toggle functionality
    $('.status-toggle').change(function() {
        const itemId = $(this).data('id');
        const isActive = $(this).is(':checked');

        $.ajax({
            url: "{{ url('admin/items') }}/" + itemId + "/toggle-status",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                is_active: isActive ? 1 : 0
            },
            success: function(response) {
                console.log('Item status updated successfully');
                // Show success message
                showToast('Item status updated successfully', 'success');
            },
            error: function(xhr) {
                console.error('Error updating item status');
                // Show error message
                showToast('Error updating item status', 'error');
                // Reload to reset toggle state
                location.reload();
            }
        });
    });

    // Toast notification function
    function showToast(message, type = 'info') {
        // Remove existing toasts
        $('.toast-container').remove();

        const toast = $(`
            <div class="toast-container position-fixed top-0 end-0 p-3">
                <div class="toast align-items-center text-white bg-${type === 'success' ? 'success' : 'danger'} border-0" role="alert">
                    <div class="d-flex">
                        <div class="toast-body">
                            ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            </div>
        `);

        $('body').append(toast);
        $('.toast').toast('show');

        // Auto remove after 3 seconds
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }

    // Add smooth animations to table rows
    $('table tbody tr').hover(
        function() {
            $(this).css('transform', 'translateY(-2px)');
            $(this).css('transition', 'all 0.2s ease');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );

    // Confirm deletion with sweet alert style
    $('form[action*="destroy"]').on('submit', function(e) {
        e.preventDefault();
        const form = this;

        if (confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
            form.submit();
        }
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    console.log('Items management table loaded with ' + $('.table tbody tr').length + ' items');
});
</script>
@endsection
