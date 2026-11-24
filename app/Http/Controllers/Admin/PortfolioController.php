<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Category;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(10);

        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer'],
            'client' => ['nullable', 'string', 'max:255'],
            'project_date' => ['nullable', 'date'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = $this->generateSlug($data['title']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')
                ->store('portfolios', 'public');
        }

        Portfolio::create($data);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil ditambahkan.');
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer'],
            'client' => ['nullable', 'string', 'max:255'],
            'project_date' => ['nullable', 'date'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['slug'] = $this->generateSlug(
            $data['title'],
            $portfolio->id
        );

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('cover_image')) {
            if ($portfolio->cover_image) {
                Storage::disk('public')->delete($portfolio->cover_image);
            }

            $data['cover_image'] = $request->file('cover_image')
                ->store('portfolios', 'public');
        }

        $portfolio->update($data);

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil diperbarui.');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->cover_image) {
            Storage::disk('public')->delete($portfolio->cover_image);
        }

        $portfolio->delete();

        return redirect()
            ->route('admin.portfolios.index')
            ->with('success', 'Portofolio berhasil dihapus.');
    }

    private function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (
            Portfolio::where('slug', $slug)
                ->when($ignoreId, function ($query, $id) {
                    $query->where('id', '!=', $id);
                })
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
