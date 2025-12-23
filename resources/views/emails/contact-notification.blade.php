@php($c = $contact)
<h2>New Contact Message</h2>
<p><strong>Name:</strong> {{ $c->name }}</p>
<p><strong>Email:</strong> {{ $c->email }}</p>
@if($c->phone)<p><strong>Phone:</strong> {{ $c->phone }}</p>@endif
@if($c->country)<p><strong>Country:</strong> {{ $c->country }}</p>@endif
<hr>
<p><strong>Message:</strong></p>
<p>{!! nl2br(e($c->message)) !!}</p>
