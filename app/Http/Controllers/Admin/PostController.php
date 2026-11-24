<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['category', 'author'])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        // Mengambil ID admin yang sedang login
        $data['user_id'] = auth()->id();

        // Membuat slug otomatis dan memastikan slug unik
        $baseSlug = Str::slug($data['slug'] ?: $data['title']);
        $data['slug'] = $this->generateUniqueSlug($baseSlug);

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('posts', 'public');
        }

        // Mengatur tanggal publikasi berdasarkan status
        if ($data['status'] === 'published') {
            $data['published_at'] = $data['published_at'] ?? now();
        } else {
            $data['published_at'] = null;
        }

        // Menyimpan berita
        Post::create($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();

        // Membuat slug unik, kecuali slug milik berita ini sendiri
        $baseSlug = Str::slug($data['slug'] ?: $data['title']);
        $data['slug'] = $this->generateUniqueSlug($baseSlug, $post->id);

        // Upload thumbnail baru jika tersedia
        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')
                ->store('posts', 'public');
        }

        // Mengatur tanggal publikasi
        if ($data['status'] === 'published') {
            $data['published_at'] = $data['published_at']
                ?? $post->published_at
                ?? now();
        } else {
            $data['published_at'] = null;
        }

        // Memperbarui berita
        $post->update($data);

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        // Menghapus thumbnail jika ada
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        // Menghapus data berita
        $post->delete();

        return redirect()
            ->route('admin.posts.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    // Membuat slug unik
    private function generateUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $slug = $slug ?: 'artikel';

        $originalSlug = $slug;
        $counter = 1;

        while (
            Post::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
