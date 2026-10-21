
@extends('layouts.app')

@section('title', 'PurpFolio — Your work, beautifully presented')

@section('content')
<section class="hero">
    <span class="eyebrow">Your career, your story</span>
    <h1>Build a portfolio<br>that opens doors.</h1>
    <p class="muted" style="max-width:570px;font-size:18px">
        Bring your skills, projects, and experience together in one
        beautiful portfolio. Create it, customize it, and share your work.
    </p>
    <div class="actions" style="margin-top:25px">
        <a class="btn" href="{{ route('register') }}">Create my portfolio →</a>
        <a class="btn secondary" href="{{ route('login') }}">I already have an account</a>
    </div>
</section>

<section class="section">
    <h2 class="section-title">Everything you need to stand out</h2>
    <p class="muted">A simple way to turn your experience into your online presence.</p>

    <div class="grid" style="margin-top:24px">
        <article class="card">
            <h3>✦ Personal profile</h3>
            <p class="muted">Introduce yourself, share your background, and highlight your strengths.</p>
        </article>
        <article class="card">
            <h3>▤ Showcase projects</h3>
            <p class="muted">Present your work, skills, and achievements in an organized layout.</p>
        </article>
        <article class="card">
            <h3>↗ Share your work</h3>
            <p class="muted">Publish a portfolio with its own link when you're ready.</p>
        </article>
    </div>
</section>

<section class="section">
    <div class="card" style="text-align:center;padding:38px">
        <h2>Start building your future today.</h2>
        <p class="muted">Your next opportunity starts with showing what you can do.</p>
        <a class="btn" href="{{ route('register') }}">Get started for free</a>
    </div>
</section>
@endsection
