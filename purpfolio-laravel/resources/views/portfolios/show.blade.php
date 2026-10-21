
@extends('layouts.app')

@section('title', $portfolio->name . ' — Portfolio')

@section('content')
<div class="portfolio-content">
    @if(! $portfolio->is_published)
        <div class="notice">
            This is a private preview. Only the portfolio owner can access it.
        </div>
    @endif

    <section class="portfolio-hero template-{{ in_array($portfolio->template, ['modern', 'simple', 'creative'], true) ? $portfolio->template : 'modern' }}">
        <div style="display:flex;align-items:center;gap:24px;flex-wrap:wrap">
            @if($portfolio->avatar)
                <img class="avatar" src="{{ $portfolio->avatar }}"
                     alt="{{ $portfolio->name }} profile photo">
            @else
                <div class="avatar" aria-hidden="true">
                    {{ strtoupper(substr($portfolio->name, 0, 1)) }}
                </div>
            @endif

            <div style="flex:1;min-width:200px">
                <span class="eyebrow">Personal portfolio</span>
                <h1>{{ $portfolio->name }}</h1>
                @if($portfolio->headline)
                    <h2 style="font-size:21px;font-weight:600">
                        {{ $portfolio->headline }}
                    </h2>
                @endif
                @if($portfolio->location)
                    <p class="muted">⌖ {{ $portfolio->location }}</p>
                @endif
                @if($portfolio->email)
                    <a class="btn" href="mailto:{{ $portfolio->email }}">Contact me</a>
                @endif
            </div>
        </div>
    </section>

    @if($portfolio->bio)
        <section class="section">
            <h2 class="section-title">About me</h2>
            <p style="white-space:pre-line">{{ $portfolio->bio }}</p>
        </section>
    @endif

    @if(count($portfolio->skills ?? []))
        <section class="section">
            <h2 class="section-title">Skills</h2>
            <ul class="skill-list">
                @foreach($portfolio->skills as $skill)
                    <li>{{ $skill }}</li>
                @endforeach
            </ul>
        </section>
    @endif

    @if(count($portfolio->projects ?? []))
        <section class="section">
            <h2 class="section-title">Projects</h2>
            @foreach($portfolio->projects as $project)
                <article class="project">
                    <h3>{{ $project['title'] ?? 'Untitled project' }}</h3>
                    @if(!empty($project['description']))
                        <p class="muted">{{ $project['description'] }}</p>
                    @endif
                    @if(!empty($project['url']))
                        <a href="{{ $project['url'] }}" target="_blank" rel="noopener noreferrer">
                            View project ↗
                        </a>
                    @endif
                </article>
            @endforeach
        </section>
    @endif

    @if(count($portfolio->socials ?? []))
        <section class="section">
            <h2 class="section-title">Find me online</h2>
            <div class="actions">
                @foreach($portfolio->socials as $network => $url)
                    <a class="btn secondary" href="{{ $url }}"
                       target="_blank" rel="noopener noreferrer">
                        {{ ucfirst($network) }} ↗
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    @auth
        @if(auth()->id() === $portfolio->user_id)
            <div class="card" style="margin:30px 0">
                <p><strong>Portfolio owner controls</strong></p>
                <div class="actions">
                    <a class="btn" href="{{ route('portfolios.edit', $portfolio) }}">Edit portfolio</a>
                    <a class="btn secondary" href="{{ route('dashboard') }}">Dashboard</a>
                </div>
            </div>
        @endif
    @endauth
</div>
@endsection
