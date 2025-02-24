<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @return View|Factory|Application
     */
    public function home(): View|Factory|Application
    {
        $latestPosts = Post::latest()->take(5)->get();
        $trendingPosts = Post::orderBy('views', 'desc')->take(4)->get();
        $softwareDevCategory = Category::where('category_name', 'Software Development')->first();
        $softwareDevPosts = Post::where('category_id', $softwareDevCategory->id)
            ->latest()
            ->take(4)
            ->get();

        return view('home', compact('latestPosts', 'trendingPosts', 'softwareDevPosts'));
    }

    /**
     * Show the categories page
     *
     * @param Request $request
     * @return View|Factory|Application
     */
    public function categories(Request $request): View|Factory|Application
    {
        return view('blog-content.categories');
    }

    /**
     * Show the about page
     *
     * @param Request $request
     * @return View|Factory|Application
     */
    public function about(Request $request): View|Factory|Application
    {
        return view('blog-content.about');
    }

    /**
     * Show the contact page
     *
     * @param Request $request
     * @return View|Factory|Application
     */
    public function contact(Request $request): View|Factory|Application
    {
        return view('blog-content.contact');
    }

    /**
     * Show the clicked post
     *
     * @param Request $request
     * @return View|Factory|Application
     */
    public function show(Request $request): View|Factory|Application
    {
        return view('blog-content.show-post', [
            'post_id' => $request->get('id'),
        ]);
    }
}
