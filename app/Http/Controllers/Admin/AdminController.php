<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard(): View|Factory|Application
    {
        return view('admin.dashboard');
    }

    public function users(): Factory|Application|View
    {
        $users = User::all();

        return \view('admin.users', [
            'users' => $users
        ]);
    }

    public function createUser(): View|Factory|Application
    {
        return \view('admin.create-user');
    }

    public function deleteUser(Request $request): RedirectResponse
    {
        try {
            User::destroy($request->id);
            return redirect()->route('admin.users')->with('success', 'Post deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('error', 'Failed to delete the post.');
        }
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        try {
            $user = User::find($request->id);
            if ($user) {
                $user->password = Hash::make(config('app.default_user_password'));
                $user->save();
            }
            return redirect()->route('admin.users')->with('success', 'Password reset successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.users')->with('error', 'Failed to reset the password.');
        }
    }

    public function managePosts():Factory|Application|View
    {
        $posts = Post::all();

        return \view('admin.posts-management', [
            'posts' => $posts
        ]);
    }

    public function createPost(): View|Factory|Application
    {
        $categories = Category::all();

        return view('admin.create-post', [
            'categories' => $categories
        ]);
    }

    public function storePost(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'postContent' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('cover')) {
            $imageName = time() . '.' . $request->cover->getClientOriginalExtension();
            $request->cover->move(public_path('img'), $imageName);
            $imagePath = 'img/' . $imageName;
        }

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => $request->excerpt,
            'content' => $request->postContent,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'author' => $request->author,
        ]);

        return redirect()->route('admin.posts-management')->with('success', 'Post created successfully');
    }

    public function editPost(Request $request): View|Factory|Application
    {
        $post = Post::where('id', $request->id)->get();
        $categories = Category::all();

        return view('admin.edit-post', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    public function updatePost(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'author' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $normalizedData = $this->normalizeData($request->all());

        if ($request->hasFile('cover')) {
            $imagePath = $this->storeImage($request);
            $normalizedData['image'] = $imagePath;
        }

        $post = Post::find($request->id);

        if (!$post) {
            return redirect()->back()->withErrors("Post not found")->withInput();
        }

        $post->update($normalizedData);

        return redirect()->route('admin.posts-management')->with('success', 'Post updated successfully');
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

    public function toggleVisibility($id)
    {
        $post = Post::findOrFail($id);
        $post->is_visible = !$post->is_visible;
        $post->save();

        return response()->json([
            'success' => true,
            'is_visible' => $post->is_visible
        ]);
    }

    private function normalizeData(array $data): array
    {
        return [
            'title' => htmlspecialchars($data['title']),
            'slug' => htmlspecialchars(Str::slug($data['title'])),
            'excerpt' => htmlspecialchars($data['excerpt']),
            'content' => htmlspecialchars($data['content']),
            'category_id' => $data['category_id'],
            'author' => htmlspecialchars($data['author']),
        ];
    }

    private function storeImage(Request $request): string
    {
        $imageName = time() . '.' . $request->cover->getClientOriginalExtension();
        $request->cover->move(public_path('img'), $imageName);
        return 'img/' . $imageName;
    }
}
