
@extends('layouts.app')

@section('title', 'Create Account — PurpFolio')

@section('content')
<div class="narrow" style="margin:40px auto">
    <div class="card">
        <h1 style="font-size:32px">Create your account</h1>
        <p class="muted">Start building your professional portfolio.</p>

        <form method="POST" action="/register">
            @csrf

            <div class="form-group">
                <label for="name">Full name</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    required
                    autofocus
                >
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
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
                    autocomplete="new-password"
                    minlength="8"
                    required
                >
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    autocomplete="new-password"
                    minlength="8"
                    required
                >
            </div>

            <button class="btn" type="submit" style="width:100%">
                Create account
            </button>
        </form>

        <p class="muted" style="text-align:center;margin-top:20px">
            Already have an account?
            <a href="/login">Log in</a>
        </p>
    </div>
</div>
@endsection
