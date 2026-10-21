
@extends('layouts.app')

@section('title', 'Log In — PurpFolio')

@section('content')
<div class="narrow" style="margin:40px auto">
    <div class="card">
        <h1 style="font-size:32px">Welcome back</h1>
        <p class="muted">Log in to manage your portfolio.</p>

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label for="email">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                    autofocus
                >
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    autocomplete="current-password"
                    required
                >
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label style="display:flex;align-items:center;gap:8px">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        style="width:auto"
                    >
                    Remember me
                </label>
            </div>

            <button class="btn" type="submit" style="width:100%">
                Log in
            </button>
        </form>

        <p class="muted" style="text-align:center;margin-top:20px">
            Don't have an account?
            <a href="/register">Create one</a>
        </p>
    </div>
</div>
@endsection
