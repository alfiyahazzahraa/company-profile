<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Services\WordPressService;
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

    public function store(StorePostRequest $request, WordPressService $wordpress)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $baseSlug = Str::slug($data['slug'] ?: $data['title']);
        $data['slug'] = $this->generateUniqueSlug($baseSlug);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');

            // Upload thumbnail ke WordPress Media Library
            $mediaResponse = $wordpress->uploadMedia(
                $data['thumbnail'],
                basename($data['thumbnail'])
            );

            if (!$mediaResponse->successful()) {
                Storage::disk('public')->delete($data['thumbnail']);

                return back()->withInput()->with(
                    'error',
                    'Gagal mengupload gambar ke WordPress.'
                );
            }

            $mediaId = $mediaResponse->json('id');

            if (!$mediaId) {
                Storage::disk('public')->delete($data['thumbnail']);

                return back()->withInput()->with(
                    'error',
                    'WordPress tidak mengembalikan ID gambar.'
                );
            }
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = $data['published_at'] ?? now();
        } else {
            $data['published_at'] = null;
        }

        $wpData = [
            'title'   => $data['title'],
            'slug'    => $data['slug'],
            'content' => $data['content'],
            'status'  => $data['status'] === 'published' ? 'publish' : 'draft',
        ];

        // Jadikan gambar sebagai Featured Image WordPress
        if (!empty($mediaId)) {
            $wpData['featured_media'] = $mediaId;
        }

        $response = $wordpress->createPost($wpData);

        if (!$response->successful()) {
            if (!empty($data['thumbnail'])) {
                Storage::disk('public')->delete($data['thumbnail']);
            }

            return back()->withInput()->with(
                'error',
                'Gagal mengirim berita ke WordPress.'
            );
        }

        $wpPostId = $response->json('id');

        if (!$wpPostId) {
            if (!empty($data['thumbnail'])) {
                Storage::disk('public')->delete($data['thumbnail']);
            }

            return back()->withInput()->with(
                'error',
                'WordPress tidak mengembalikan ID berita.'
            );
        }

        $data['wp_post_id'] = $wpPostId;

        Post::create($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Berita berhasil ditambahkan ke WordPress.');
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(
        UpdatePostRequest $request,
        Post $post,
        WordPressService $wordpress
    ) {
        $data = $request->validated();

        $baseSlug = Str::slug($data['slug'] ?: $data['title']);
        $data['slug'] = $this->generateUniqueSlug($baseSlug, $post->id);

        $newThumbnail = null;
        $mediaId = null;

        // Upload gambar baru jika user memilih gambar
        if ($request->hasFile('thumbnail')) {
            $newThumbnail = $request->file('thumbnail')->store('posts', 'public');

            $mediaResponse = $wordpress->uploadMedia(
                $newThumbnail,
                basename($newThumbnail)
            );

            if (!$mediaResponse->successful()) {
                Storage::disk('public')->delete($newThumbnail);

                return back()->withInput()->with(
                    'error',
                    'Gagal mengupload gambar baru ke WordPress.'
                );
            }

            $mediaId = $mediaResponse->json('id');

            if (!$mediaId) {
                Storage::disk('public')->delete($newThumbnail);

                return back()->withInput()->with(
                    'error',
                    'WordPress tidak mengembalikan ID gambar.'
                );
            }
        }

        if ($data['status'] === 'published') {
            $data['published_at'] = $data['published_at']
                ?? $post->published_at
                ?? now();
        } else {
            $data['published_at'] = null;
        }

        $wpData = [
            'title'   => $data['title'],
            'slug'    => $data['slug'],
            'content' => $data['content'],
            'status'  => $data['status'] === 'published' ? 'publish' : 'draft',
        ];

        // Update Featured Image hanya jika ada gambar baru
        if ($mediaId) {
            $wpData['featured_media'] = $mediaId;
        }

        if (!$post->wp_post_id) {
            $response = $wordpress->createPost($wpData);
        } else {
            $response = $wordpress->updatePost($post->wp_post_id, $wpData);
        }

        if (!$response->successful()) {
            if ($newThumbnail) {
                Storage::disk('public')->delete($newThumbnail);
            }

            return back()->withInput()->with(
                'error',
                'Gagal memperbarui berita WordPress.'
            );
        }

        if (!$post->wp_post_id) {
            $data['wp_post_id'] = $response->json('id');
        }

        // Ganti thumbnail lokal setelah update WordPress berhasil
        if ($newThumbnail) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }

            $data['thumbnail'] = $newThumbnail;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Post $post, WordPressService $wordpress)
    {
        if ($post->wp_post_id) {
            $response = $wordpress->deletePost($post->wp_post_id);

            if (!$response->successful()) {
                return redirect()->route('admin.posts.index')
                    ->with('error', 'Gagal menghapus berita dari WordPress.');
            }
        }

        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    private function generateUniqueSlug(string $slug, ?int $ignoreId = null): string
    {
        $slug = $slug ?: 'artikel';
        $originalSlug = $slug;
        $counter = 1;

        while (
            Post::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
