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
        $latestPosts = Post::where('is_visible', 1)->latest()->take(5)->get();
        $trendingPosts = Post::where('is_visible', 1)->orderBy('views', 'desc')->take(4)->get();
        $softwareDevCategory = Category::where('category_name', 'Software Development')->first();
        $softwareDevPosts = Post::where([
            ['category_id', $softwareDevCategory->id],
            ['is_visible', 1]
        ])
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('latestPosts', 'trendingPosts', 'softwareDevPosts'));
    }

    /**
     * Show the categories page
     *
     * @return View|Factory|Application
     */
    public function categories(): View|Factory|Application
    {
        $categories = Category::all();

        return view('blog-content.categories', compact('categories'));
    }

    /**
     * Show the about page
     *
     * @return View|Factory|Application
     */
    public function about(): View|Factory|Application
    {
        return view('blog-content.about');
    }

    /**
     * Show the contact page
     *
     * @return View|Factory|Application
     */
    public function contact(): View|Factory|Application
    {
        return view('blog-content.contact');
    }

    /**
     * Show the clicked post
     *
     * @param string $slug
     * @param int $id
     * @return View|Factory|Application
     */
    public function show(string $slug, int $id): View|Factory|Application
    {
        $postData = Post::where('id', $id)->first();

        return view('blog-content.show-post', [
            'postData' => $postData,
        ]);
    }

    /**
     * Show all the posts from a specific category
     *
     * @param $categorySlug
     * @return View|Factory|Application
     */
    public function getAllPostsPerCategory($categorySlug): View|Factory|Application
    {
        $category = Category::where('category_slug', $categorySlug)->first();

        if (!$category) {
            abort(404, 'Category not found');
        }

        $postsPerCategory = $category->posts->where('is_visible', 1);

        return view('blog-content.all-posts', compact('postsPerCategory', 'category'));
    }
}
