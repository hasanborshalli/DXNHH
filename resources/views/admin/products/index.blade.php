@extends('admin.layout')

@section('content')
<div class="admin-head">
    <div>
        <h1>Products</h1>
        <p class="muted">Manage product catalog (no cart/prices).</p>
    </div>
    <a class="btn" href="{{ route('admin.products.create') }}">Add Product</a>
</div>

<div class="panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name (EN)</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th class="w-actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->name_en }}</td>
                    <td>{{ $p->category?->name_en }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->is_featured ? 'Yes' : 'No' }}</td>
                    <td class="actions">
                        <a class="btn btn-ghost" href="{{ route('admin.products.edit', $p) }}">Edit</a>
                        <form class="inline" method="POST" action="{{ route('admin.products.destroy', $p) }}"
                            onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-ghost danger" type="submit">Delete</button>
                        </form>
                        <a class="btn btn-ghost" target="_blank" rel="noopener"
                            href="{{ route('shop.show', $p->slug) }}">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
@endsection