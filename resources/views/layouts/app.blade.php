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
            background-color: #fafbfc;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-weight: 400;
            color: #2d3748;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 500;
            letter-spacing: -0.5px;
        }
        
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: none;
            padding: 16px 0;
        }
        
        .navbar-brand {
            font-weight: 600;
            color: #1a202c !important;
            font-size: 18px;
        }
        
        .navbar a {
            color: #4a5568 !important;
            margin-right: 20px;
            font-weight: 400;
            transition: color 0.2s;
        }
        
        .navbar a:hover {
            color: #1a202c !important;
        }
        
        .container {
            margin-top: 30px;
            background-color: white;
            padding: 30px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        
        .card:hover {
            border-color: #cbd5e0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
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
            background-color: #3182ce;
            border-color: #3182ce;
        }
        
        .btn-primary:hover {
            background-color: #2c5aa0;
            border-color: #2c5aa0;
        }
        
        .btn-secondary {
            background-color: #e2e8f0;
            border-color: #e2e8f0;
            color: #4a5568;
        }
        
        .btn-secondary:hover {
            background-color: #cbd5e0;
            border-color: #cbd5e0;
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
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
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
