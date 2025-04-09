<?php

namespace App\Http\Controllers;

use App\Models\MasterBrand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = auth()->user()->is_admin 
            ? MasterBrand::latest()->paginate(5)
            : auth()->user()->masterBrands()->latest()->paginate(5);
            
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:master_brands|max:50',
            'name' => 'required|max:100',
        ]);

        auth()->user()->masterBrands()->create([
            'code' => $request->code,
            'name' => $request->name,
            'status' => 'Active'
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit(MasterBrand $brand)
    {
        $this->authorize('update', $brand);
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, MasterBrand $brand)
    {
        $this->authorize('update', $brand);
        
        $request->validate([
            'code' => 'required|max:50|unique:master_brands,code,'.$brand->id,
            'name' => 'required|max:100',
        ]);

        $brand->update($request->only(['code', 'name']));

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(MasterBrand $brand)
    {
        $this->authorize('delete', $brand);
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}