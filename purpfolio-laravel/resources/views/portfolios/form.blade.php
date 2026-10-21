
@extends('layouts.app')

@section('title', ($isNew ? 'Create' : 'Edit') . ' portfolio — PurpFolio')

@section('content')
<div style="max-width:800px;margin:auto">
    <a href="{{ route('dashboard') }}">← Back to dashboard</a>
    <span class="eyebrow" style="display:block;margin-top:22px">
        Portfolio builder
    </span>
    <h1 style="font-size:38px">
        {{ $isNew ? 'Create your portfolio' : 'Edit your portfolio' }}
    </h1>
    <p class="muted">Add your details, choose a design, and save your changes.</p>

    <form method="POST"
          action="{{ $isNew ? route('portfolios.store') : route('portfolios.update', $portfolio) }}">
        @csrf
        @unless($isNew)
            @method('PUT')
        @endunless

        <section class="card" style="margin:22px 0">
            <h2>01. Basic information</h2>

            <div class="form-group">
                <label for="title">Portfolio title</label>
                <input id="title" name="title" required maxlength="255"
                       value="{{ old('title', $portfolio->title) }}">
                @error('title') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="name">Your full name</label>
                <input id="name" name="name" required maxlength="255"
                       value="{{ old('name', $portfolio->name) }}">
                @error('name') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="headline">Professional title</label>
                <input id="headline" name="headline" maxlength="255"
                       placeholder="e.g. Web Developer & UI Designer"
                       value="{{ old('headline', $portfolio->headline) }}">
                @error('headline') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="bio">About me</label>
                <textarea id="bio" name="bio" maxlength="5000"
                          placeholder="Tell people about yourself...">{{ old('bio', $portfolio->bio) }}</textarea>
                @error('bio') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Contact email</label>
                <input id="email" type="email" name="email"
                       value="{{ old('email', $portfolio->email) }}">
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input id="location" name="location"
                       value="{{ old('location', $portfolio->location) }}"
                       placeholder="e.g. Philippines">
                @error('location') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="avatar">Profile photo URL (optional)</label>
                <input id="avatar" type="url" name="avatar"
                       value="{{ old('avatar', $portfolio->avatar) }}"
                       placeholder="https://example.com/photo.jpg">
                @error('avatar') <div class="error">{{ $message }}</div> @enderror
            </div>
        </section>

        <section class="card" style="margin:22px 0">
            <h2>02. Skills and projects</h2>

            <div class="form-group">
                <label for="skills_text">Skills</label>
                <textarea id="skills_text" name="skills_text"
                          placeholder="HTML, CSS, JavaScript, Laravel">{{ old('skills_text', implode(', ', $portfolio->skills ?? [])) }}</textarea>
                <p class="muted" style="font-size:13px">Separate skills with commas or new lines.</p>
                @error('skills_text') <div class="error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="projects_text">Projects</label>
                <textarea id="projects_text" name="projects_text"
                          placeholder="Personal Portfolio Website&#10;E-commerce System&#10;Student Management System">{{ old('projects_text', collect($portfolio->projects ?? [])->pluck('title')->implode("\n")) }}</textarea>
                <p class="muted" style="font-size:13px">Enter one project title per line.</p>
                @error('projects_text') <div class="error">{{ $message }}</div> @enderror
            </div>
        </section>

        <section class="card" style="margin:22px 0">
            <h2>03. Social links</h2>

            @foreach(['github' => 'GitHub URL', 'linkedin' => 'LinkedIn URL', 'website' => 'Personal website URL'] as $key => $label)
                <div class="form-group">
                    <label for="{{ $key }}">{{ $label }}</label>
                    <input type="url" id="{{ $key }}" name="{{ $key }}"
                           value="{{ old($key, data_get($portfolio->socials ?? [], $key)) }}"
                           placeholder="https://...">
                    @error($key) <div class="error">{{ $message }}</div> @enderror
                </div>
            @endforeach
        </section>

        <section class="card" style="margin:22px 0">
            <h2>04. Choose a template</h2>
            <div class="form-group">
                <label for="template">Design</label>
                <select id="template" name="template" required>
                    <option value="modern" @selected(old('template', $portfolio->template) === 'modern')>
                        Modern — soft purple background
                    </option>
                    <option value="simple" @selected(old('template', $portfolio->template) === 'simple')>
                        Simple — clean white background
                    </option>
                    <option value="creative" @selected(old('template', $portfolio->template) === 'creative')>
                     Creative — bold purple gradient
                </option>
                </select>
                @error('template') <div class="error">{{ $message }}</div> @enderror
            </div>
        </section>

        <div class="actions" style="margin:24px 0 45px">
            <button class="btn" type="submit">
                {{ $isNew ? 'Create portfolio' : 'Save changes' }}
            </button>
            @unless($isNew)
                <a class="btn secondary" href="{{ route('portfolios.preview', $portfolio) }}">
                    Preview
                </a>
            @endunless
            <a class="btn secondary" href="{{ route('dashboard') }}">Cancel</a>
        </div>
    </form>
</div>
@endsection
