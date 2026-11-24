
@extends('admin.layouts.app')

@section('title', 'Tambah Portfolio')
@section('header', 'Tambah Portfolio')

@section('content')

<style>
    .portfolio-form-container {
        background: #FAF7F2;
        border: 1px solid #D5C6B5;
        border-radius: 14px;
        padding: 24px;
    }

    .portfolio-form-group {
        margin-bottom: 20px;
    }

    .portfolio-form-group label {
        display: block;
        margin-bottom: 8px;
        color: #514538;
        font-weight: 600;
    }

    .portfolio-form-group input,
    .portfolio-form-group textarea,
    .portfolio-form-group select {
        width: 100%;
        padding: 12px;
        border: 1px solid #D5C6B5;
        border-radius: 8px;
        background: #FAF9F4;
        color: #514538;
        font-family: inherit;
        box-sizing: border-box;
    }

    .portfolio-form-group input:focus,
    .portfolio-form-group textarea:focus,
    .portfolio-form-group select:focus {
        outline: none;
        border-color: #76614A;
        box-shadow: 0 0 0 2px rgba(118, 97, 74, 0.12);
    }

    .portfolio-form-group textarea {
        min-height: 150px;
        resize: vertical;
    }

    .portfolio-form-group small {
        display: block;
        margin-top: 6px;
        color: #897967;
    }

    .portfolio-checkbox-group {
        margin-bottom: 24px;
    }

    .portfolio-checkbox-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #514538;
    }

    .portfolio-checkbox-group input {
        accent-color: #76614A;
    }

    .portfolio-form-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 24px;
    }

    .portfolio-submit-button {
        background: #76614A;
        color: white;
        padding: 11px 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 14px;
    }

    .portfolio-submit-button:hover {
        background: #514538;
    }

    .portfolio-cancel-button {
        background: #E7DDD0;
        color: #514538;
        padding: 11px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
    }

    .portfolio-cancel-button:hover {
        background: #D5C6B5;
    }

    .portfolio-validation-error {
        background: #F5E1DA;
        color: #8A5427;
        padding: 14px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .portfolio-validation-error ul {
        margin: 8px 0 0 20px;
    }
</style>

<div class="portfolio-form-container">

    <div style="margin-bottom:24px;">
        <h2>Form Tambah Portfolio</h2>

        <p style="color:#897967; margin-top:8px;">
            Tambahkan informasi proyek baru ke portofolio RuangRona.
        </p>
    </div>

    {{-- Pesan Error --}}
    @if($errors->any())
        <div class="portfolio-validation-error">
            <strong>Periksa kembali data yang dimasukkan.</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.portfolios.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        {{-- Nama Proyek --}}
        <div class="portfolio-form-group">
            <label for="title">Nama Proyek *</label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="Contoh: Renovasi Interior Rumah"
                required
            >
        </div>

        {{-- Client --}}
        <div class="portfolio-form-group">
            <label for="client">Nama Client</label>

            <input
                type="text"
                id="client"
                name="client"
                value="{{ old('client') }}"
                placeholder="Nama client atau pemilik proyek"
            >
        </div>

        {{-- Tanggal --}}
        <div class="portfolio-form-group">
            <label for="project_date">Tanggal Proyek</label>

            <input
                type="date"
                id="project_date"
                name="project_date"
                value="{{ old('project_date') }}"
            >
        </div>

        {{-- Kategori --}}
        <div class="portfolio-form-group">
            <label for="category_id">Kategori</label>

            <select
                name="category_id"
                id="category_id"
            >
                <option value="">-- Pilih Kategori --</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <small>
                Pilih kategori yang sesuai dengan proyek.
            </small>

            @error('category_id')
                <small style="color:#b91c1c;">
                    {{ $message }}
                </small>
            @enderror
        </div>

        {{-- Cover Image --}}
        <div class="portfolio-form-group">
            <label for="cover_image">Cover Gambar Proyek</label>

            <input
                type="file"
                id="cover_image"
                name="cover_image"
                accept="image/jpeg,image/png,image/webp"
            >

            <small>
                Format JPG, JPEG, PNG atau WEBP. Maksimal 2 MB.
            </small>

            @error('cover_image')
                <small style="color:#b91c1c;">
                    {{ $message }}
                </small>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="portfolio-form-group">
            <label for="description">Deskripsi Proyek</label>

            <textarea
                id="description"
                name="description"
                placeholder="Tuliskan penjelasan mengenai proyek..."
            >{{ old('description') }}</textarea>
        </div>

        {{-- Status --}}
        <div class="portfolio-checkbox-group">
            <label>
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    {{ old('is_active', '1') ? 'checked' : '' }}
                >

                Aktif
            </label>
        </div>

        {{-- Tombol --}}
        <div class="portfolio-form-actions">

            <button
                type="submit"
                class="portfolio-submit-button"
            >
                Simpan Portfolio
            </button>

            <a
                href="{{ route('admin.portfolios.index') }}"
                class="portfolio-cancel-button"
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection
