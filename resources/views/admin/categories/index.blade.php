@extends('admin.layout')

@section('content')
<div class="admin-head">
    <div>
        <h1>Categories</h1>
        <p class="muted">Manage categories for filtering and navigation.</p>
    </div>
    <a class="btn" href="{{ route('admin.categories.create') }}">Add Category</a>
</div>

<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name (EN)</th>
                    <th>Active</th>
                    <th class="w-actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->name_en }}</td>
                    <td>{{ $c->slug }}</td>
                    <td>{{ $c->is_active ? 'Yes' : 'No' }}</td>
                    <td class="actions">
                        <a class="btn btn-ghost" href="{{ route('admin.categories.edit', $c) }}">Edit</a>
                        <form class="inline" method="POST" action="{{ route('admin.categories.destroy', $c) }}"
                            onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-ghost danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $categories->links() }}
    </div>
</div>
@endsection