<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeBase;
use App\Models\KnowledgeCategory;

class KnowledgeController extends Controller
{
    public function index()
    {
        $categories = KnowledgeCategory::withCount(['knowledgeBases' => function ($q) {
            $q->published();
        }])->orderBy('order')->get();

        $items = KnowledgeBase::published()->with('category')->latest()->paginate(12);

        return view('pages.knowledge.index', compact('categories', 'items'));
    }

    public function show(string $slug)
    {
        $item = KnowledgeBase::published()->where('slug', $slug)->firstOrFail();
        $item->increment('view_count');

        $related = KnowledgeBase::published()
            ->where('category_id', $item->category_id)
            ->where('id', '!=', $item->id)
            ->latest()->take(4)->get();

        return view('pages.knowledge.show', compact('item', 'related'));
    }
}
