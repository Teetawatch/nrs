<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use App\Models\OrgUnit;
use App\Models\Philosophy;
use App\Models\SchoolHistory;
use App\Models\SchoolSymbol;

class AboutController extends Controller
{
    public function history()
    {
        $history = SchoolHistory::where('is_active', true)->first();
        return view('pages.about.history', compact('history'));
    }

    public function structure()
    {
        $units = OrgUnit::whereNull('parent_id')->with('children')->orderBy('order')->get();
        return view('pages.about.structure', compact('units'));
    }

    public function symbols()
    {
        $symbols = SchoolSymbol::orderBy('order')->get();
        return view('pages.about.symbols', compact('symbols'));
    }

    public function philosophy()
    {
        $items = Philosophy::orderBy('order')->get()->groupBy('type');
        return view('pages.about.philosophy', compact('items'));
    }

    public function curriculum()
    {
        $curriculums = Curriculum::where('is_active', true)->orderBy('order')->get()->groupBy('level');
        return view('pages.about.curriculum', compact('curriculums'));
    }
}
