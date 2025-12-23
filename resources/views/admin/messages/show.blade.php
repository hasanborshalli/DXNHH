@extends('admin.layout')

@section('content')
<div class="admin-head">
    <div>
        <h1>Message</h1>
        <p class="muted">{{ $message->created_at?->format('Y-m-d H:i') }}</p>
    </div>

    <a class="btn" href="{{ route('admin.messages.index') }}">Back</a>
</div>

<div class="card">
    <div class="grid-2">
        <div><strong>Name:</strong> {{ $message->name }}</div>
        <div><strong>Email:</strong> {{ $message->email }}</div>
        <div><strong>Phone:</strong> {{ $message->phone ?? '-' }}</div>
        <div><strong>Subject:</strong> {{ $message->subject ?? '-' }}</div>
    </div>

    <hr>

    <div>
        <strong>Message:</strong>
        <div class="message-box">{{ $message->message }}</div>
    </div>
</div>
@endsection