<!doctype html>
@php($locale = app()->getLocale())
@php($isRtl = $locale === 'ar')
<html lang="{{ $locale }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $metaTitle ?? ('Admin | '.config('hala.site_name')) }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body class="admin {{ $isRtl ? 'rtl' : '' }}">
    <header class="admin-header">
        <div class="container header-inner">
            <a class="brand" href="{{ route('admin.dashboard') }}">
                <img class="brand-logo" src="{{ asset('images/hala-logo.png') }}" alt="Hala logo">
                <span class="admin-title">Admin Panel</span>
            </a>

            <button class="admin-nav-toggle" type="button" aria-controls="adminNav" aria-expanded="false">
                <span class="bars" aria-hidden="true"></span>
                <span class="sr-only">Menu</span>
            </button>

            <nav id="adminNav" class="admin-nav">

                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.categories.index') }}"
                    class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a>
                <a href="{{ route('admin.products.index') }}"
                    class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a>
                <a href="{{ route('admin.messages.index') }}">Messages</a>


                <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                    @csrf
                    <button class="btn btn-ghost" type="submit">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="admin-main">
        <div class="container">
            @if(session('success'))
            <div class="alert success" data-animate="fade-up">{{ session('success') }}</div>
            @endif
            @if($errors->any())
            <div class="alert danger" data-animate="fade-up">
                <strong>Fix the following:</strong>
                <ul>
                    @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script defer src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>