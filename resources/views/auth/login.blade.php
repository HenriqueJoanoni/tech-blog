@extends('layouts.blog')

@section('title', 'Admin Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center p-4 bg-gray-100">
        <div class="flex flex-col lg:flex-row w-full max-w-6xl rounded-2xl overflow-hidden shadow-2xl">
            <!-- Image Section -->
            <div class="lg:w-1/2 bg-cover bg-center min-h-[400px] lg:min-h-auto order-last lg:order-first"
                 style="background-image: url('{{ Vite::asset('resources/img/admin-login.jpg') }}');">
            </div>

            <!-- Form Section -->
            <div class="w-full lg:w-1/2 bg-white flex items-center justify-center p-8 lg:p-12">
                <div class="w-full max-w-md">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 text-center mb-8">Admin Panel Login</h2>

                    <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                required
                                class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:ring-2
                                focus:ring-blue-400 focus:border-blue-400 transition-all loginInput">
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Password</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                class="w-full px-5 py-3 border-2 border-gray-200 rounded-xl focus:ring-2
                                focus:ring-blue-400 focus:border-blue-400 transition-all loginInput">
                        </div>

                        <button type="submit"
                                class="w-full
                                bg-blue-600
                                hover:bg-blue-700
                                text-white
                                py-3
                                rounded-xl
                                text-lg
                                font-semibold
                                transition-colors
                                shadow-lg">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
