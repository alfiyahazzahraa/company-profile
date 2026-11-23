<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Website</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; padding: 30px; color: #333; }
        .container { max-width: 900px; margin: auto; }
        .card { background: white; padding: 25px; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        h1 { margin-bottom: 5px; }
        h2 { font-size: 18px; margin-top: 0; }
        label { display: block; margin: 15px 0 7px; font-weight: bold; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        textarea { resize: vertical; }
        .note { color: #777; font-size: 13px; }
        .btn { background: #2563eb; color: white; padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; }
        .btn-back { display: inline-block; margin-bottom: 20px; color: #2563eb; text-decoration: none; }
        .success { background: #dcfce7; color: #166534; padding: 12px; border-radius: 6px; margin-bottom: 20px; }
        .error { color: #dc2626; font-size: 13px; margin-top: 5px; }
        img.preview { max-width: 150px; max-height: 100px; display: block; margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">

    <a href="{{ route('admin.dashboard') }}" class="btn-back">
        &larr; Kembali ke Dashboard
    </a>

    <h1>Pengaturan Website</h1>
    <p class="note">Kelola informasi utama website perusahaan.</p>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">
            <p>Periksa kembali input berikut:</p>
            <ul>
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

        <div class="card">
            <h2>Informasi Perusahaan</h2>

            <label>Nama Perusahaan</label>
            <input type="text" name="company_name"
                value="{{ old('company_name', $setting?->company_name) }}"
                placeholder="Nama perusahaan">
            @error('company_name') <p class="error">{{ $message }}</p> @enderror

            <label>Logo Perusahaan</label>
            <input type="file" name="logo" accept="image/*">
            <p class="note">Format JPG, PNG, WEBP. Maksimal 2 MB.</p>
            @if($setting?->logo)
                <img class="preview" src="{{ asset('storage/'.$setting->logo) }}" alt="Logo">
            @endif
            @error('logo') <p class="error">{{ $message }}</p> @enderror

            <label>Favicon</label>
            <input type="file" name="favicon" accept="image/*">
            <p class="note">Format JPG, PNG, WEBP, ICO. Maksimal 2 MB.</p>
            @if($setting?->favicon)
                <img class="preview" src="{{ asset('storage/'.$setting->favicon) }}" alt="Favicon">
            @endif
            @error('favicon') <p class="error">{{ $message }}</p> @enderror

            <label>Alamat Perusahaan</label>
            <textarea name="address" rows="3"
                placeholder="Alamat perusahaan">{{ old('address', $setting?->address) }}</textarea>
            @error('address') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="card">
            <h2>Informasi Kontak</h2>

            <label>Nomor Telepon</label>
            <input type="text" name="phone"
                value="{{ old('phone', $setting?->phone) }}"
                placeholder="Nomor telepon">

            <label>Email Perusahaan</label>
            <input type="email" name="email"
                value="{{ old('email', $setting?->email) }}"
                placeholder="Email perusahaan">

            <label>Nomor WhatsApp</label>
            <input type="text" name="whatsapp"
                value="{{ old('whatsapp', $setting?->whatsapp) }}"
                placeholder="Nomor WhatsApp">
        </div>

        <div class="card">
            <h2>Media Sosial</h2>

            <label>Instagram</label>
            <input type="url" name="social_media[instagram]"
                value="{{ old('social_media.instagram', $setting?->social_media['instagram'] ?? '') }}"
                placeholder="https://instagram.com/...">

            <label>Facebook</label>
            <input type="url" name="social_media[facebook]"
                value="{{ old('social_media.facebook', $setting?->social_media['facebook'] ?? '') }}"
                placeholder="https://facebook.com/...">

            <label>LinkedIn</label>
            <input type="url" name="social_media[linkedin]"
                value="{{ old('social_media.linkedin', $setting?->social_media['linkedin'] ?? '') }}"
                placeholder="https://linkedin.com/...">

            <label>YouTube</label>
            <input type="url" name="social_media[youtube]"
                value="{{ old('social_media.youtube', $setting?->social_media['youtube'] ?? '') }}"
                placeholder="https://youtube.com/...">
        </div>

        <div class="card">
            <h2>Google Maps</h2>

            <label>Embed Maps</label>
            <textarea name="maps_embed" rows="4"
                placeholder="Kode embed Google Maps">{{ old('maps_embed', $setting?->maps_embed) }}</textarea>
        </div>

        <div class="card">
            <h2>SEO Website</h2>

            <label>Meta Title</label>
            <input type="text" name="meta_title"
                value="{{ old('meta_title', $setting?->meta_title) }}"
                placeholder="Judul SEO website">

            <label>Meta Description</label>
            <textarea name="meta_description" rows="4"
                placeholder="Deskripsi website untuk mesin pencari">{{ old('meta_description', $setting?->meta_description) }}</textarea>
        </div>

        <button type="submit" class="btn">
            Simpan Pengaturan
        </button>

    </form>

</div>

</body>
</html>