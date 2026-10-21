
@extends('layouts.app')

@section('title', 'Create account — PurpFolio')

@section('content')
<div class="narrow card" style="margin:30px auto">
    <span class="eyebrow">Join PurpFolio</span>
    <h1 style="font-size:34px">Create your account</h1>
    <p class="muted">Start building your personal portfolio.</p>

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Full name</label>
            <input id="name" name="name" value="{{ old('name') }}"
                   required autocomplete="name">
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email') }}" required autocomplete="email">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password"
                   required minlength="8" autocomplete="new-password">
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm password</label>
            <input id="password_confirmation" name="password_confirmation"
                   type="password" required minlength="8"
                   autocomplete="new-password">
        </div>

        <button class="btn" style="width:100%" type="submit">Create account</button>
    </form>

    <p class="muted" style="text-align:center;margin-top:20px">
        Already registered? <a href="{{ route('login') }}">Log in</a>
    </p>
</div>
@endsection
