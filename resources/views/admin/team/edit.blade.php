@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 style="margin-bottom:25px;">Edit Anggota Tim</h1>

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
        <form action="{{ route('admin.team.update', $team->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">
                <label>Nama</label>
                <input type="text" name="name" value="{{ old('name', $team->name) }}" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Posisi / Jabatan</label>
                <input type="text" name="position" value="{{ old('position', $team->position) }}" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Foto Saat Ini</label>

                @if($team->photo)
                    <div style="margin-top:10px;">
                        <img src="{{ asset('storage/'.$team->photo) }}"
                             alt="{{ $team->name }}"
                             style="width:120px; height:120px; object-fit:cover; border-radius:50%;">
                    </div>
                @else
                    <p style="color:#777;">Belum ada foto.</p>
                @endif
            </div>

            <div style="margin-bottom:20px;">
                <label>Ganti Foto (Opsional)</label>
                <input type="file" name="photo" accept="image/*"
                    style="display:block; margin-top:8px;">
                <small style="color:#777;">Kosongkan jika tidak ingin mengganti foto. Maksimal 2 MB.</small>
            </div>

            <div style="margin-bottom:20px;">
                <label>Bio / Deskripsi</label>
                <textarea name="bio" rows="5"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">{{ old('bio', $team->bio) }}</textarea>
            </div>

            <div style="margin-bottom:20px;">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $team->email) }}"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>LinkedIn</label>
                <input type="url" name="linkedin" value="{{ old('linkedin', $team->linkedin) }}"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Urutan</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $team->sort_order) }}" min="0" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:25px;">
                <label>Status</label>
                <select name="is_active" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
                    <option value="1" {{ old('is_active', $team->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active', $team->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <button type="submit"
                    style="background:#556B2F; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;">
                    Update Anggota
                </button>

                <a href="{{ route('admin.team.index') }}"
                   style="background:#eee; color:#333; padding:10px 20px; border-radius:8px; text-decoration:none;">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection