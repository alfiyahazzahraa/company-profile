@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="page-header" style="margin-bottom: 25px;">
        <h1>Edit Testimonial</h1>
        <p style="color: #777;">Perbarui data testimonial.</p>
    </div>

    @if ($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="background: white; padding: 25px; border-radius: 12px;">
        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 20px;">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name"
                    value="{{ old('name', $testimonial->name) }}"
                    required
                    style="width: 100%; padding: 10px; margin-top: 8px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="position">Jabatan</label>
                <input type="text" id="position" name="position"
                    value="{{ old('position', $testimonial->position) }}"
                    style="width: 100%; padding: 10px; margin-top: 8px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="company">Perusahaan</label>
                <input type="text" id="company" name="company"
                    value="{{ old('company', $testimonial->company) }}"
                    style="width: 100%; padding: 10px; margin-top: 8px; border: 1px solid #ddd; border-radius: 8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="testimonial">Isi Testimonial</label>
                <textarea id="testimonial" name="testimonial" rows="5" required
                    style="width: 100%; padding: 10px; margin-top: 8px; border: 1px solid #ddd; border-radius: 8px;">{{ old('testimonial', $testimonial->testimonial) }}</textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label>Foto Saat Ini</label>

                @if ($testimonial->photo)
                    <div style="margin-top: 10px;">
                        <img src="{{ asset('storage/' . $testimonial->photo) }}"
                             alt="Foto testimonial"
                             style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px;">
                    </div>
                @else
                    <p style="color: #777;">Belum ada foto.</p>
                @endif
            </div>

            <div style="margin-bottom: 20px;">
                <label for="photo">Ganti Foto (Opsional)</label>
                <input type="file" id="photo" name="photo" accept="image/*"
                    style="display: block; margin-top: 8px;">
                <small style="color: #777;">Kosongkan jika tidak ingin mengganti foto. Maksimal 2 MB.</small>
            </div>

            <div style="margin-bottom: 25px;">
                <label for="is_active">Status</label>
                <select id="is_active" name="is_active" required
                    style="width: 100%; padding: 10px; margin-top: 8px; border: 1px solid #ddd; border-radius: 8px;">
                    <option value="1" {{ old('is_active', $testimonial->is_active) == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ old('is_active', $testimonial->is_active) == 0 ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>
                </select>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit"
                    style="background: #556B2F; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;">
                    Update Testimonial
                </button>

                <a href="{{ route('admin.testimonials.index') }}"
                    style="background: #eee; color: #333; padding: 10px 20px; border-radius: 8px; text-decoration: none;">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection