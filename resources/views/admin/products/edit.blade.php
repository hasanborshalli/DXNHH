@extends('admin.layout')

@section('content')
<div class="admin-head">
    <div>
        <h1>Edit Product</h1>
        <p class="muted">{{ $product->name_en }}</p>
    </div>
    <a class="btn btn-outline" href="{{ route('admin.products.index') }}">Back</a>
</div>

@include('admin.products.form', ['product' => $product])
@endsection