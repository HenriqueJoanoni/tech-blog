@php use Illuminate\Support\Facades\Route; @endphp
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TechNews')</title>
    <link rel="shortcut icon" href={{ Vite::asset('resources/img/virtual-reality.png') }} type="image/x-icon">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">

<!-- Navbar -->
@if(!Route::is('login'))
    <nav class="bg-white shadow-md px-6 py-4 relative z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">TechNews</a>

            <button id="menu-toggle" class="lg:hidden text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>

            <ul id="menu"
                class="hidden
                lg:flex lg:items-center lg:space-x-2 lg:static lg:z-auto z-50 absolute w-full bg-white
                lg:w-auto top-16 left-0 shadow-lg lg:shadow-none"
            >
                <li class="w-full lg:w-auto">
                    <a href="{{ route('blog.home') }}"
                       class="block py-2 px-4
                        text-gray-700
                        hover:text-blue-600
                        hover:bg-gray-100
                        lg:hover:bg-gray-100
                        lg:rounded-lg
                        transition-colors
                        duration-200"
                    >
                        Home
                    </a>
                </li>
                <li class="w-full lg:w-auto">
                    <a href="{{ route('blog.categories') }}"
                       class="block py-2 px-4
                       text-gray-700
                       hover:text-blue-600
                       hover:bg-gray-100
                       lg:hover:bg-gray-100
                       lg:rounded-lg
                       transition-colors
                       duration-200"
                    >
                        Categories
                    </a>
                </li>
                <li class="w-full lg:w-auto">
                    <a href="{{ route('blog.about') }}"
                       class="block py-2 px-4
                       text-gray-700
                       hover:text-blue-600
                       hover:bg-gray-100
                       lg:hover:bg-gray-100
                       lg:rounded-lg
                       transition-colors
                       duration-200"
                    >
                        About
                    </a>
                </li>
                <li class="w-full lg:w-auto">
                    <a href="{{ route('blog.contact') }}"
                       class="block py-2 px-4
                       text-gray-700
                       hover:text-blue-600
                       hover:bg-gray-100
                       lg:hover:bg-gray-100
                       lg:rounded-lg
                       transition-colors
                       duration-200"
                    >
                        Contact
                    </a>
                </li>
            </ul>
        </div>
    </nav>
@endif

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
