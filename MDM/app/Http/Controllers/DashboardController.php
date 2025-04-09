<?php

namespace App\Http\Controllers;

use App\Models\MasterBrand;
use App\Models\MasterCategory;
use App\Models\MasterItem;

class DashboardController extends Controller
{
    public function index()
    {
        $brandsCount = auth()->user()->is_admin 
            ? MasterBrand::count()
            : auth()->user()->masterBrands()->count();
            
        $categoriesCount = auth()->user()->is_admin 
            ? MasterCategory::count()
            : auth()->user()->masterCategories()->count();
            
        $itemsCount = auth()->user()->is_admin 
            ? MasterItem::count()
            : auth()->user()->masterItems()->count();
            
        return view('dashboard', compact('brandsCount', 'categoriesCount', 'itemsCount'));
    }
}