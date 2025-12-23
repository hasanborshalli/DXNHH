@extends('layouts.app')

@section('content')
<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy" data-animate="fade-up">
            <h1>{{ __('site.hero.title') }}</h1>
            <p class="lead">{{ __('site.hero.subtitle') }}</p>
            <div class="hero-actions">
                <a class="btn" href="{{ route('shop') }}">{{ __('site.hero.cta_shop') }}</a>
                <a class="btn btn-outline" href="{{ route('contact') }}">{{ __('site.hero.cta_contact') }}</a>
            </div>
        </div>

        <div class="hero-card" data-animate="fade-up" data-delay="120">
            <div class="badge">DXN</div>
            <h3>{{ __('site.sections.why') }}</h3>
            <p class="muted">{{ __('site.dxn.p1') }}</p>
            <ul class="checklist">
                <li>{{ __('site.dxn.p2') }}</li>
                <li>{{ __('site.dxn.p3') }}</li>
            </ul>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head" data-animate="fade-up">
            <h2>{{ __('site.sections.featured') }}</h2>
            <p class="muted">{{ __('site.dxn.business_p1') }}</p>
        </div>

        @if($featured->count())
            <div class="grid cards">
                @foreach($featured as $p)
                    <article class="card" data-animate="fade-up">
                        <a class="card-link" href="{{ route('shop.show', $p->slug) }}">
                            <div class="card-media">
                                @if($p->image_url)
                                    <img src="{{ $p->image_url }}" alt="{{ $p->name }}" loading="lazy">
                                @else
                                    <div class="media-placeholder"></div>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="chip">{{ $p->category?->name }}</div>
                                <h3>{{ $p->name }}</h3>
                                <p class="muted clamp-2">{{ $p->excerpt }}</p>
                                <span class="link">{{ __('site.shop.view') }}</span>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @else
            <div class="empty" data-animate="fade-up">
                <p class="muted">No featured products yet. Add products in the admin panel.</p>
                <a class="btn btn-outline" href="{{ route('admin.login') }}">Go to Admin</a>
            </div>
        @endif
    </div>
</section>

<section class="section alt">
    <div class="container split" data-animate="fade-up">
        <div>
            <h2>{{ __('site.sections.get_started') }}</h2>
            <p class="muted">{{ __('site.dxn.business_p2') }}</p>
            <a class="btn" href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a>
        </div>
        <div class="panel">
            <h3>{{ __('site.about.title') }}</h3>
            <p class="muted">{{ __('site.about.p1') }}</p>
            <p class="muted">{{ __('site.about.p2') }}</p>
        </div>
    </div>
</section>
@endsection
