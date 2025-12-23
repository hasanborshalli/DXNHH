@extends('layouts.app')

@section('content')
<section class="page-hero">
    <div class="container" data-animate="fade-up">
        <h1>{{ __('site.nav.services') }}</h1>
        <p class="lead">{{ __('site.dxn.business_p1') }}</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid cards">
            @foreach(__('site.services.items') as $item)
                <article class="card" data-animate="fade-up">
                    <div class="card-body">
                        <h3>{{ $item['title'] }}</h3>
                        <p class="muted">{{ $item['desc'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="cta" data-animate="fade-up">
            <div>
                <h3>{{ __('site.sections.get_started') }}</h3>
                <p class="muted">{{ __('site.dxn.business_p2') }}</p>
            </div>
            <a class="btn" href="{{ route('contact') }}">{{ __('site.nav.contact') }}</a>
        </div>
    </div>
</section>
@endsection
