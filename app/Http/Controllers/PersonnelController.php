<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Personnel;

class PersonnelController extends Controller
{
    public function index()
    {
        $departments = Department::with(['personnel' => function ($q) {
            $q->active()->orderBy('order');
        }])->orderBy('order')->get();

        $commanders = Personnel::active()->where('role_type', 'commander')->orderBy('order')->get();
        $unitHeads  = Personnel::active()->where('role_type', 'unit_head')->orderBy('order')->get();

        return view('pages.personnel.index', compact('departments', 'commanders', 'unitHeads'));
    }

    public function show(string $slug)
    {
        $person = Personnel::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('pages.personnel.show', compact('person'));
    }
}
