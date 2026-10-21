
@extends('layouts.app')

@section('title', 'Log in — PurpFolio')

@section('content')
<div class="narrow card" style="margin:30px auto">
    <span class="eyebrow">Welcome back</span>
    <h1 style="font-size:34px">Log in</h1>
    <p class="muted">Continue working on your portfolio.</p>

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email') }}" required autocomplete="email">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password"
                   required autocomplete="current-password">
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        <label style="display:flex;align-items:center;gap:9px;margin-bottom:20px">
            <input style="width:auto" type="checkbox" name="remember" value="1">
            Remember me
        </label>

        <button class="btn" style="width:100%" type="submit">Log in</button>
    </form>

    <p class="muted" style="text-align:center;margin-top:20px">
        New to PurpFolio? <a href="{{ route('register') }}">Create an account</a>
    </p>
</div>
@endsection
