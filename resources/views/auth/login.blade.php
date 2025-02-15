@extends('layouts.blog')

@section('title', 'Admin Login')

@section('content')
    <div class="flex min-h-screen">
        <div class="hidden lg:flex w-1/2 bg-cover bg-center"
             style="background-image: url('{{ Vite::asset('resources/img/admin-login.jpg') }}');">
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Admin Panel Login</h2>

                <form method="POST" action="{{ route('login.post') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" id="password" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-300">
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot Password?</a>
                    </div>

                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg text-lg font-semibold">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
