@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 style="margin-bottom:25px;">Edit Slider</h1>

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
        <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">
                <label>Judul Slider</label>
                <input type="text" name="title" value="{{ old('title', $slider->title) }}" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Subtitle / Deskripsi</label>
                <textarea name="subtitle" rows="4"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">{{ old('subtitle', $slider->subtitle) }}</textarea>
            </div>

            <div style="margin-bottom:20px;">
                <label>Gambar Saat Ini</label>
                <div style="margin-top:10px;">
                    <img src="{{ asset('storage/'.$slider->image) }}"
                         alt="{{ $slider->title }}"
                         style="width:220px; max-height:150px; object-fit:cover; border-radius:8px;">
                </div>
            </div>

            <div style="margin-bottom:20px;">
                <label>Ganti Gambar (Opsional)</label>
                <input type="file" name="image" accept="image/*"
                    style="display:block; margin-top:8px;">
                <small style="color:#777;">Kosongkan jika tidak ingin mengganti gambar. Maksimal 4 MB.</small>
            </div>

            <div style="margin-bottom:20px;">
                <label>Teks Tombol</label>
                <input type="text" name="button_text" value="{{ old('button_text', $slider->button_text) }}"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Link Tombol</label>
                <input type="text" name="button_link" value="{{ old('button_link', $slider->button_link) }}"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Urutan Slider</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $slider->sort_order) }}" min="0" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:25px;">
                <label>Status</label>
                <select name="is_active" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
                    <option value="1" {{ old('is_active', $slider->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active', $slider->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <button type="submit"
                    style="background:#556B2F; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;">
                    Update Slider
                </button>

                <a href="{{ route('admin.sliders.index') }}"
                   style="background:#eee; color:#333; padding:10px 20px; border-radius:8px; text-decoration:none;">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection