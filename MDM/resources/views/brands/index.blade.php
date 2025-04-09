@extends('layouts.app')

@section('title', 'Brands')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Brands</h1>
        <a href="{{ route('brands.create') }}" class="btn btn-primary">Create Brand</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                    <tr>
                        <td>{{ $brand->code }}</td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            <span class="badge bg-{{ $brand->status == 'Active' ? 'success' : 'danger' }}">
                                {{ $brand->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $brands->links() }}
        </div>
    </div>
</div>
@endsection