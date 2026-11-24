
@extends('admin.layouts.app')

@section('content')
<div style="padding: 30px;">
    <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 20px;">
        Tambah Testimonial
    </h1>

    <a href="{{ route('admin.testimonials.index') }}"
       style="display: inline-block; margin-bottom: 20px; color: #556B2F;">
        ← Kembali
    </a>

    @if ($errors->any())
        <div style="background: #ffe5e5; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.testimonials.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                Nama
            </label>
            <input type="text" name="name"
                   value="{{ old('name') }}"
                   required
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                Posisi / Jabatan
            </label>
            <input type="text" name="position"
                   value="{{ old('position') }}"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                Perusahaan
            </label>
            <input type="text" name="company"
                   value="{{ old('company') }}"
                   style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                Isi Testimonial
            </label>
            <textarea name="testimonial"
                      rows="5"
                      required
                      style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">{{ old('testimonial') }}</textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                Foto
            </label>
            <input type="file" name="photo" accept="image/*">
            <small style="display: block; margin-top: 5px; color: #777;">
                Opsional. Maksimal 2 MB.
            </small>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                Status
            </label>
            <select name="is_active"
                    required
                    style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
        </div>

        <button type="submit"
                style="background: #556B2F; color: white; padding: 12px 20px; border: none; border-radius: 8px; cursor: pointer;">
            Simpan Testimonial
        </button>
    </form>
</div>
@endsection
