<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
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
        return \view('admin.posts-management');
    }
}
