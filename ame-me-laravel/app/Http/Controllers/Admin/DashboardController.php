<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Visit;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get stats for the dashboard
        $stats = [
            'postsCount' => Post::count(),
            'commentsCount' => Comment::count(),
            'messagesCount' => Message::count(),
            'visitsCount' => Visit::sum('count') ?? 0,
        ];

        // Get recent posts
        $recentPosts = Post::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Get recent comments
        $recentComments = Comment::with('post')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentPosts', 'recentComments'));
    }
}