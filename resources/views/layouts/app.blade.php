<!DOCTYPE html>
<html lang="id">
    <!-- layout untuk guest -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
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
        
        /* Untuk mobile responsiveness */
        @media (max-width: 768px) {
            .content-container {
                padding-left: 10px;
                padding-right: 10px;
            }
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <div class="container-fluid">
        @include('components.header')
    </div>

    {{-- Content dengan container-fluid untuk full width --}}
    <div class="container-fluid">
        @yield('content')
    </div>

    {{-- Footer (opsional) --}}
    <div class="container-fluid">
        @includeIf('components.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>