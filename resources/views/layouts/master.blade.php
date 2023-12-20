<!-- resources/views/layouts/master.blade.php -->




<!DOCTYPE html>
<html data-theme="cupcake" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel Menu')</title>
    <!-- Scripts & Styles -->
{{--    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">--}}
    <!-- Include DaisyUI via CDN (Optional: If you want to use additional UI components) -->
{{--    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.3.8/dist/full.css" rel="stylesheet">--}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="container bg-base-100">
    @yield('content')
</div>
</body>
</html>
