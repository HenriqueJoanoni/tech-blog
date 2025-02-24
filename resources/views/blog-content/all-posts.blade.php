@extends('layouts.blog')

@section('title', 'TechNews - your trending technology blog')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">All Posts in {{ $category->category_name }}</h1>

        @if ($postsPerCategory->isEmpty())
            <p class="text-gray-600">No posts found for this category.</p>
        @else
            <div class="grid gap-6">
                @foreach ($postsPerCategory as $post)
                    <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $post->title }}</h2>
                        <p class="text-gray-600 mt-2">{{ Str::limit($post->content, 150) }}</p>
                        <a href="{{ route('blog.post', ['slug' => $post->slug, 'id' => $post->id]) }}" class="mt-4 inline-block text-blue-600 font-semibold hover:underline">
                            Read More →
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
