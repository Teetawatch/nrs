<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Banner;
use App\Models\Curriculum;
use App\Models\Personnel;
use App\Models\Post;
use App\Models\SchoolSystem;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::active()->get();
        $announcements = Announcement::active()->latest()->take(5)->get();
        $latestPosts = Post::published()->with('category')->latest('published_at')->take(6)->get();
        $sliderPosts = Post::published()->whereNotNull('cover_image')->latest('published_at')->take(6)->get();
        $commanders = Personnel::active()->where('role_type', 'commander')->orderBy('order')->get();
        $curriculums = Curriculum::where('is_active', true)->orderBy('order')->get();
        $systems = SchoolSystem::active()->with('category')->orderBy('order')->get();

        return view('pages.home', compact(
            'banners', 'announcements', 'latestPosts', 'sliderPosts',
            'commanders', 'curriculums', 'systems'
        ));
    }
}
