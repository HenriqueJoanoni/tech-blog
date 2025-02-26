<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function dashboard(): View|Factory|Application
    {
        return view('admin.dashboard');
    }

    public function managePosts():Factory|Application|View
    {
        if (strtolower(auth()->user()->name) == 'admin') {
            $posts = Post::paginate(10);
        } else {
            $posts = Post::where('author', auth()->id())->get();
        }

        return \view('admin.posts-management', compact('posts'));
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
            'author' => auth()->id()
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

    public function deletePost(Request $request): JsonResponse
    {
        try {
            Post::destroy($request->id);
            return response()->json(['success' => true, 'message' => 'Post deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete this post.'], 500);
        }
    }

    public function toggleVisibility($id): JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->is_visible = !$post->is_visible;
        $post->save();

        return response()->json([
            'success' => true,
            'is_visible' => $post->is_visible
        ]);
    }

    public function categories(): View|Factory|Application
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function createCategory(): Factory|Application|View
    {
        return \view('admin.create-category');
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        dd($request->all());
    }

    public function deleteCategory(Request $request): JsonResponse
    {
        try {
            Category::destroy($request->id);
            return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete this category.'], 500);
        }
    }

    private function normalizeData(array $data): array
    {
        return [
            'title' => htmlspecialchars($data['title']),
            'slug' => htmlspecialchars(Str::slug($data['title'])),
            'excerpt' => htmlspecialchars($data['excerpt']),
            'content' => htmlspecialchars($data['content']),
            'category_id' => $data['category_id'],
        ];
    }

    private function storeImage(Request $request): string
    {
        $imageName = time() . '.' . $request->cover->getClientOriginalExtension();
        $request->cover->move(public_path('img'), $imageName);
        return 'img/' . $imageName;
    }
}
