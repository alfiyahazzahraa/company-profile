@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div style="margin-bottom:25px;">
        <h1>Tambah Client</h1>
        <p style="color:#777;">Tambahkan data klien baru.</p>
    </div>

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
        <form action="{{ route('admin.clients.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div style="margin-bottom:20px;">
                <label for="name">Nama Client</label>
                <input type="text" id="name" name="name"
                    value="{{ old('name') }}" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label for="website">Website Client (Opsional)</label>
                <input type="url" id="website" name="website"
                    value="{{ old('website') }}"
                    placeholder="https://example.com"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label for="logo">Logo Client</label>
                <input type="file" id="logo" name="logo" accept="image/*"
                    style="display:block; margin-top:8px;">
                <small style="color:#777;">Opsional, maksimal 2 MB.</small>
            </div>

            <div style="margin-bottom:25px;">
                <label for="is_active">Status</label>
                <select id="is_active" name="is_active" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
                    <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>
                </select>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <button type="submit"
                    style="background:#556B2F; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;">
                    Simpan Client
                </button>

                <a href="{{ route('admin.clients.index') }}"
                   style="background:#eee; color:#333; padding:10px 20px; border-radius:8px; text-decoration:none;">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection