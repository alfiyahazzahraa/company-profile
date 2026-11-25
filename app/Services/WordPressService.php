<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class WordPressService
{
    private function client()
    {
        return Http::baseUrl(config('wordpress.api_url'))
            ->withBasicAuth(
                config('wordpress.username'),
                config('wordpress.password')
            )
            ->acceptJson()
            ->timeout(60);
    }

    public function createPost(array $data)
    {
        return $this->client()->post('/posts', $data);
    }

    public function updatePost(int $id, array $data)
    {
        return $this->client()->post("/posts/{$id}", $data);
    }

    public function deletePost(int $id)
    {
        return $this->client()->delete("/posts/{$id}");
    }

    public function getPosts()
    {
        return $this->client()->get('/posts');
    }

    public function getPost(int $id)
    {
        return $this->client()->get("/posts/{$id}");
    }

    /**
     * Upload thumbnail ke WordPress Media Library.
     */
    public function uploadMedia(string $path, string $filename)
    {
        $fileContents = Storage::disk('public')->get($path);

        return $this->client()
            ->attach('file', $fileContents, $filename)
            ->post('/media');
    }
}
