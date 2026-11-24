@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 style="margin-bottom:25px;">Edit Halaman</h1>

    @if ($errors->any())
        <div style="background:#fee2e2; color:#991b1b; padding:15px; border-radius:8px; margin-bottom:20px;">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background:white; padding:25px; border-radius:12px;">
        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">
                <label>Judul Halaman</label>
                <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $page->slug) }}"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Isi Halaman</label>
                <textarea name="content" rows="10" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">{{ old('content', $page->content) }}</textarea>
            </div>

            <div style="margin-bottom:20px;">
                <label>Gambar Saat Ini</label>

                @if($page->featured_image)
                    <div style="margin-top:10px;">
                        <img src="{{ asset('storage/'.$page->featured_image) }}"
                             alt="Gambar halaman"
                             style="width:180px; max-height:150px; object-fit:contain;">
                    </div>
                @else
                    <p style="color:#777;">Belum ada gambar.</p>
                @endif
            </div>

            <div style="margin-bottom:20px;">
                <label>Ganti Gambar (Opsional)</label>
                <input type="file" name="featured_image" accept="image/*"
                    style="display:block; margin-top:8px;">
                <small style="color:#777;">Kosongkan jika tidak ingin mengganti gambar. Maksimal 2 MB.</small>
            </div>

            <div style="margin-bottom:20px;">
                <label>Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Meta Description</label>
                <textarea name="meta_description" rows="3"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">{{ old('meta_description', $page->meta_description) }}</textarea>
            </div>

            <div style="margin-bottom:25px;">
                <label>Status</label>
                <select name="is_active" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
                    <option value="1" {{ old('is_active', $page->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active', $page->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <button type="submit"
                    style="background:#556B2F; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;">
                    Update Halaman
                </button>

                <a href="{{ route('admin.pages.index') }}"
                   style="background:#eee; color:#333; padding:10px 20px; border-radius:8px; text-decoration:none;">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection