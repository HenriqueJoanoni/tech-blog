<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function home(): View|Factory|Application
    {
        // Fetch the latest posts for the carousel
        $latestPosts = Post::latest()->take(5)->get();

        // Fetch trending posts (custom logic, e.g., most viewed)
        $trendingPosts = Post::orderBy('views', 'desc')->take(4)->get();

        // Fetch posts categorized under "Technology" (or any other category)
        $technologyPosts = Post::where('category', 'Technology')->latest()->take(4)->get();

        return view('home', compact('latestPosts', 'trendingPosts', 'technologyPosts'));
    }
}
