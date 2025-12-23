@extends('layouts.app')

@section('content')
<section class="page-hero">
    <div class="container" data-animate="fade-up">
        <h1>{{ __('site.nav.shop') }}</h1>
        <p class="lead">{{ __('site.seo.shop_desc') }}</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <form class="filters" method="GET" action="{{ route('shop') }}" data-animate="fade-up">
            <div class="field">
                <label>{{ __('site.shop.search_placeholder') }}</label>
                <input type="text" name="q" value="{{ $q }}" placeholder="{{ __('site.shop.search_placeholder') }}">
            </div>

            <div class="field">
                <label>{{ __('site.shop.filter_category') }}</label>
                <select name="category">
                    <option value="">{{ __('site.shop.filter_category') }}: {{ __('site.nav.products') }}</option>
                    @foreach($categories as $c)
                    <option value="{{ $c->slug }}" {{ $activeCategory===$c->slug ? 'selected' : '' }}>{{ $c->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>{{ __('site.shop.sort') }}</label>
                <select name="sort">
                    <option value="newest" {{ $sort==='newest' ? 'selected' : '' }}>{{ __('site.shop.sort_newest') }}
                    </option>
                    <option value="oldest" {{ $sort==='oldest' ? 'selected' : '' }}>{{ __('site.shop.sort_oldest') }}
                    </option>
                    <option value="name_asc" {{ $sort==='name_asc' ? 'selected' : '' }}>{{ __('site.shop.sort_name_asc')
                        }}</option>
                    <option value="name_desc" {{ $sort==='name_desc' ? 'selected' : '' }}>{{
                        __('site.shop.sort_name_desc') }}</option>
                </select>
            </div>

            <div class="filters-actions">
                <button class="btn btn-outline" type="submit">Apply</button>
                <a class="btn btn-ghost" href="{{ route('shop') }}">Reset</a>
            </div>
        </form>

        @if($products->count())
        <div class="grid cards">
            @foreach($products as $p)
            <article class="card" data-animate="fade-up">
                <a class="card-link" href="{{ route('shop.show', $p->slug) }}">
                    <div class="card-media">
                        @if($p->image_url)
                        <div class="product-thumb">
                            <img src="{{ $p->image_url }}" alt="{{ $p->name }}" loading="lazy">
                        </div>
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

        <div class="pagination" data-animate="fade-up">
            {{ $products->links() }}
        </div>
        @else
        <div class="empty" data-animate="fade-up">
            <p class="muted">{{ __('site.shop.no_results') }}</p>
            <a class="btn btn-outline" href="{{ route('shop') }}">Reset</a>
        </div>
        @endif
    </div>
</section>
@endsection