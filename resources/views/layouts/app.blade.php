<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background: #fff;
            min-height: 100vh;
            border-right: 1px solid #E8C7FF;
        }

        .popup_link {
            color: black;
            font-weight: 500;
            padding: 10px;
            font-size: 13px;
            border-radius: 14px;
            display: flex;
            align-items: start;
            text-decoration: none;
            transition: background .2s, color .2s;
        }

        .popup_link:hover {
            color: #9859C5;
            background-color: #EDD8FF;
        }

        .popup_link.active {
            color: #9859C5 !important;
            background-color: #EDD8FF !important;
        }

        .btn-chip {
            border: 1px solid #e7dcff;
            background: #9859C5;
            color: #fff;
            border-radius: 10px;
            font-weight: 600;
            padding: 0.5rem 1rem;
        }

        .table-rounded {
            border-radius: 16px;
            overflow: hidden;
        }

        .switch-purple.form-switch .form-check-input {
            width: 45px;
            height: 23px;
            cursor: pointer;
            background-color: #9859C5;
            border-color: #9859C5;
        }

        .admin-hub span {
            font-weight: 600;
            color: #9859C5;
            display: block;
        }

        .admin-hub small {
            color: #6c757d;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="p-3">
                    <div class="profile mt-3 border rounded-4 p-2" style="background-color:#EDD8FF;">
                        <div class="admin-hub">
                            <span>Admin Hub</span>
                            <small>Control Center</small>
                        </div>
                    </div>

                    <nav class="mt-4">
                        <a href="{{ route('admin.dashboard') }}" class="popup_link mb-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-grid me-2"></i>Dashboard
                        </a>

                        <!-- Slides Link -->
                        <a href="{{ route('admin.slides.index') }}" class="popup_link mb-3 {{ request()->routeIs('admin.slides.*') ? 'active' : '' }}">
                            <i class="bi bi-images me-2"></i>Homepage Slides
                        </a>


                        <a href="{{ route('admin.items.index') }}" class="popup_link mb-3 {{ request()->routeIs('admin.items.*') ? 'active' : '' }}">
                            <i class="bi bi-cart me-2"></i>Items
                        </a>

                        <!-- Settings Link -->
                        <a href="{{ route('admin.settings.index') }}" class="popup_link mb-3 {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>

                        <!-- Partners Link - ADDED -->
                        <a href="{{ route('admin.partners.index') }}" class="popup_link mb-3 {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                            <i class="bi bi-handshake me-2"></i>Partners
                        </a>

                        <!-- Feedback Link -->
                        <a href="{{ route('admin.feedback.index') }}" class="popup_link mb-3 {{ request()->routeIs('admin.feedback.*') ? 'active' : '' }}">
                            <i class="bi bi-chat-dots me-2"></i>Customer Message
                        </a>

                        <!-- Profile Link -->
                        <a href="{{ route('admin.profile.show') }}" class="popup_link mb-3 {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                            <i class="bi bi-person me-2"></i>Profile
                        </a>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}" class="mb-3">
                            @csrf
                            <a href="{{ route('logout') }}" class="popup_link"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </a>
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10">
                <!-- Top Navigation Bar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center">
                            <span class="navbar-brand mb-0 h6 text-dark">Admin Panel</span>
                        </div>

                        <!-- User Dropdown -->
                        @auth
                        <div class="dropdown">
                            <a class="dropdown-toggle d-flex align-items-center text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    <span class="text-white small">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                                <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.profile.show') }}">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                                        <i class="bi bi-gear me-2"></i>Settings
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endauth
                    </div>
                </nav>

                <!-- Page Content -->
                <div class="p-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
