<?php

namespace App\Http\Controllers;

use App\Models\EntryCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EntryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = EntryCategory::all();

        return view('admin.entries.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.entries.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category.category_name' => 'required|string|unique:entry_categories,category_name'
        ]);

        $category = new EntryCategory();
        $category->category_name = $request->input('category.category_name');

        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = EntryCategory::find($id);

        if($category === NULL) {
            return redirect()->route('categories.index');
        }

        return view('admin.entries.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category.category_name' => ['required', 'string', Rule::unique('entry_categories', 'category_name')->ignore($id)]
        ]);

        $category = EntryCategory::findOrFail($id);

        $category->category_name = $request->input('category.category_name');

        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = EntryCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('categories.index');
    }
}
