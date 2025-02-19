<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(): View|Factory|Application
    {
        return view('admin.dashboard');
    }

    public function users(): Factory|Application|View
    {
        return \view('admin.users');
    }

    public function managePosts():Factory|Application|View
    {
        $posts = Post::all();

        return \view('admin.posts-management', [
            'posts' => $posts
        ]);
    }

    public function editPost(Request $request): View|Factory|Application
    {
        return view('admin.edit-post');
    }

    public function deletePost(Request $request): RedirectResponse
    {
        try {
            Post::destroy($request->id);
            return redirect()->route('admin.posts-management')->with('success', 'Post deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.posts-management')->with('error', 'Failed to delete the post.');
        }
    }
}
