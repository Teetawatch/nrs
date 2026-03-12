<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\SystemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('about')->name('about.')->group(function () {
    Route::get('/history',    [AboutController::class, 'history'])->name('history');
    Route::get('/structure',  [AboutController::class, 'structure'])->name('structure');
    Route::get('/symbols',    [AboutController::class, 'symbols'])->name('symbols');
    Route::get('/philosophy', [AboutController::class, 'philosophy'])->name('philosophy');
    Route::get('/curriculum', [AboutController::class, 'curriculum'])->name('curriculum');
});

Route::get('/personnel',        [PersonnelController::class, 'index'])->name('personnel');
Route::get('/personnel/{slug}', [PersonnelController::class, 'show'])->name('personnel.show');

Route::get('/documents',                  [DocumentController::class, 'index'])->name('documents');
Route::get('/documents/{category}',       [DocumentController::class, 'category'])->name('documents.category');
Route::get('/documents/download/{id}',    [DocumentController::class, 'download'])->name('documents.download');

Route::get('/knowledge',        [KnowledgeController::class, 'index'])->name('knowledge');
Route::get('/knowledge/{slug}', [KnowledgeController::class, 'show'])->name('knowledge.show');

Route::get('/systems', [SystemController::class, 'index'])->name('systems');

Route::get('/news',        [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/contact',  [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
