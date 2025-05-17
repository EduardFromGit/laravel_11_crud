@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-3">
 <div class="col-md-8">
 <div class="card">
 <div class="card-header">
 <div class="float-start">
 Product Information
 </div>
 <div class="float-end">
 <a href="{{ route('products.index') }}" class="btn 
btn-primary btn-sm">&larr; Back</a>
 </div>
 </div>
 <div class="card-body">
 <div class="row mb-3">
 <div class="col-md-4 text-md-end">
 <strong>Product Image:</strong>
 </div>
 <div class="col-md-6">
 @if($product->image)
 <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 300px;">
 @else
 <p class="text-muted">No image available</p>
 @endif
 </div>
 </div>
 <div class="row mb-3">
 <div class="col-md-4 text-md-end">
 <strong>Code:</strong>
 </div>
 <div class="col-md-6">
 {{ $product->code }}
 </div>
 </div>
 <div class="row mb-3">
 <div class="col-md-4 text-md-end">
 <strong>Name:</strong>
 </div>
 <div class="col-md-6">
 {{ $product->name }}
 </div>
 </div>
 <div class="row mb-3">
 <div class="col-md-4 text-md-end">
 <strong>Quantity:</strong>
 </div>
 <div class="col-md-6">
 {{ $product->quantity }}
 </div>
 </div>
 <div class="row mb-3">
 <div class="col-md-4 text-md-end">
 <strong>Price:</strong>
 </div>
 <div class="col-md-6">
 {{ $product->price }}
 </div>
 </div>
 <div class="row mb-3">
 <div class="col-md-4 text-md-end">
 <strong>Description:</strong>
 </div>
 <div class="col-md-6">
 {{ $product->description }}
 </div>
 </div>
 
 </div>
 </div>
 </div> 
</div>
 
@endsection