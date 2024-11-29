@extends('layout')

@section('content')
<h1 class="my-4">Edit Product</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('products.update', $product) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
