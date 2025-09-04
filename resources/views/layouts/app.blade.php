<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My Blog - Laravel Static Blog')</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header {
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #007bff;
        }

        .main-content {
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }

        .footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 2rem 0;
            margin-top: 4rem;
        }

        .btn {
            display: inline-block;
            background: #007bff;
            color: #fff;
            padding: 0.5rem 1rem;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #0056b3;
        }

        .btn-secondary {
            background: #6c757d;
        }

        .btn-secondary:hover {
            background: #545b62;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .card-meta {
            color: #666;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .card-content {
            color: #555;
        }

        .tag {
            display: inline-block;
            background: #e9ecef;
            color: #495057;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.75rem;
            text-decoration: none;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .tag:hover {
            background: #007bff;
            color: #fff;
        }

        .search-form {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .search-input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination a, .pagination span {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
            border-radius: 4px;
        }

        .pagination .current {
            background: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .search-form {
                flex-direction: column;
            }
            
            .container {
                padding: 0 15px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <a href="{{ route('blog.index') }}" class="logo">My Blog</a>
                <ul class="nav-links">
                    <li><a href="{{ route('blog.index') }}">Home</a></li>
                    <li><a href="{{ route('blog.index') }}?tag=Laravel">Laravel</a></li>
                    <li><a href="{{ route('blog.index') }}?tag=PHP">PHP</a></li>
                    <li><a href="#about">About</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} My Blog. Built with Laravel. All rights reserved.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
