<?php

namespace App\Http\Controllers;

use App\Models\MasterBrand;
use App\Models\MasterCategory;
use App\Models\MasterItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = auth()->user()->is_admin 
            ? MasterItem::with(['brand', 'category'])->latest()->paginate(5)
            : auth()->user()->masterItems()->with(['brand', 'category'])->latest()->paginate(5);
            
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $brands = MasterBrand::where('status', 'Active')->get();
        $categories = MasterCategory::where('status', 'Active')->get();
        return view('items.create', compact('brands', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:master_brands,id',
            'category_id' => 'required|exists:master_categories,id',
            'code' => 'required|unique:master_items|max:50',
            'name' => 'required|max:100',
            'attachment' => 'nullable|file|max:2048',
        ]);

        $data = $request->only(['brand_id', 'category_id', 'code', 'name']);
        $data['status'] = 'Active';
        $data['user_id'] = auth()->id();

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }

        MasterItem::create($data);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    public function edit(MasterItem $item)
    {
        $this->authorize('update', $item);
        $brands = MasterBrand::where('status', 'Active')->get();
        $categories = MasterCategory::where('status', 'Active')->get();
        return view('items.edit', compact('item', 'brands', 'categories'));
    }

    public function update(Request $request, MasterItem $item)
    {
        $this->authorize('update', $item);
        
        $request->validate([
            'brand_id' => 'required|exists:master_brands,id',
            'category_id' => 'required|exists:master_categories,id',
            'code' => 'required|max:50|unique:master_items,code,'.$item->id,
            'name' => 'required|max:100',
            'attachment' => 'nullable|file|max:2048',
        ]);

        $data = $request->only(['brand_id', 'category_id', 'code', 'name']);

        if ($request->hasFile('attachment')) {
            if ($item->attachment) {
                Storage::delete($item->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }

        $item->update($data);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(MasterItem $item)
    {
        $this->authorize('delete', $item);
        if ($item->attachment) {
            Storage::delete($item->attachment);
        }
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}