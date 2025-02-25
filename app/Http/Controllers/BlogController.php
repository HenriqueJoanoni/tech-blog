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
            ->take(6)
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
        $categories = Category::all();

        return view('blog-content.categories', compact('categories'));
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
     * @param string $slug
     * @param int $id
     * @return View|Factory|Application
     */
    public function show(Request $request, string $slug, int $id): View|Factory|Application
    {
        $postData = Post::where('id', $id)->first();

        return view('blog-content.show-post', [
            'postData' => $postData,
        ]);
    }

    /**
     * Show all the posts from a specific category
     *
     * @param Request $request
     * @param $categorySlug
     * @return View|Factory|Application
     */
    public function getAllPostsPerCategory(Request $request, $categorySlug): View|Factory|Application
    {
        $category = Category::where('category_slug', $categorySlug)->first();

        if (!$category) {
            abort(404, 'Category not found');
        }

        $postsPerCategory = $category->posts;

        return view('blog-content.all-posts', compact('postsPerCategory', 'category'));
    }
}
