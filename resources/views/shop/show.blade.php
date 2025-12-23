@extends('layouts.app')

@push('head')
@if(!empty($ogImage))
    <meta property="og:image" content="{{ $ogImage }}">
@endif

<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Product',
    'name' => $product->name,
    'description' => $metaDescription,
    'image' => array_values(array_filter([$product->image_url, $product->og_image_url])),
    'brand' => [
        '@type' => 'Brand',
        'name' => 'DXN',
    ],
    'category' => $product->category?->name,
    'url' => url()->current(),
], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
</script>

@endpush

@section('content')
<section class="page-hero">
    <div class="container" data-animate="fade-up">
        <div class="breadcrumbs">
            <a href="{{ route('shop') }}">{{ __('site.nav.shop') }}</a>
            <span>/</span>
            <span>{{ $product->name }}</span>
        </div>
        <h1>{{ $product->name }}</h1>
        <p class="lead">{{ $product->excerpt }}</p>
    </div>
</section>

<section class="section">
    <div class="container product-grid">
        <div class="panel" data-animate="fade-up">
            @if($product->image_url)
                <img class="product-image" src="{{ $product->image_url }}" alt="{{ $product->name }}">
            @else
                <div class="media-placeholder big"></div>
            @endif

            <div class="chips">
                @if($product->category)
                    <a class="chip" href="{{ route('shop', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a>
                @endif
                @if($product->is_featured)
                    <span class="chip chip-solid">Featured</span>
                @endif
            </div>
        </div>

        <div class="panel" data-animate="fade-up" data-delay="120">
            <h2>Details</h2>

            @if($product->description)
                <div class="prose">
                    {!! nl2br(e($product->description)) !!}
                </div>
            @endif

            @if($product->ingredients)
                <h3>Ingredients</h3>
                <div class="prose">
                    {!! nl2br(e($product->ingredients)) !!}
                </div>
            @endif

            @if(!empty($product->benefits))
                <h3>Benefits</h3>
                <ul class="bullets">
                    @foreach($product->benefits as $b)
                        <li>{{ $b }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="notice">
                <strong>Pricing:</strong> Prices vary by country — request details via contact or WhatsApp.
            </div>

            <div class="actions">
                <a class="btn" href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a>
                @php($wa = preg_replace('/\D+/', '', (string) config('hala.whatsapp_number')))
                @if($wa)
                    <a class="btn btn-outline" href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener">WhatsApp</a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
