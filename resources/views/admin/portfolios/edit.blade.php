
@extends('admin.layouts.app')

@section('title', 'Edit Portfolio')
@section('header', 'Edit Portfolio')

@section('content')

<div style="max-width:900px; margin:30px auto; padding:30px; background:#FAF9F4; border-radius:18px; box-shadow:0 4px 20px rgba(0,0,0,0.05);">

    <div style="margin-bottom:25px;">
        <h1 style="font-size:28px; font-weight:700; color:#405B45; margin-bottom:8px;">
            Edit Portofolio
        </h1>
        <p style="color:#899485;">
            Perbarui informasi project portofolio.
        </p>
    </div>

    {{-- Error --}}
    @if ($errors->any())
        <div style="background:#F8DEDE; color:#842029; padding:15px; border-radius:10px; margin-bottom:20px;">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul style="margin-top:10px; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.portfolios.update', $portfolio->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')

        {{-- Judul --}}
        <div style="margin-bottom:20px;">
            <label for="title" style="display:block; font-weight:600; color:#465747; margin-bottom:8px;">
                Nama Project *
            </label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $portfolio->title) }}"
                required
                style="width:100%; padding:12px; border:1px solid #D8DFD1; border-radius:10px; outline:none; box-sizing:border-box;"
            >
        </div>

        {{-- Client --}}
        <div style="margin-bottom:20px;">
            <label for="client" style="display:block; font-weight:600; color:#465747; margin-bottom:8px;">
                Client
            </label>

            <input
                type="text"
                id="client"
                name="client"
                value="{{ old('client', $portfolio->client) }}"
                placeholder="Nama client"
                style="width:100%; padding:12px; border:1px solid #D8DFD1; border-radius:10px; box-sizing:border-box;"
            >
        </div>

        {{-- Tanggal --}}
        <div style="margin-bottom:20px;">
            <label for="project_date" style="display:block; font-weight:600; color:#465747; margin-bottom:8px;">
                Tanggal Project
            </label>

            <input
                type="date"
                id="project_date"
                name="project_date"
                value="{{ old('project_date', $portfolio->project_date ? $portfolio->project_date->format('Y-m-d') : '') }}"
                style="width:100%; padding:12px; border:1px solid #D8DFD1; border-radius:10px; box-sizing:border-box;"
            >
        </div>

        {{-- Kategori --}}
        <div style="margin-bottom:20px;">
            <label for="category_id" style="display:block; font-weight:600; color:#465747; margin-bottom:8px;">
                Kategori
            </label>

            <select
                id="category_id"
                name="category_id"
                style="width:100%; padding:12px; border:1px solid #D8DFD1; border-radius:10px; background:#FAF9F4; box-sizing:border-box;"
            >
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $portfolio->category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <small style="display:block; color:#899485; margin-top:8px;">
                Pilih kategori yang sesuai dengan project.
            </small>
        </div>

        {{-- Cover image --}}
        <div style="margin-bottom:20px;">
            <label for="cover_image" style="display:block; font-weight:600; color:#465747; margin-bottom:8px;">
                Cover Image
            </label>

            @if ($portfolio->cover_image)
                <div style="margin-bottom:15px;">
                    <p style="color:#899485; font-size:14px; margin-bottom:8px;">
                        Gambar saat ini:
                    </p>

                    <img
                        src="{{ asset('storage/' . $portfolio->cover_image) }}"
                        alt="Cover portofolio"
                        style="max-width:250px; max-height:200px; object-fit:cover; border-radius:12px; border:1px solid #D8DFD1;"
                    >
                </div>
            @endif

            <input
                type="file"
                id="cover_image"
                name="cover_image"
                accept="image/jpeg,image/png,image/webp"
                style="width:100%; padding:12px; border:1px solid #D8DFD1; border-radius:10px; box-sizing:border-box;"
            >

            <small style="display:block; color:#899485; margin-top:8px;">
                Upload gambar baru jika ingin mengganti cover. Maksimal 2 MB.
            </small>
        </div>

        {{-- Deskripsi --}}
        <div style="margin-bottom:20px;">
            <label for="description" style="display:block; font-weight:600; color:#465747; margin-bottom:8px;">
                Deskripsi Project
            </label>

            <textarea
                id="description"
                name="description"
                rows="5"
                placeholder="Deskripsikan project..."
                style="width:100%; padding:12px; border:1px solid #D8DFD1; border-radius:10px; resize:vertical; box-sizing:border-box;"
            >{{ old('description', $portfolio->description) }}</textarea>
        </div>

        {{-- Status --}}
        <div style="margin-bottom:25px; padding:15px; background:#DCE5D4; border-radius:10px;">
            <label style="display:flex; align-items:center; gap:10px; color:#405B45; font-weight:600;">
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    {{ old('is_active', $portfolio->is_active) ? 'checked' : '' }}
                >
                Project Aktif
            </label>

            <small style="display:block; margin-top:8px; color:#617A5B;">
                Centang jika project ingin ditampilkan di website.
            </small>
        </div>

        {{-- Tombol --}}
        <div style="display:flex; gap:12px; flex-wrap:wrap;">
            <button
                type="submit"
                style="padding:12px 24px; background:#405B45; color:white; border:none; border-radius:10px; cursor:pointer; font-weight:600;"
            >
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.portfolios.index') }}"
                style="padding:12px 24px; background:#DCE5D4; color:#405B45; border-radius:10px; text-decoration:none; font-weight:600;"
            >
                Batal
            </a>
        </div>

    </form>
</div>

@endsection
    