
@extends('admin.layouts.app')

@section('content')

<div style="max-width:900px; margin:30px auto; padding:30px; background:#FAF9F4; border-radius:18px; box-shadow:0 4px 20px rgba(0,0,0,0.05);">

    <div style="margin-bottom:25px;">
        <h1 style="font-size:28px; font-weight:700; color:#405B45;">
            Tambah Kategori
        </h1>
        <p style="color:#899485; margin-top:5px;">
            Tambahkan kategori untuk mengelompokkan project portofolio.
        </p>
    </div>

    {{-- Error --}}
    @if ($errors->any())
        <div style="background:#F8DEDE; color:#842029; padding:15px; border-radius:10px; margin-bottom:20px;">
            <strong>Periksa kembali data berikut:</strong>
            <ul style="margin-top:10px; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        {{-- Nama --}}
        <div style="margin-bottom:20px;">
            <label style="display:block; font-weight:600; color:#465747; margin-bottom:8px;">
                Nama Kategori *
            </label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   placeholder="Contoh: Website, Branding, Desain Grafis"
                   style="width:100%; padding:12px; border:1px solid #D8DFD1; border-radius:10px;">
        </div>

        {{-- Deskripsi --}}
        <div style="margin-bottom:20px;">
            <label style="display:block; font-weight:600; color:#465747; margin-bottom:8px;">
                Deskripsi
            </label>

            <textarea name="description"
                      rows="5"
                      placeholder="Deskripsi kategori (opsional)"
                      style="width:100%; padding:12px; border:1px solid #D8DFD1; border-radius:10px; resize:vertical;">{{ old('description') }}</textarea>
        </div>

        {{-- Status --}}
        <div style="margin-bottom:25px; padding:15px; background:#DCE5D4; border-radius:10px;">
            <label style="display:flex; align-items:center; gap:10px; color:#405B45; font-weight:600;">
                <input type="checkbox"
                       name="is_active"
                       value="1"
                       {{ old('is_active', '1') ? 'checked' : '' }}>
                Kategori Aktif
            </label>

            <small style="display:block; margin-top:8px; color:#617A5B;">
                Kategori aktif dapat digunakan pada pengelolaan portofolio.
            </small>
        </div>

        {{-- Tombol --}}
        <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <button type="submit"
                    style="padding:12px 24px; background:#405B45; color:white; border:none; border-radius:10px; cursor:pointer; font-weight:600;">
                Simpan Kategori
            </button>

            <a href="{{ route('admin.categories.index') }}"
               style="padding:12px 24px; background:#DCE5D4; color:#405B45; border-radius:10px; text-decoration:none; font-weight:600;">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection
