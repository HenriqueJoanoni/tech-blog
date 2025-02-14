@extends('layouts.blog')

@section('title', 'TechBlog - About')

@section('content')
    <section class="relative w-full min-h-screen flex flex-col">
        <!-- Banner Image -->
        <div class="w-full">
            <img src="{{ Vite::asset('resources/img/about.jpg') }}" alt="About TechBlog"
                 class="w-full h-64 object-cover">
        </div>

        <!-- About Section -->
        <div class="max-w-4xl mx-auto px-6 py-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">About Us</h2>
            <p class="text-lg text-gray-700 leading-relaxed">
                Welcome to <a href="{{ route('blog.home') }}">
                    <span class="font-semibold text-blue-600">TechBlog</span>
                </a>, your go-to destination for the
                latest insights, trends, and innovations in the world of technology. Whether you're a developer, tech
                enthusiast, or just curious about how technology shapes our world, we bring you well-researched
                articles, guides, and expert opinions to keep you informed and inspired.
            </p>

            <p class="text-lg text-gray-700 leading-relaxed mt-4">
                At <a href="{{ route('blog.home') }}">
                    <span class="font-semibold text-blue-600">TechBlog</span>
                </a>, we believe that technology is more than
                just gadgets and software—it’s a driving force that changes how we work, live, and connect with one
                another. Our mission is to break down complex topics into clear, engaging content that is accessible to
                everyone, from beginners to industry professionals.
            </p>

            <!-- What We Offer -->
            <div class="mt-8 text-left">
                <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">What You’ll Find Here</h3>
                <ul class="text-lg text-gray-700 space-y-3">
                    <li>🚀 <span class="font-semibold">Latest Tech Trends</span> – Stay updated on AI, cybersecurity,
                        cloud computing, and more.
                    </li>
                    <li>💡 <span class="font-semibold">How-To Guides</span> – Step-by-step tutorials to help you master
                        new skills.
                    </li>
                    <li>🔍 <span class="font-semibold">Product Reviews</span> – In-depth analysis of the latest tech
                        gadgets and software.
                    </li>
                    <li>🌍 <span class="font-semibold">Industry Insights</span> – Expert opinions on the future of
                        technology.
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="mt-10">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">📩 Get in Touch</h3>
                <p class="text-lg text-gray-700">
                    Have questions, feedback, or a story to share? We’d love to hear from you! Connect with us through
                    our
                    <a href="{{ route('blog.contact') }}" class="text-blue-600 hover:underline font-semibold">
                        Contact Page
                    </a>
                    or follow us on social media.
                </p>
            </div>

            <p class="text-lg text-gray-900 font-semibold mt-6">
                Welcome to the <span class="text-blue-600">TechBlog</span> community—where curiosity meets innovation! 🚀</p>
        </div>
    </section>
@endsection
