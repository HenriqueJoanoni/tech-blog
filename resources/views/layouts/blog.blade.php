<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechNews')</title>

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<!-- Navbar -->
<nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
    <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">TechNews</a>
    <ul class="flex space-x-6">
        <li><a href="#" class="text-gray-700 hover:text-blue-600">Home</a></li>
        <li><a href="#" class="text-gray-700 hover:text-blue-600">Categories</a></li>
        <li><a href="#" class="text-gray-700 hover:text-blue-600">About</a></li>
        <li><a href="#" class="text-gray-700 hover:text-blue-600">Contact</a></li>
    </ul>
</nav>

<!-- Main Content -->
<main class="mx-auto mt-10 px-6">
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-white shadow-md mt-10 py-6 text-center text-gray-700">
    <p>&copy; {{ date('Y') }} TechNews. All rights reserved.</p>
</footer>

</body>
</html>
