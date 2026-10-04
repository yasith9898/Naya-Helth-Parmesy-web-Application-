<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Baklava Inn - Digital Menu</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/headlogo.png') }}">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: #fff url('{{ asset('assets/images/background.jpeg') }}') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            overflow: hidden;
            min-height: 100vh;
        }

        /* Topbar (fixed header) */
        .topbar {
            padding: 10px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #18261F;
        }

        .topbar h6 {
            margin: 0;
            font-weight: 500;
            font-size: 16px;
        }

        /* Cards */
        .menu-card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            border: none;
            height: 100%;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .menu-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .menu-card .card-body {
            padding: 10px 15px;
        }

        .product-title {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 3px;
        }

        .product-price {
            font-size: 13px;
            color: #444;
            margin-bottom: 0;
        }

        /* Fixed header wrapper */
        .fixed-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: transparent;
            z-index: 1000;
            padding: 10px 0;
        }

        .fixed-header .container {
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border-radius: 12px;
            padding: 10px 15px;
            margin: 10px auto;
            max-width: 95%;
        }

        /* Scrollable content below header */
        .scrollable-content {
            position: fixed;
            top: 188px;
            bottom: 0;
            left: 0;
            right: 0;
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
            padding: 20px 0;
        }

        /* Fixed footer */
        .fixed-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #fff;
            padding: 10px 0;
            z-index: 1000;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            height: 30px;
        }

        /* Add more CSS styles from your original HTML here */
        /* ... include all your CSS styles ... */

    </style>
</head>
<body style="overflow: hidden; margin: 0; padding: 0;">
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
