@extends('layouts.blog')

@section('title', 'TechNews - Contact')

@section('content')
    <section class="relative w-full">
        <div class="w-full">
            <img src="{{ Vite::asset('resources/img/mobile-development.jpg') }}" alt="Mobile Development"
                 class="w-full h-64 object-cover">
        </div>

        <div class="absolute inset-x-0 top-48 flex justify-center">
            <div class="max-w-2xl w-full bg-white p-8 shadow-lg rounded-lg relative -mt-20">
                <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">Contact Us</h2>
                <form action="{{ route('blog.contactSubmit') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block text-gray-700 font-medium">Your Name</label>
                        <input
                            type="text"
                            name="name"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Enter your name" required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 font-medium">Your Email</label>
                        <input
                            type="email"
                            name="email"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Enter your email" required>
                    </div>

                    <!-- Subject -->
                    <div>
                        <label class="block text-gray-700 font-medium">Subject</label>
                        <input
                            type="text"
                            name="subject"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Enter subject" required>
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="block text-gray-700 font-medium">Message</label>
                        <textarea
                            name="message"
                            rows="4"
                            class="w-full p-3 border rounded-lg focus:ring focus:ring-blue-300"
                            placeholder="Write your message" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 transition">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
