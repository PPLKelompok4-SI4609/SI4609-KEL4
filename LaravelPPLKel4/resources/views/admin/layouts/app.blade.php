<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-blue-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 h-screen fixed top-0 left-0 bg-white border-r border-gray-200 flex flex-col justify-between">
        @include('admin.layouts.sidebar')
    </aside>

    <!-- Main Content -->
    <div class="ml-64 p-6 overflow-y-auto min-h-screen flex-1">
        @yield('content')
    </div>

</body>
</html>
