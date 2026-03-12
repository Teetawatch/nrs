<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;

class NewsController extends Controller
{
    public function index()
    {
        $categories = PostCategory::withCount(['posts' => function ($q) {
            $q->published();
        }])->get();

        $posts = Post::published()->with('category')->latest('published_at')->paginate(12);

        return view('pages.news.index', compact('posts', 'categories'));
    }

    public function show(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->with('category', 'user')->firstOrFail();

        $related = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest('published_at')->take(3)->get();

        return view('pages.news.show', compact('post', 'related'));
    }
}
