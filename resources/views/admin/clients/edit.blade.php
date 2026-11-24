@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div style="margin-bottom:25px;">
        <h1>Edit Client</h1>
        <p style="color:#777;">Perbarui data klien.</p>
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
        <form action="{{ route('admin.clients.update', $client->id) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom:20px;">
                <label for="name">Nama Client</label>
                <input type="text" id="name" name="name"
                    value="{{ old('name', $client->name) }}" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label for="website">Website Client</label>
                <input type="url" id="website" name="website"
                    value="{{ old('website', $client->website) }}"
                    placeholder="https://example.com"
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Logo Saat Ini</label>

                @if($client->logo)
                    <div style="margin-top:10px;">
                        <img src="{{ asset('storage/'.$client->logo) }}"
                             alt="Logo {{ $client->name }}"
                             style="width:120px; height:90px; object-fit:contain;">
                    </div>
                @else
                    <p style="color:#777;">Belum ada logo.</p>
                @endif
            </div>

            <div style="margin-bottom:20px;">
                <label for="logo">Ganti Logo (Opsional)</label>
                <input type="file" id="logo" name="logo" accept="image/*"
                    style="display:block; margin-top:8px;">
                <small style="color:#777;">Kosongkan jika tidak ingin mengganti logo. Maksimal 2 MB.</small>
            </div>

            <div style="margin-bottom:25px;">
                <label for="is_active">Status</label>
                <select id="is_active" name="is_active" required
                    style="width:100%; padding:10px; margin-top:8px; border:1px solid #ddd; border-radius:8px;">
                    <option value="1" {{ old('is_active', $client->is_active) == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ old('is_active', $client->is_active) == 0 ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>
                </select>
            </div>

            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <button type="submit"
                    style="background:#556B2F; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer;">
                    Update Client
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