@extends('admin.layout')

@section('content')
<div class="admin-head">
    <div>
        <h1>Add Category</h1>
        <p class="muted">Create a new category.</p>
    </div>
    <a class="btn btn-outline" href="{{ route('admin.categories.index') }}">Back</a>
</div>

@include('admin.categories.form', ['category' => null])
@endsection