@php use App\Helpers\GeneralHandler; @endphp
@extends('layouts.blog')

@section('title', 'TechNews - '. $postData->title)

@section('content')
    <section class="relative w-full min-h-screen flex flex-col">
        <!-- Banner Image -->
        <div class="w-full">
            <img src="{{ asset('storage/'.$postData->image) }}" alt="{{ $postData->title }}"
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
            <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <div class="flex items-start gap-4">
                    <!-- Author Avatar -->
                    <img
                        class="w-20 h-20 rounded-full border-2 border-gray-200 object-cover"
                        src="{{ $postData->user->avatar ? asset('storage/'.$postData->user->avatar) : asset('avatars/profile.png') }}"
                        alt="{{ $postData->user->name }}">

                    <!-- Author Info -->
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $postData->user->name }}</h3>
                        <p class="text-sm text-gray-500 mb-2">
                            📅 Member since: {{ GeneralHandler::dateFmt($postData->user->created_at, "d/m/Y") }}
                        </p>

                        <!-- Bio Section -->
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            <span class="block text-sm font-semibold text-gray-700 mb-2">About the author</span>
                            <div class="prose prose-sm text-gray-600 max-w-none">
                                {!! $postData->user->bio !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
