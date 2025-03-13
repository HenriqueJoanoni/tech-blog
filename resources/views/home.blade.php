@extends('layouts.blog')

@section('title', 'TechNews - your trending technology blog')

@section('content')
    <div class="container mx-auto px-4">
        <div class="relative group">
            <!-- Carousel container -->
            <div class="swiper mySwiper relative w-full overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($latestPosts as $post)
                        <div class="swiper-slide w-full flex-shrink-0 relative">
                            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}"
                                 class="w-full h-[500px] object-cover">
                            <a href="{{ route('blog.post', ['slug' => $post->slug, 'id' => $post->id]) }}">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-8">
                                    <h2 class="text-white text-3xl font-bold">{{ $post->title }}</h2>
                                    <p class="text-gray-300 text-sm">By {{ $post->author }}
                                        - {{ $post->created_at->format('d M, Y') }}</p>
                                    <p class="text-gray-300 text-sm">
                                        Category: {{ $post->category->category_name ?? 'Uncategorized' }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination and Navigation -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <!-- Left side Fade -->
            <div class="absolute inset-y-0 left-0 w-20 bg-gradient-to-r from-gray-600 to-transparent z-10
                        pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            </div>

            <!-- Right side fade -->
            <div class="absolute inset-y-0 right-0 w-20 bg-gradient-to-l from-gray-600 to-transparent z-10
                    pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            </div>
        </div>

        <!-- Trending Now -->
        <section class="py-8">
            <h2 class="text-2xl font-bold mb-4">Trending Now</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($trendingPosts as $post)
                    <a href="{{ route('blog.post', [$post->slug, $post->id]) }}">
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}"
                                 class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                                <p class="text-sm text-gray-600">By {{ $post->author }}
                                    - {{ $post->created_at->format('d M, Y') }}</p>
                                <p class="text-sm text-gray-600">
                                    Category: {{ $post->category->category_name ?? 'Uncategorized' }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-8">
            <h2 class="text-2xl font-bold mb-4">Latest in Software Development</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($softwareDevPosts as $post)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}"
                             class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                            <p class="text-sm text-gray-600">By {{ $post->author }}
                                - {{ $post->created_at->format('d M, Y') }}</p>
                            <p class="text-sm text-gray-600">
                                Category: {{ $post->category->category_name ?? 'Uncategorized' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
