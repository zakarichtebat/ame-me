<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'categories'])
            ->latest()
            ->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:posts',
            'excerpt' => 'nullable',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'categories' => 'array',
            'published_at' => 'nullable|date',
        ]);

        // Handle slug
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('public/blog');
            $validated['featured_image'] = Storage::url($path);
        }

        // Handle published date
        if ($validated['is_published'] && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Create post
        $post = Post::create([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'featured_image' => $validated['featured_image'] ?? null,
            'is_published' => $validated['is_published'] ?? false,
            'user_id' => auth()->id(),
            'published_at' => $validated['published_at'] ?? null,
        ]);

        // Attach categories
        if (!empty($validated['categories'])) {
            $post->categories()->attach($validated['categories']);
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article créé avec succès!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $postCategories = $post->categories->pluck('id')->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'postCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'nullable|max:255|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_published' => 'boolean',
            'categories' => 'array',
            'published_at' => 'nullable|date',
        ]);

        // Handle slug
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image) {
                $oldPath = str_replace('/storage', 'public', $post->featured_image);
                Storage::delete($oldPath);
            }

            $path = $request->file('featured_image')->store('public/blog');
            $validated['featured_image'] = Storage::url($path);
        }

        // Handle published date
        if ($validated['is_published'] && empty($post->published_at) && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        // Update post
        $post->update([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'featured_image' => $validated['featured_image'] ?? $post->featured_image,
            'is_published' => $validated['is_published'] ?? false,
            'published_at' => $validated['published_at'] ?? $post->published_at,
        ]);

        // Sync categories
        if (isset($validated['categories'])) {
            $post->categories()->sync($validated['categories']);
        } else {
            $post->categories()->detach();
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Delete featured image if exists
        if ($post->featured_image) {
            $path = str_replace('/storage', 'public', $post->featured_image);
            Storage::delete($path);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Article supprimé avec succès!');
    }
}
