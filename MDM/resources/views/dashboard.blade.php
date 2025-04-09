@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Brands</div>
            <div class="card-body">
                <h5 class="card-title">{{ $brandsCount }} Brands</h5>
                <p class="card-text">Total brands in the system</p>
                <a href="{{ route('brands.index') }}" class="btn btn-light">View Brands</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <h5 class="card-title">{{ $categoriesCount }} Categories</h5>
                <p class="card-text">Total categories in the system</p>
                <a href="{{ route('categories.index') }}" class="btn btn-light">View Categories</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-header">Items</div>
            <div class="card-body">
                <h5 class="card-title">{{ $itemsCount }} Items</h5>
                <p class="card-text">Total items in the system</p>
                <a href="{{ route('items.index') }}" class="btn btn-light">View Items</a>
            </div>
        </div>
    </div>
</div>
@endsection