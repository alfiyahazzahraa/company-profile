
@extends('admin.layouts.app')

@section('title', 'Pengaturan Website')
@section('header', 'Pengaturan Website')

@section('content')

<style>
    .settings-page {
        color: #344536;
        font-family: inherit;
    }

    .settings-page .page-heading {
        margin-bottom: 26px;
    }

    .settings-page .page-heading h1 {
        color: #344536;
        font-size: 25px;
        font-weight: 700;
        margin: 0 0 8px;
    }

    .settings-page .page-heading p {
        color: #7B8875;
        font-size: 14px;
        margin: 0;
        line-height: 1.7;
    }

    .settings-page .settings-card {
        background: #F8F8F2;
        border: 1px solid #DCE3D5;
        border-radius: 16px;
        padding: 28px;
        margin-bottom: 22px;
        box-shadow: 0 4px 14px rgba(53, 70, 53, 0.035);
    }

    .settings-page .settings-card h2 {
        color: #3D513C;
        margin: 0 0 8px;
        font-size: 17px;
        font-weight: 700;
    }

    .settings-page .description {
        color: #84907D;
        font-size: 13px;
        margin: 0 0 24px;
        line-height: 1.7;
    }

    .settings-page .field {
        margin-bottom: 22px;
    }

    .settings-page .field:last-child {
        margin-bottom: 0;
    }

    .settings-page .field label {
        display: block;
        color: #455440;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 9px;
    }

    .settings-page .field input,
    .settings-page .field textarea {
        display: block;
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #D8E0D1;
        background: #F1F4EC;
        color: #394B38;
        border-radius: 10px;
        font-size: 14px;
        font-family: inherit;
        transition: .2s ease;
    }

    .settings-page .field input::placeholder,
    .settings-page .field textarea::placeholder {
        color: #A0AC96;
    }

    .settings-page .field input:focus,
    .settings-page .field textarea:focus {
        outline: none;
        border-color: #93A585;
        box-shadow: 0 0 0 3px rgba(147, 165, 133, .13);
    }

    .settings-page .field textarea {
        resize: vertical;
        min-height: 100px;
        line-height: 1.7;
    }

    .settings-page .field input[type="file"] {
        padding: 10px;
        cursor: pointer;
    }

    .settings-page .field input[type="file"]::file-selector-button {
        border: none;
        background: #E2E9DB;
        color: #43553F;
        padding: 8px 12px;
        border-radius: 7px;
        margin-right: 12px;
        cursor: pointer;
        font-family: inherit;
    }

    .settings-page .help {
        color: #84907D;
        font-size: 12px;
        margin-top: 8px;
        line-height: 1.6;
    }

    .settings-page .success-message {
        background: #E7EEE3;
        color: #4F6749;
        border: 1px solid #D5E2CF;
        padding: 14px 18px;
        border-radius: 11px;
        margin-bottom: 22px;
        font-size: 14px;
    }

    .settings-page .error-message {
        color: #98645A;
        font-size: 13px;
        margin-top: 8px;
    }

    .settings-page .preview {
        max-width: 150px;
        max-height: 100px;
        display: block;
        margin-top: 14px;
        padding: 8px;
        background: #E9EDE3;
        border: 1px solid #DCE3D5;
        border-radius: 10px;
        object-fit: contain;
    }

    .settings-page .save-bar {
        display: flex;
        justify-content: flex-end;
        padding-bottom: 24px;
    }

    .settings-page .save-button {
        background: #687D59;
        color: #FAFAF5;
        border: 1px solid #687D59;
        padding: 13px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .settings-page .save-button:hover {
        background: #536747;
        border-color: #536747;
    }

    .settings-page .save-button:active {
        transform: scale(.98);
    }

    @media(max-width: 768px) {
        .settings-page .settings-card {
            padding: 20px;
        }

        .settings-page .page-heading h1 {
            font-size: 22px;
        }

        .settings-page .save-bar {
            justify-content: stretch;
        }

        .settings-page .save-button {
            width: 100%;
        }
    }
</style>

<div class="settings-page">

    <div class="page-heading">
        <h1>Pengaturan Website</h1>
        <p>Kelola identitas, kontak dan informasi website perusahaan.</p>
    </div>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="settings-card">
            <p class="error-message">Ada input yang perlu diperiksa:</p>
            <ul class="error-message">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PATCH')

        <div class="settings-card">
            <h2>Identitas Perusahaan</h2>
            <p class="description">Informasi dasar identitas perusahaan.</p>

            <div class="field">
                <label>Nama Perusahaan</label>
                <input type="text" name="company_name"
                    value="{{ old('company_name', $setting?->company_name) }}"
                    placeholder="Nama perusahaan">
            </div>

            <div class="field">
                <label>Logo Perusahaan</label>
                <input type="file" name="logo" accept="image/*">
                <p class="help">JPG, PNG, WEBP. Maksimal 2 MB.</p>

                @if($setting?->logo)
                    <img class="preview"
                        src="{{ asset('storage/'.$setting->logo) }}"
                        alt="Logo perusahaan">
                @endif
            </div>

            <div class="field">
                <label>Favicon</label>
                <input type="file" name="favicon" accept="image/*">
                <p class="help">Maksimal 2 MB.</p>

                @if($setting?->favicon)
                    <img class="preview"
                        src="{{ asset('storage/'.$setting->favicon) }}"
                        alt="Favicon">
                @endif
            </div>

            <div class="field">
                <label>Alamat Perusahaan</label>
                <textarea name="address" rows="4"
                    placeholder="Alamat perusahaan">{{ old('address', $setting?->address) }}</textarea>
            </div>
        </div>

        <div class="settings-card">
            <h2>Informasi Kontak</h2>
            <p class="description">Kontak yang akan ditampilkan di website.</p>

            <div class="field">
                <label>Nomor Telepon</label>
                <input type="text" name="phone"
                    value="{{ old('phone', $setting?->phone) }}"
                    placeholder="Nomor telepon">
            </div>

            <div class="field">
                <label>Email Perusahaan</label>
                <input type="email" name="email"
                    value="{{ old('email', $setting?->email) }}"
                    placeholder="Email perusahaan">
            </div>

            <div class="field">
                <label>WhatsApp</label>
                <input type="text" name="whatsapp"
                    value="{{ old('whatsapp', $setting?->whatsapp) }}"
                    placeholder="Nomor WhatsApp">
            </div>
        </div>

        <div class="settings-card">
            <h2>Media Sosial</h2>
            <p class="description">Tautan media sosial resmi perusahaan.</p>

            <div class="field">
                <label>Instagram</label>
                <input type="url" name="social_media[instagram]"
                    value="{{ old('social_media.instagram', $setting?->social_media['instagram'] ?? '') }}"
                    placeholder="https://instagram.com/...">
            </div>

            <div class="field">
                <label>Facebook</label>
                <input type="url" name="social_media[facebook]"
                    value="{{ old('social_media.facebook', $setting?->social_media['facebook'] ?? '') }}"
                    placeholder="https://facebook.com/...">
            </div>

            <div class="field">
                <label>LinkedIn</label>
                <input type="url" name="social_media[linkedin]"
                    value="{{ old('social_media.linkedin', $setting?->social_media['linkedin'] ?? '') }}"
                    placeholder="https://linkedin.com/...">
            </div>

            <div class="field">
                <label>YouTube</label>
                <input type="url" name="social_media[youtube]"
                    value="{{ old('social_media.youtube', $setting?->social_media['youtube'] ?? '') }}"
                    placeholder="https://youtube.com/...">
            </div>
        </div>

        <div class="settings-card">
            <h2>Google Maps</h2>
            <p class="description">Lokasi perusahaan pada peta.</p>

            <div class="field">
                <label>Embed Maps</label>
                <textarea name="maps_embed" rows="4"
                    placeholder="Kode embed Google Maps">{{ old('maps_embed', $setting?->maps_embed) }}</textarea>
            </div>
        </div>

        <div class="settings-card">
            <h2>SEO Website</h2>
            <p class="description">Informasi untuk mesin pencari.</p>

            <div class="field">
                <label>Meta Title</label>
                <input type="text" name="meta_title"
                    value="{{ old('meta_title', $setting?->meta_title) }}"
                    placeholder="Judul SEO website">
            </div>

            <div class="field">
                <label>Meta Description</label>
                <textarea name="meta_description" rows="4"
                    placeholder="Deskripsi website">{{ old('meta_description', $setting?->meta_description) }}</textarea>
            </div>
        </div>

        <div class="save-bar">
            <button type="submit" class="save-button">
                Simpan Pengaturan
            </button>
        </div>

    </form>

</div>

@endsection
