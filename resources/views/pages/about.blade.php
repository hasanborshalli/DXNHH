@extends('layouts.app')

@section('content')
<section class="page-hero">
    <div class="container" data-animate="fade-up">
        <h1>{{ __('site.nav.about') }}</h1>
        <p class="lead">{{ __('site.about.p1') }}</p>
    </div>
</section>

<section class="section">
    <div class="container split" data-animate="fade-up">
        <div class="panel">
            <h2>{{ __('site.about.title') }}</h2>
            <p class="muted">{{ __('site.about.p1') }}</p>
            <p class="muted">{{ __('site.about.p2') }}</p>
        </div>
        <div class="panel">
            <h2>DXN</h2>
            <p class="muted">{{ __('site.dxn.p1') }}</p>
            <p class="muted">{{ __('site.dxn.p2') }}</p>
            <p class="muted">{{ __('site.dxn.p3') }}</p>
        </div>
    </div>
</section>
@endsection
