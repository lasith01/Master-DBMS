<?php

namespace App\Http\Controllers;

use App\Models\MasterCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = auth()->user()->is_admin 
            ? MasterCategory::latest()->paginate(5)
            : auth()->user()->masterCategories()->latest()->paginate(5);
            
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:master_categories|max:50',
            'name' => 'required|max:100',
        ]);

        auth()->user()->masterCategories()->create([
            'code' => $request->code,
            'name' => $request->name,
            'status' => 'Active'
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(MasterCategory $category)
    {
        $this->authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, MasterCategory $category)
    {
        $this->authorize('update', $category);
        
        $request->validate([
            'code' => 'required|max:50|unique:master_categories,code,'.$category->id,
            'name' => 'required|max:100',
        ]);

        $category->update($request->only(['code', 'name']));

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(MasterCategory $category)
    {
        $this->authorize('delete', $category);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}