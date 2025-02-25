@extends('layouts.blog')

@section('title', 'TechNews - '. $postData->title)

@section('content')
    <section class="relative w-full min-h-screen flex flex-col">
        <!-- Banner Image -->
        <div class="w-full">
            <img src="{{ asset($postData->image) }}" alt="{{ $postData->title }}"
                 class="w-full h-64 object-cover">
        </div>

        <!-- Post Content -->
        <div class="max-w-6xl mx-auto px-6 py-12 text-center">
            <div class="p-4">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">{{ $postData->title }}</h1>
                <div class="mt-4 text-lg text-gray-700 mb-8">
                    {!! $postData->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection
