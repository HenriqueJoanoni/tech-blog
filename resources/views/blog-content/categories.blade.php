@extends('layouts.blog')

@section('title', 'TechBlog - Categories')

@section('content')
    <section class="relative w-full min-h-screen flex flex-col">
        <!-- Banner Image -->
        <div class="w-full">
            <img src="{{ Vite::asset('resources/img/categories.jpg') }}" alt="TechBlog Categories"
                 class="w-full h-64 object-cover">
        </div>

        <!-- Categories Section -->
        <div class="max-w-6xl mx-auto px-6 py-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Explore Our Categories</h2>
            <p class="text-lg text-gray-700 mb-8">
                Discover articles across various fields of technology. Whether you're into software development,
                cybersecurity, or AI, we’ve got something for you!
            </p>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                        <!-- Center the icon using Flexbox -->
                        <div class="flex justify-center items-center text-4xl">
                            <img src="{{ asset('storage/'.$category->icon) }}" alt="{{ $category->category_name }}"
                                 class="w-12 h-12">
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mt-4">{{ $category->category_name }}</h3>
                        <p class="text-gray-600 mt-2">Explore the latest trends and updates
                            in {{ $category->category_name }}.</p>
                        <a href="{{ route('blog.all-posts-per-category', ['categorySlug' => $category->category_slug]) }}"
                           class="mt-4 inline-block text-blue-600 font-semibold hover:underline">
                            Read More →
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
