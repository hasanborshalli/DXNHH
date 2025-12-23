@extends('admin.layout')

@section('content')
<div class="admin-head" data-animate="fade-up">
    <h1>Dashboard</h1>
    <p class="muted">Quick overview.</p>
</div>

<div class="grid stats" data-animate="fade-up" data-delay="120">
    <div class="stat">
        <div class="stat-label">Categories</div>
        <div class="stat-value">{{ $counts['categories'] }}</div>
    </div>
    <div class="stat">
        <div class="stat-label">Products</div>
        <div class="stat-value">{{ $counts['products'] }}</div>
    </div>
    <div class="stat">
        <div class="stat-label">Messages</div>
        <div class="stat-value">{{ $counts['messages'] }}</div>
    </div>
</div>

<div class="panel" data-animate="fade-up">
    <h2>Latest Messages</h2>
    @if($latestMessages->count())
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($latestMessages as $m)
                        <tr>
                            <td>{{ $m->created_at->format('Y-m-d') }}</td>
                            <td>{{ $m->name }}</td>
                            <td>{{ $m->email }}</td>
                            <td>{{ $m->country }}</td>
                            <td class="clamp-2">{{ $m->message }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="muted">No messages yet.</p>
    @endif
</div>
@endsection
