@extends('layouts.app')

@section('content')
<section class="page-hero">
    <div class="container" data-animate="fade-up">
        <h1>{{ __('site.contact.title') }}</h1>
        <p class="lead">{{ __('site.contact.subtitle') }}</p>
    </div>
</section>

<section class="section">
    <div class="container split">
        <div class="panel" data-animate="fade-up">
            <h2>{{ __('site.nav.contact') }}</h2>
            <p class="muted">{{ __('site.seo.contact_desc') }}</p>

            <div class="notice">
                <strong>Note:</strong>
                Prices vary by country and are shared directly after understanding your location and needs.
            </div>
        </div>

        <div class="panel" data-animate="fade-up" data-delay="120">
            <form method="POST" action="{{ route('contact.submit') }}" class="form">
                @csrf

                <div class="field">
                    <label>{{ __('site.contact.name') }}</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    @error('name') <small class="error">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label>{{ __('site.contact.email') }}</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <small class="error">{{ $message }}</small> @enderror
                </div>

                <div class="grid-2">
                    <div class="field">
                        <label>{{ __('site.contact.phone') }}</label>
                        <input type="text" name="phone" value="{{ old('phone') }}">
                        @error('phone') <small class="error">{{ $message }}</small> @enderror
                    </div>

                    <div class="field">
                        <label>{{ __('site.contact.country') }}</label>
                        <input type="text" name="country" value="{{ old('country') }}">
                        @error('country') <small class="error">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="field">
                    <label>{{ __('site.contact.message') }}</label>
                    <textarea name="message" rows="6" required>{{ old('message') }}</textarea>
                    @error('message') <small class="error">{{ $message }}</small> @enderror
                </div>

                <button class="btn" type="submit">{{ __('site.contact.send') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection
