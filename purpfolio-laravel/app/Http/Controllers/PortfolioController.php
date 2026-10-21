<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PortfolioController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $portfolios = $user->portfolios()
            ->latest()
            ->get();

        return view('dashboard', compact('portfolios'));
    }

    public function create()
    {
        $user = auth()->user();

        return view('portfolios.form', [
            'portfolio' => new Portfolio([
                'name' => $user->name,
                'email' => $user->email,
                'template' => 'modern',
                'skills' => [],
                'projects' => [],
                'socials' => [],
            ]),
            'isNew' => true,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['user_id'] = auth()->id();

        $portfolio = Portfolio::create($data);

        return redirect()
            ->route('portfolios.edit', $portfolio)
            ->with('success', 'Portfolio created successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        return view('portfolios.form', [
            'portfolio' => $portfolio,
            'isNew' => false,
        ]);
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        $data = $this->validatedData($request);

        $portfolio->fill($data);

        if ($portfolio->isDirty('title')) {
            $portfolio->slug = $this->uniqueSlug(
                $portfolio->title,
                $portfolio->id
            );
        }

        $portfolio->save();

        return redirect()
            ->route('portfolios.edit', $portfolio)
            ->with('success', 'Portfolio saved successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        $portfolio->delete();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Portfolio deleted.');
    }

    public function publish(Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        $portfolio->update([
            'is_published' => !$portfolio->is_published,
        ]);

        return back()->with(
            'success',
            $portfolio->is_published
                ? 'Your portfolio is now public.'
                : 'Your portfolio is now private.'
        );
    }

    public function preview(Portfolio $portfolio)
    {
        $this->authorizePortfolio($portfolio);

        return view('portfolios.show', compact('portfolio'));
    }

    public function publicShow(string $slug)
    {
        $portfolio = Portfolio::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('portfolios.show', compact('portfolio'));
    }

    private function authorizePortfolio(Portfolio $portfolio): void
    {
        abort_unless(
            (int) $portfolio->user_id === (int) auth()->id(),
            403
        );
    }

    private function uniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {
        $base = Str::slug($title) ?: 'portfolio';
        $slug = $base;
        $counter = 2;

        while (
            Portfolio::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    )
                )
                ->exists()
        ) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }

    private function validatedData(Request $request): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:5000'],
            'email' => ['nullable', 'email', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],

            'template' => [
                'required',
                Rule::in(['modern', 'simple', 'creative']),
            ],

            'skills_text' => ['nullable', 'string', 'max:5000'],
            'projects_text' => ['nullable', 'string', 'max:10000'],
            'github' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'avatar' => ['nullable', 'url', 'max:2048'],
        ]);

        $data['skills'] = collect(
            preg_split(
                '/[\r\n,]+/',
                $data['skills_text'] ?? ''
            ) ?: []
        )
            ->map(fn ($value) => trim($value))
            ->filter()
            ->unique()
            ->values()
            ->all();

        $data['projects'] = collect(
            preg_split(
                '/\r\n|\r|\n/',
                $data['projects_text'] ?? ''
            ) ?: []
        )
            ->map(fn ($line) => trim($line))
            ->filter()
            ->map(fn ($line) => [
                'title' => $line,
                'description' => '',
                'url' => '',
            ])
            ->values()
            ->all();

        $data['socials'] = collect([
            'github' => $data['github'] ?? '',
            'linkedin' => $data['linkedin'] ?? '',
            'website' => $data['website'] ?? '',
        ])
            ->filter()
            ->all();

        unset(
            $data['skills_text'],
            $data['projects_text'],
            $data['github'],
            $data['linkedin'],
            $data['website']
        );

        return $data;
    }
}
