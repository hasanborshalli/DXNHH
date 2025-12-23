@extends('layouts.app')

@section('content')
<section class="page-hero">
    <div class="container" data-animate="fade-up">
        <h1>{{ __('site.nav.products') }}</h1>
        <p class="lead">{{ __('site.dxn.p3') }}</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head" data-animate="fade-up">
            <h2>{{ __('site.sections.categories') }}</h2>
            <p class="muted">{{ __('site.dxn.p2') }}</p>
        </div>

        <div class="grid cards">
            @foreach($categories as $c)
                <article class="card" data-animate="fade-up">
                    <a class="card-link" href="{{ route('shop', ['category' => $c->slug]) }}">
                        <div class="card-media">
                            @if($c->image_path)
                                <img src="{{ asset('storage/'.$c->image_path) }}" alt="{{ $c->name }}" loading="lazy">
                            @else
                                <div class="media-placeholder"></div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="chip">{{ $c->products_count }} {{ $c->products_count === 1 ? 'item' : 'items' }}</div>
                            <h3>{{ $c->name }}</h3>
                            <p class="muted clamp-2">{{ $c->description }}</p>
                            <span class="link">{{ __('site.shop.view') }}</span>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>

        <div class="cta" data-animate="fade-up">
            <div>
                <h3>{{ __('site.nav.shop') }}</h3>
                <p class="muted">{{ __('site.seo.shop_desc') }}</p>
            </div>
            <a class="btn" href="{{ route('shop') }}">{{ __('site.nav.shop') }}</a>
        </div>
    </div>
</section>
@endsection
