@extends('admin.layout')

@section('content')
<div class="admin-head">
    <h1>Messages</h1>
</div>

@if(session('success'))
<div class="alert success">{{ session('success') }}</div>
@endif

<div class="table-wrap">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th class="actions">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $m)
            <tr>
                <td>{{ $m->created_at?->format('Y-m-d H:i') }}</td>
                <td>{{ $m->name }}</td>
                <td>{{ $m->email }}</td>
                <td>{{ $m->phone ?? '-' }}</td>
                <td>{{ \Illuminate\Support\Str::limit($m->message, 70) }}</td>
                <td class="actions">
                    <a class="btn small" href="{{ route('admin.messages.show', $m) }}">View</a>

                    <form method="POST" action="{{ route('admin.messages.destroy', $m) }}" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn small danger"
                            onclick="return confirm('Delete this message?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No messages.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $messages->links() }}
</div>
@endsection