<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\GeneralHandler;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Services\HtmlPurifierService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function managePosts(): Factory|Application|View
    {
        if (strtolower(auth()->user()->name) == 'admin') {
            $posts = Post::with(['category', 'user'])->paginate(10);
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

        if ($request->hasFile('cover')) {
            $imagePath = $request->file('cover')->store('post-cover', 'public');
        }

        $normalized = $this->normalizeData($request->only(['title', 'excerpt', 'postContent', 'category_id']));
        $normalized['image'] = $imagePath;
        $normalized['author'] = auth()->id();

        Post::create($normalized);

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
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'excerpt' => 'required|string|max:255',
                'postContent' => 'required|string',
                'category_id' => 'required|exists:categories,id',
                'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            ]);

            $post = Post::find($request->id);

            if (!$post) {
                return redirect()->back()->withErrors("Post not found")->withInput();
            }

            $normalizedData = $this->normalizeData($request->only(['title', 'excerpt', 'postContent', 'category_id']));

            if ($request->hasFile('cover')) {
                if ($post->image) {
                    Storage::disk('public')->delete($post->image);
                }

                $imagePath = $request->file('cover')->store('post-cover', 'public');
                $normalizedData['image'] = $imagePath;
            }

            $post->update($normalizedData);

            return redirect()->route('admin.posts-management')->with('success', 'Post updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update post: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function deletePost(Request $request): JsonResponse
    {
        try {
            $postImage = Post::findOrFail($request->id);
            if ($postImage->image && Storage::disk('public')->exists($postImage->image)) {
                Storage::disk('public')->delete($postImage->image);
            }

            Post::destroy($request->id);
            return response()->json(['success' => true, 'message' => 'Post deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error ' => false, 'message' => 'Failed to delete this post.'], 500);
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
        try {
            $request->validate([
                'category_name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:categories,category_slug',
                'category_icon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'is_available' => 'required|integer',
            ]);

            if ($request->hasFile('category_icon')) {
                $imagePath = $request->file('category_icon')->store('category-icons', 'public');
            }

            $normalized = $this->normalizeData(
                $request->only(['category_name', 'slug', 'is_available']),
                'category'
            );
            $normalized['icon'] = $imagePath;

            Category::create($normalized);

            return redirect()->route('admin.categories')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create category')->withInput();
        }
    }

    public function updateCategory($id): View|Factory|Application
    {
        $category = Category::where('id', $id)->first();

        return view('admin.category-update', compact('category'));
    }

    public function updateCategoryAction(Request $request): RedirectResponse
    {
        $category = Category::findOrFail($request->id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'category_icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_available' => 'required|integer',
        ]);

        $normalized = $this->normalizeData(
            $request->only(['category_name', 'slug', 'category_icon', 'is_available']),
            'category'
        );

        if ($request->hasFile('category_icon')) {
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }
            $normalized['icon'] = $request->file('category_icon')->store('icons', 'public');
        }

        $category->update($normalized);

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully.');
    }

    public function deleteCategory(Request $request): JsonResponse
    {
        try {
            $category = Category::findOrFail($request->id);
            if ($category->icon && Storage::disk('public')->exists($category->icon)) {
                Storage::disk('public')->delete($category->icon);
            }

            Category::destroy($request->id);
            return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete this category.'], 500);
        }
    }

    private function normalizeData(array $data, string $normalizationType = 'post'): array
    {
        $purifier = HtmlPurifierService::getInstance();
        if ($normalizationType === 'category') {
            return [
                'category_name' => strip_tags($data['category_name']),
                'category_slug' => Str::slug(strip_tags($data['slug'])),
                'is_available' => (int) $data['is_available'],
            ];
        }

        return [
            'title' => strip_tags($data['title']),
            'slug' => Str::slug(strip_tags($data['title'])),
            'excerpt' => strip_tags($data['excerpt']),
            'content' => $purifier->purify($data['postContent']),
            'category_id' => (int) $data['category_id'],
        ];
    }
}
