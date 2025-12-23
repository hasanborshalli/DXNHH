<!doctype html>
@php($locale = app()->getLocale())
@php($isRtl = $locale === 'ar')
<html lang="{{ $locale }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $metaTitle ?? config('hala.site_name') }}</title>
    <meta name="description" content="{{ $metaDescription ?? config('hala.default_description') }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ $metaTitle ?? config('hala.site_name') }}">
    <meta property="og:description" content="{{ $metaDescription ?? config('hala.default_description') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @if(!empty($ogImage))
    <meta property="og:image" content="{{ $ogImage }}">
    @endif

    <meta name="theme-color" content="{{ config('hala.colors.primary') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/hala-logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/hala-logo.png') }}">


    {{-- JSON-LD (basic SEO) --}}
    @php($social = array_filter(config('hala.social') ?: []))
    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => config('hala.site_name'),
            'url' => url('/'),
            'logo' => asset('images/hala-logo.png'),
            'sameAs' => array_values($social),
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) !!}
    </script>

    <link rel="icon" type="image/png" href="{{ asset('images/hala-logo.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    @stack('head')
</head>

<body class="{{ $isRtl ? 'rtl' : '' }}">
    <a class="skip-link" href="#main">Skip to content</a>

    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="{{ route('home') }}">
                <img class="brand-logo" src="{{ asset('images/hala-logo.png') }}" alt="Hala logo">
            </a>

            <button class="nav-toggle" type="button" aria-label="Toggle menu" data-nav-toggle>
                <span></span><span></span><span></span>
            </button>

            <nav class="nav" data-nav>
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{
                    __('site.nav.home') }}</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">{{
                    __('site.nav.about') }}</a>
                <a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">{{
                    __('site.nav.services') }}</a>
                <a href="{{ route('shop') }}" class="{{ request()->routeIs('shop*') ? 'active' : '' }}">{{
                    __('site.nav.shop') }}</a>
                <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">{{
                    __('site.nav.contact') }}</a>

                <div class="nav-divider"></div>

                <a class="lang-switch" href="{{ url()->current() }}?lang={{ $isRtl ? 'en' : 'ar' }}">
                    {{ $isRtl ? 'EN' : 'AR' }}
                </a>
            </nav>
        </div>
    </header>

    <main id="main">
        @if(session('success'))
        <div class="container">
            <div class="alert success" data-animate="fade-up">{{ session('success') }}</div>
        </div>
        @endif

        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <img class="footer-logo" src="{{ asset('images/hala-logo.png') }}" alt="Hala logo">
                <p class="muted">{{ config('hala.default_description') }}</p>
            </div>

            <div>
                <h4>{{ __('site.footer.follow') }}</h4>
                <div class="social">
                    @php($social = config('hala.social'))
                    @if(!empty($social['instagram'])) <a target="_blank" rel="noopener"
                        href="{{ $social['instagram'] }}">Instagram</a> @endif
                    @if(!empty($social['facebook'])) <a target="_blank" rel="noopener"
                        href="{{ $social['facebook'] }}">Facebook</a> @endif
                    @if(!empty($social['tiktok'])) <a target="_blank" rel="noopener"
                        href="{{ $social['tiktok'] }}">TikTok</a> @endif
                </div>
            </div>

            <div>
                <h4>{{ __('site.nav.contact') }}</h4>
                <p class="muted">
                    {{ __('site.contact.subtitle') }}
                </p>
                <a class="btn btn-outline" href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a>
            </div>
        </div>

        <div class="container footer-bottom">
            <small>© {{ date('Y') }} {{ config('hala.site_name') }} — {{ __('site.footer.rights') }}</small>
            <a class="admin-link" href="{{ route('admin.login') }}">{{ __('site.nav.admin') }}</a>
        </div>
    </footer>

    @php($wa = preg_replace('/\D+/', '', (string) config('hala.whatsapp_number')))
    @if($wa)
    <a class="whatsapp-float" target="_blank" rel="noopener"
        href="https://wa.me/{{ env('WHATSAPP_NUMBER','96181447358') }}">
        <svg viewBox="0 0 32 32" aria-hidden="true">
            <path
                d="M19.11 17.53c-.27-.14-1.58-.78-1.82-.87-.24-.09-.42-.14-.6.14-.18.27-.69.87-.84 1.05-.15.18-.31.2-.58.07-.27-.14-1.12-.41-2.13-1.31-.79-.7-1.32-1.56-1.47-1.83-.15-.27-.02-.41.12-.55.12-.12.27-.31.4-.47.13-.16.18-.27.27-.45.09-.18.04-.34-.02-.47-.07-.14-.6-1.45-.82-1.98-.22-.53-.45-.46-.6-.47h-.51c-.18 0-.47.07-.71.34-.24.27-.93.91-.93 2.22s.95 2.58 1.08 2.76c.13.18 1.87 2.85 4.54 3.99.63.27 1.12.43 1.5.55.63.2 1.2.17 1.65.1.5-.07 1.58-.65 1.8-1.28.22-.63.22-1.16.16-1.28-.06-.12-.24-.2-.51-.34z" />
            <path
                d="M26.67 5.33A13.25 13.25 0 0 0 4.5 23.9L3 29l5.27-1.38A13.25 13.25 0 0 0 29 16.07c0-3.54-1.38-6.87-3.33-10.74zM16 27.1c-2.05 0-4.05-.56-5.79-1.62l-.41-.25-3.13.82.84-3.05-.27-.44A11.05 11.05 0 1 1 16 27.1z" />
        </svg>
    </a>

    @endif

    <script defer src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>