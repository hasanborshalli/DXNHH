@extends('admin.layout')

@section('content')
<div class="admin-head">
    <div>
        <h1>Add Product</h1>
        <p class="muted">Create a new product entry.</p>
    </div>
    <a class="btn btn-outline" href="{{ route('admin.products.index') }}">Back</a>
</div>

@include('admin.products.form', ['product' => null])
@endsection