<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            font-weight: 400;
        }
        
        body {
            background-color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-weight: 400;
            color: #2d3748;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 500;
            letter-spacing: -0.5px;
        }
        
        .navbar {
            background-color: #800000;
            border-bottom: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
            padding: 16px 0;
        }
        
        .navbar-brand {
            font-weight: 600;
            color: #ffffff !important;
            font-size: 18px;
        }
        
        .navbar a {
            color: #f9fafb !important;
            margin-right: 20px;
            font-weight: 400;
            transition: color 0.2s;
        }
        
        .navbar a:hover {
            color: #ffe6e6 !important;
        }
        
        .container {
            margin-top: 30px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 6px;
            border: 1px solid #f1d6d6;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }
        
        .card {
            border: 1px solid #f1d6d6;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            transition: all 0.2s ease;
        }
        
        .card:hover {
            border-color: #e0b3b3;
            box-shadow: 0 3px 8px rgba(0,0,0,0.12);
        }
        
        .card-body {
            padding: 20px;
        }
        
        .btn {
            border: 1px solid transparent;
            font-weight: 500;
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background-color: #800000;
            border-color: #800000;
        }
        
        .btn-primary:hover {
            background-color: #5c0000;
            border-color: #5c0000;
        }
        
        .btn-secondary {
            background-color: #ffffff;
            border-color: #800000;
            color: #800000;
        }
        
        .btn-secondary:hover {
            background-color: #ffe6e6;
            border-color: #5c0000;
        }
        
        .btn-danger {
            background-color: #e53e3e;
            border-color: #e53e3e;
        }
        
        .btn-danger:hover {
            background-color: #c53030;
            border-color: #c53030;
        }
        
        .table {
            border-collapse: collapse;
            font-size: 14px;
        }
        
        .table th {
            border-bottom: 1px solid #e2e8f0;
            font-weight: 500;
            color: #2d3748;
            padding: 12px;
        }
        
        .table td {
            border-bottom: 1px solid #f7fafc;
            padding: 12px;
        }
        
        .form-control, .form-select {
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 14px;
            padding: 8px 12px;
            transition: border-color 0.2s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #800000;
            box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.2);
        }
        
        .form-label {
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 6px;
            color: #2d3748;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('students.index') }}">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success" role="alert" style="margin-bottom:16px;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger" role="alert" style="margin-bottom:16px;">
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-warning" role="alert" style="margin-bottom:16px;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
