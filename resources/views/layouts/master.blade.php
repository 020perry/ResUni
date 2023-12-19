<!-- resources/views/layouts/master.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Menu')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include DaisyUI via CDN (Optional: If you want to use additional UI components) -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.3.8/dist/full.css" rel="stylesheet">

    <!-- Voeg hier eventuele stylesheets, scripts, etc. toe -->
</head>
<body>
<div class="container">
    @yield('content')
</div>
</body>
</html>
