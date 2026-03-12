<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    public function index()
    {
        $categories = DocumentCategory::with(['documents' => function ($q) {
            $q->active()->orderByDesc('year')->orderBy('title');
        }])->orderBy('order')->get();

        return view('pages.documents.index', compact('categories'));
    }

    public function category(string $category)
    {
        $cat = DocumentCategory::where('slug', $category)->firstOrFail();
        $documents = Document::active()->where('category_id', $cat->id)
            ->orderByDesc('year')->orderBy('title')->paginate(20);

        return view('pages.documents.category', compact('cat', 'documents'));
    }

    public function download(int $id): StreamedResponse
    {
        $document = Document::active()->findOrFail($id);
        $document->increment('download_count');

        return Storage::download($document->file_path, $document->file_name);
    }
}
