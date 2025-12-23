@extends('admin.layout')

@section('content')
<div class="admin-head">
    <div>
        <h1>Edit Category</h1>
        <p class="muted">{{ $category->name_en }}</p>
    </div>
    <a class="btn btn-outline" href="{{ route('admin.categories.index') }}">Back</a>
</div>

@include('admin.categories.form', ['category' => $category])
@endsection