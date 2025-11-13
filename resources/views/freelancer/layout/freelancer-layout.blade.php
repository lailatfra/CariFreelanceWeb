<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- ✅ PENTING: Vite assets harus di-load --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'CariFreelance')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Reset semua margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        
        /* Override Bootstrap container */
        .container-fluid {
            padding: 0 !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }
        
        /* Custom container untuk content yang butuh padding */
        .content-container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        /* Main content wrapper */
        .main-content {
            min-height: calc(100vh - 85px);
            background-color: #f8fafc;
            position: relative;
            z-index: 1;
        }
        
        /* Untuk mobile responsiveness */
        @media (max-width: 768px) {
            .content-container {
                padding-left: 10px;
                padding-right: 10px;
            }
            
            .main-content {
                min-height: calc(100vh - 75px);
            }
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Loading overlay prevention */
        .container-fluid > * {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    {{-- Fixed Navbar --}}
    @include('freelancer.components.header')

    {{-- Main Content Wrapper --}}
    <main class="main-content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    {{-- Additional Scripts Section --}}
    @stack('scripts')
</body>
</html>