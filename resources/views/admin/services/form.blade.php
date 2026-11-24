
<style>
    .service-form-container {
        background: #FAF7F2;
        border: 1px solid #D5C6B5;
        border-radius: 14px;
        padding: 24px;
    }

    .service-form-group {
        margin-bottom: 22px;
    }

    .service-form-group label {
        display: block;
        margin-bottom: 8px;
        color: #514538;
        font-weight: 500;
    }

    .service-form-group input,
    .service-form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #D5C6B5;
        border-radius: 8px;
        background: white;
        color: #514538;
        font: inherit;
        box-sizing: border-box;
    }

    .service-form-group textarea {
        min-height: 120px;
        resize: vertical;
    }

    .service-form-group input[type="checkbox"] {
        width: auto;
    }

    .service-form-error {
        color: #8A5427;
        font-size: 13px;
        margin-top: 6px;
    }

    .service-form-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 25px;
    }

    .service-form-button {
        display: inline-block;
        padding: 12px 20px;
        background: #76614A;
        color: white;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        cursor: pointer;
    }

    .service-form-button:hover {
        background: #514538;
    }

    .service-form-cancel {
        background: #E7DDD0;
        color: #514538;
    }
</style>

<div class="service-form-container">

    @if($errors->any())
        <div style="background:#F3E0C8; color:#8A5427; padding:15px; border-radius:10px; margin-bottom:20px;">
            <strong>Periksa kembali form:</strong>

            <ul style="margin-top:10px; padding-left:20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="service-form-group">
        <label for="title">Judul Layanan *</label>

        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $service->title ?? '') }}"
            required
        >

        @error('title')
            <div class="service-form-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="service-form-group">
        <label for="icon">Icon (opsional)</label>

        <input
            type="text"
            id="icon"
            name="icon"
            value="{{ old('icon', $service->icon ?? '') }}"
            placeholder="Contoh: fa-solid fa-house"
        >
    </div>

    <div class="service-form-group">
        <label for="image">Gambar Layanan (maksimal 2 MB)</label>

        <input
            type="file"
            id="image"
            name="image"
            accept=".jpg,.jpeg,.png,.webp"
        >

        @if(isset($service) && $service->image)
            <div style="margin-top:15px;">
                <p style="margin-bottom:10px;">Gambar saat ini:</p>

                <img
                    src="{{ asset('storage/' . $service->image) }}"
                    alt="{{ $service->title }}"
                    style="width:180px; max-width:100%; border-radius:10px;"
                >
            </div>
        @endif

        @error('image')
            <div class="service-form-error">{{ $message }}</div>
        @enderror
    </div>

    <div class="service-form-group">
        <label for="excerpt">Ringkasan Layanan</label>

        <textarea
            id="excerpt"
            name="excerpt"
        >{{ old('excerpt', $service->excerpt ?? '') }}</textarea>
    </div>

    <div class="service-form-group">
        <label for="content">Isi Layanan</label>

        <textarea
            id="content"
            name="content"
        >{{ old('content', $service->content ?? '') }}</textarea>
    </div>

    <div class="service-form-group">
        <label>
            <input
                type="checkbox"
                name="is_featured"
                value="1"
                @checked(old('is_featured', $service->is_featured ?? false))
            >
            Jadikan layanan unggulan
        </label>
    </div>

    <div class="service-form-group">
        <label>
            <input
                type="checkbox"
                name="is_active"
                value="1"
                @checked(old('is_active', $service->is_active ?? true))
            >
            Aktifkan layanan
        </label>
    </div>

    <div class="service-form-actions">
        <button type="submit" class="service-form-button">
            {{ isset($service) ? 'Simpan Perubahan' : 'Tambah Layanan' }}
        </button>

        <a href="{{ route('admin.services.index') }}"
           class="service-form-button service-form-cancel">
            Batal
        </a>
    </div>

</div>
