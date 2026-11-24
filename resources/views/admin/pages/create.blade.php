@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 style="margin-bottom:25px;">Tambah Halaman</h1>

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
        <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:20px;">
                <label>Judul Halaman</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Slug (Opsional)</label>
                <input type="text" name="slug" value="{{ old('slug') }}"
                    placeholder="Contoh: tentang-kami"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
                <small style="color:#777;">Kosongkan untuk dibuat otomatis dari judul.</small>
            </div>

            <div style="margin-bottom:20px;">
                <label>Isi Halaman</label>
                <textarea name="content" rows="10" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">{{ old('content') }}</textarea>
            </div>

            <div style="margin-bottom:20px;">
                <label>Gambar Halaman</label>
                <input type="file" name="featured_image" accept="image/*"
                    style="display:block; margin-top:8px;">
                <small style="color:#777;">Opsional, maksimal 2 MB.</small>
            </div>

            <div style="margin-bottom:20px;">
                <label>Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Meta Description</label>
                <textarea name="meta_description" rows="3"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">{{ old('meta_description') }}</textarea>
            </div>

            <div style="margin-bottom:25px;">
                <label>Status</label>
                <select name="is_active" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <button type="submit"
                    style="background:#556B2F; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;">
                    Simpan Halaman
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