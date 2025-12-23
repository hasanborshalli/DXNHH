@extends('layouts.app')

@section('content')
<section class="page-hero">
    <div class="container" data-animate="fade-up">
        <h1>Admin Login</h1>
        <p class="lead">Sign in to manage products and categories.</p>
    </div>
</section>

<section class="section">
    <div class="container narrow">
        <div class="panel" data-animate="fade-up">
            <form method="POST" action="{{ route('admin.login.submit') }}" class="form">
                @csrf

                <div class="field">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email') <small class="error">{{ $message }}</small> @enderror
                </div>

                <div class="field">
                    <label>Password</label>
                    <input type="password" name="password" required>
                    @error('password') <small class="error">{{ $message }}</small> @enderror
                </div>

                <button class="btn" type="submit">Login</button>
            </form>
        </div>
    </div>
</section>
@endsection
