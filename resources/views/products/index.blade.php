@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        @session('success')
        <div class="alert alert-success" role="alert">
            {{ $value }}
        </div>
        @endsession

        <div class="card">
            <div class="card-header">Product List</div>
            <div class="card-body">
                <a href="{{ route('products.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Product</a>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">S#</th>
                            <th scope="col" style="width: 150px;">Image</th>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="text-center" style="padding: 5px;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm me-1"><i class="bi bi-eye"></i> Show</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" onsubmit="return confirm('Do you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <td colspan="7">
                            <span class="text-danger">
                                <strong>No Product Found!</strong>
                            </span>
                        </td>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection