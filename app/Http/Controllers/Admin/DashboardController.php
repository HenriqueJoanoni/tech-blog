<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class DashboardController extends Controller
{
    public function dashboard(): View|Factory|Application
    {
        $postViews = Post::selectRaw("title, views")->orderBy('views', 'desc')->get();
        return view('admin.dashboard', compact('postViews'));
    }
}
