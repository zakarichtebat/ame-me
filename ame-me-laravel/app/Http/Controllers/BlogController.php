<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'categories'])
            ->published()
            ->latest('published_at')
            ->paginate(9);

        $featuredPost = Post::with(['user', 'categories'])
            ->published()
            ->latest('published_at')
            ->first();

        $categories = Category::withCount([
            'posts' => function ($query) {
                $query->published();
            }
        ])->get();

        return view('blog.index', compact('posts', 'featuredPost', 'categories'));
    }

    /**
     * Search for posts.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::with(['user', 'categories'])
            ->published()
            ->where('title', 'like', "%{$query}%")
            ->orWhere('content', 'like', "%{$query}%")
            ->orWhere('excerpt', 'like', "%{$query}%")
            ->latest('published_at')
            ->paginate(9);

        $posts->appends(['query' => $query]);

        $categories = Category::withCount([
            'posts' => function ($query) {
                $query->published();
            }
        ])->get();

        return view('blog.index', compact('posts', 'categories', 'query'));
    }

    /**
     * Display posts by category.
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()
            ->with(['user', 'categories'])
            ->published()
            ->latest('published_at')
            ->paginate(9);

        $categories = Category::withCount([
            'posts' => function ($query) {
                $query->published();
            }
        ])->get();

        return view('blog.index', compact('posts', 'categories', 'category'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::with(['user', 'categories', 'comments.user', 'comments.replies.user'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        $relatedPosts = Post::with(['user', 'categories'])
            ->whereHas('categories', function ($query) use ($post) {
                $query->whereIn('id', $post->categories->pluck('id'));
            })
            ->where('id', '!=', $post->id)
            ->published()
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
