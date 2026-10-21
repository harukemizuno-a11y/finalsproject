
@extends('layouts.app')

@section('title', 'Dashboard — PurpFolio')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;gap:16px;flex-wrap:wrap">
    <div>
        <span class="eyebrow">Your workspace</span>
        <h1 style="font-size:38px">Hello, {{ auth()->user()->name }}!</h1>
        <p class="muted">Manage your portfolios and share your work.</p>
    </div>
    <a class="btn" href="{{ route('portfolios.create') }}">+ Create portfolio</a>
</div>

<div class="grid" style="margin-top:28px">
    <div class="card">
        <p class="muted">Total portfolios</p>
        <div style="font-size:34px;font-weight:800">{{ $portfolios->count() }}</div>
    </div>
    <div class="card">
        <p class="muted">Published</p>
        <div style="font-size:34px;font-weight:800">
            {{ $portfolios->where('is_published', true)->count() }}
        </div>
    </div>
    <div class="card">
        <p class="muted">Drafts</p>
        <div style="font-size:34px;font-weight:800">
            {{ $portfolios->where('is_published', false)->count() }}
        </div>
    </div>
</div>

<section class="section">
    <h2>Your portfolios</h2>

    @forelse($portfolios as $portfolio)
        <article class="card" style="margin-bottom:16px">
            <div style="display:flex;justify-content:space-between;gap:18px;flex-wrap:wrap">
                <div>
                    <span class="badge">{{ ucfirst($portfolio->template) }} template</span>
                    <h2 style="margin:12px 0 4px">{{ $portfolio->title }}</h2>
                    <p class="muted" style="margin:0">
                        {{ $portfolio->name }}
                        · {{ $portfolio->is_published ? 'Published' : 'Draft' }}
                    </p>
                    @if($portfolio->is_published)
                        <p><a href="{{ route('portfolios.public', $portfolio->slug) }}" target="_blank" rel="noopener">/p/{{ $portfolio->slug }} ↗</a></p>
                    @endif
                </div>

                <div class="actions">
                    <a class="btn secondary small" href="{{ route('portfolios.edit', $portfolio) }}">Edit</a>
                    <a class="btn secondary small" href="{{ route('portfolios.preview', $portfolio) }}">Preview</a>

                    <form method="POST" action="{{ route('portfolios.publish', $portfolio) }}">
                        @csrf
                        @method('PATCH')
                        <button class="btn small" type="submit">
                            {{ $portfolio->is_published ? 'Unpublish' : 'Publish' }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('portfolios.destroy', $portfolio) }}"
                          onsubmit="return confirm('Delete this portfolio permanently?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn danger small" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </article>
    @empty
        <div class="card" style="text-align:center;padding:48px 20px">
            <div style="font-size:40px">✦</div>
            <h2>Your first portfolio starts here</h2>
            <p class="muted">Add your profile, skills, and projects to create your first portfolio.</p>
            <a class="btn" href="{{ route('portfolios.create') }}">Create your first portfolio</a>
        </div>
    @endforelse
</section>
@endsection
