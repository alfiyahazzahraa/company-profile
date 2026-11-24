
@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')
@section('header', 'Tambah Layanan')

@section('content')

<style>
    .service-form-container {
        background: #FAF7F2;
        border: 1px solid #D5C6B5;
        border-radius: 14px;
        padding: 24px;
    }

    .service-form-group {
        margin-bottom: 20px;
    }

    .service-form-group label {
        display: block;
        margin-bottom: 8px;
        color: #514538;
        font-weight: 600;
    }

    .service-form-group input,
    .service-form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #D5C6B5;
        border-radius: 8px;
        background: #FAF9F4;
        color: #514538;
        font-family: inherit;
        box-sizing: border-box;
    }

    .service-form-group input:focus,
    .service-form-group textarea:focus {
        outline: none;
        border-color: #76614A;
        box-shadow: 0 0 0 2px rgba(118, 97, 74, 0.12);
    }

    .service-form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .service-form-group small {
        display: block;
        margin-top: 6px;
        color: #897967;
    }

    .service-checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-bottom: 24px;
    }

    .service-checkbox-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #514538;
    }

    .service-checkbox-group input {
        accent-color: #76614A;
    }

    .service-form-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 24px;
    }

    .service-submit-button {
        background: #76614A;
        color: white;
        padding: 11px 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
    }

    .service-submit-button:hover {
        background: #514538;
    }

    .service-cancel-button {
        background: #E7DDD0;
        color: #514538;
        padding: 11px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
    }

    .service-cancel-button:hover {
        background: #D5C6B5;
    }

    .service-validation-error {
        background: #F5E1DA;
        color: #8A5427;
        padding: 14px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .service-validation-error ul {
        margin: 8px 0 0 20px;
    }
</style>

<div class="service-form-container">

    <div style="margin-bottom:24px;">
        <h2>Form Tambah Layanan</h2>

        <p style="color:#897967; margin-top:8px;">
            Tambahkan informasi layanan baru untuk website RuangRona.
        </p>
    </div>

    @if($errors->any())
        <div class="service-validation-error">
            <strong>Periksa kembali data yang dimasukkan.</strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.services.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        {{-- Judul Layanan --}}
        <div class="service-form-group">
            <label for="title">Judul Layanan *</label>

            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                placeholder="Contoh: Desain Interior"
                required
            >
        </div>

        {{-- Icon --}}
        <div class="service-form-group">
            <label for="icon">Icon</label>

            <input
                type="text"
                id="icon"
                name="icon"
                value="{{ old('icon') }}"
                placeholder="Contoh: fas fa-paint-brush"
            >

            <small>
                Isi dengan nama icon jika digunakan pada website.
                Field ini boleh dikosongkan.
            </small>
        </div>

        {{-- Gambar --}}
        <div class="service-form-group">
            <label for="image">Gambar Layanan</label>

            <input
                type="file"
                id="image"
                name="image"
                accept="image/jpeg,image/png,image/webp"
            >

            <small>
                Format JPG, PNG atau WEBP. Maksimal 2 MB.
            </small>
        </div>

        {{-- Ringkasan --}}
        <div class="service-form-group">
            <label for="excerpt">Ringkasan Layanan</label>

            <textarea
                id="excerpt"
                name="excerpt"
                placeholder="Tuliskan ringkasan singkat layanan..."
            >{{ old('excerpt') }}</textarea>
        </div>

        {{-- Konten --}}
        <div class="service-form-group">
            <label for="content">Deskripsi Lengkap</label>

            <textarea
                id="content"
                name="content"
                style="min-height:220px;"
                placeholder="Tuliskan penjelasan lengkap mengenai layanan..."
            >{{ old('content') }}</textarea>
        </div>

        {{-- Status --}}
        <div class="service-checkbox-group">

            <label>
                <input
                    type="checkbox"
                    name="is_featured"
                    value="1"
                    {{ old('is_featured') ? 'checked' : '' }}
                >

                Layanan Unggulan
            </label>

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
        <div class="service-form-actions">

            <button
                type="submit"
                class="service-submit-button"
            >
                Simpan Layanan
            </button>

            <a
                href="{{ route('admin.services.index') }}"
                class="service-cancel-button"
            >
                Batal
            </a>

        </div>

    </form>

</div>

@endsection
