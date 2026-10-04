@extends('layouts.app')

@section('title', 'Contact Form Submissions')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contact Form Submissions</h3>
                    <div class="card-tools">
                        <span class="badge bg-primary">Total: {{ $feedback->count() }}</span>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($feedback->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th width="100">Type</th>
                                        <th width="150">Submitted At</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($feedback as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->id }}</td>
                                        <td>
                                            <strong>{{ $item->name }}</strong>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $item->email }}" class="text-decoration-none">
                                                {{ $item->email }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($item->phone)
                                                <a href="tel:{{ $item->phone }}" class="text-decoration-none">
                                                    {{ $item->phone }}
                                                </a>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->subject)
                                                <span class="text-truncate" title="{{ $item->subject }}">
                                                    {{ $item->subject }}
                                                </span>
                                            @else
                                                <span class="text-muted">No Subject</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->message)
                                                @if(strlen($item->message) > 50)
                                                    <button type="button" class="btn btn-sm btn-outline-info"
                                                            data-bs-toggle="modal" data-bs-target="#messageModal{{ $item->id }}">
                                                        View Message
                                                    </button>
                                                @else
                                                    <span class="text-truncate">{{ $item->message }}</span>
                                                @endif
                                            @else
                                                <span class="text-muted">No Message</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $item->type == 'contact' ? 'success' : 'info' }}">
                                                {{ ucfirst($item->type) }}
                                            </span>
                                        </td>
                                        <td class="text-nowrap">
                                            {{ $item->created_at->format('M j, Y g:i A') }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1">
                                                <!-- View Button -->
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                        data-bs-toggle="modal" data-bs-target="#messageModal{{ $item->id }}"
                                                        title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </button>

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.feedback.destroy', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Are you sure you want to delete this submission?')"
                                                            title="Delete Submission">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Message Modal -->
                                    <div class="modal fade" id="messageModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title">
                                                        <i class="fas fa-envelope me-2"></i>
                                                        Message from {{ $item->name }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <strong><i class="fas fa-tag me-2"></i>Subject:</strong><br>
                                                            {{ $item->subject ?? 'No Subject' }}
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><i class="fas fa-envelope me-2"></i>Email:</strong><br>
                                                            <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                                                        </div>
                                                    </div>
                                                    @if($item->phone)
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <strong><i class="fas fa-phone me-2"></i>Phone:</strong><br>
                                                            <a href="tel:{{ $item->phone }}">{{ $item->phone }}</a>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="mb-3">
                                                        <strong><i class="fas fa-comment me-2"></i>Message:</strong>
                                                        <div class="mt-2 p-3 bg-light rounded border">
                                                            {{ $item->message }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <strong><i class="fas fa-calendar me-2"></i>Submitted:</strong><br>
                                                            {{ $item->created_at->format('F j, Y \a\t g:i A') }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times me-2"></i>Close
                                                    </button>
                                                    <a href="mailto:{{ $item->email }}?subject=Re: {{ $item->subject ?? 'Your Message' }}"
                                                       class="btn btn-primary">
                                                        <i class="fas fa-reply me-2"></i>Reply
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($feedback->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            <nav>
                                {{ $feedback->links() }}
                            </nav>
                        </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-inbox fa-4x text-muted"></i>
                            </div>
                            <h4 class="text-muted">No Contact Submissions Yet</h4>
                            <p class="text-muted mb-0">
                                Contact form submissions will appear here once customers start sending messages.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }

    .table td {
        vertical-align: middle;
    }

    .badge {
        font-size: 0.75em;
        padding: 0.4em 0.6em;
    }

    .modal-header {
        border-bottom: 1px solid #dee2e6;
    }

    .modal-footer {
        border-top: 1px solid #dee2e6;
    }

    .text-truncate {
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: inline-block;
    }

    .gap-1 {
        gap: 0.25rem;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss alerts after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });

        // Enhanced delete confirmation
        const deleteForms = document.querySelectorAll('form[action*="destroy"]');
        deleteForms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endsection
