<?php

namespace App\Http\Controllers;

use App\Models\SchoolSystem;
use App\Models\SystemCategory;

class SystemController extends Controller
{
    public function index()
    {
        $categories = SystemCategory::with(['systems' => function ($q) {
            $q->active()->orderBy('order');
        }])->orderBy('order')->get();

        $uncategorized = SchoolSystem::active()->whereNull('category_id')->orderBy('order')->get();

        return view('pages.systems.index', compact('categories', 'uncategorized'));
    }
}
