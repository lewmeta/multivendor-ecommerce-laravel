<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(): View
    {
        return view('admin.category.index');
    }

    public function store(Request $request): RedirectResponse
    {
        dd(['Request success' => $request->all()]);
    }
}
