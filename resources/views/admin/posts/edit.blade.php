
@extends('admin.layouts.app')

@section('content')
<div style="padding: 24px;">

    {{-- Header --}}
    <div style="margin-bottom: 24px;">
        <h1 style="font-size: 28px; font-weight: 700; margin: 0;">
            Edit Berita
        </h1>
        <p style="color: #6b7280; margin-top: 6px;">
            Perbarui informasi dan konten berita.
        </p>
    </div>

    <div style="max-width: 1100px; background: #fff; border: 1px solid #dce3d5; border-radius: 12px; padding: 28px;">

        {{-- Error --}}
        @if($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 14px; border-radius: 8px; margin-bottom: 20px;">
                <strong>Periksa kembali input berikut:</strong>
                <ul style="margin: 8px 0 0 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- INFORMASI BERITA --}}
            <div style="margin-bottom: 30px;">
                <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 20px; color: #405f47;">
                    Informasi Berita
                </h2>

                {{-- Judul --}}
                <div style="margin-bottom: 20px;">
                    <label for="title" style="display: block; font-weight: 600; margin-bottom: 8px;">
                        Judul Berita <span style="color: red;">*</span>
                    </label>

                    <input type="text" id="title" name="title"
                           value="{{ old('title', $post->title) }}"
                           required
                           placeholder="Masukkan judul berita"
                           style="width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>

                {{-- Slug --}}
                <div style="margin-bottom: 20px;">
                    <label for="slug" style="display: block; font-weight: 600; margin-bottom: 8px;">
                        Slug <span style="color: #6b7280; font-weight: normal;">(opsional)</span>
                    </label>

                    <input type="text" id="slug" name="slug"
                           value="{{ old('slug', $post->slug) }}"
                           placeholder="Slug berita"
                           style="width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 8px;">
                    <small style="color: #6b7280;">
                        Slug digunakan sebagai bagian URL berita.
                    </small>
                </div>

                {{-- Kategori --}}
                <div style="margin-bottom: 20px;">
                    <label for="category_id" style="display: block; font-weight: 600; margin-bottom: 8px;">
                        Kategori
                    </label>

                    <select id="category_id" name="category_id"
                            style="width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 8px;">
                        <option value="">-- Pilih Kategori --</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Thumbnail --}}
                <div style="margin-bottom: 20px;">
                    <label for="thumbnail" style="display: block; font-weight: 600; margin-bottom: 8px;">
                        Thumbnail
                    </label>

                    @if($post->thumbnail)
                        <div style="margin-bottom: 14px;">
                            <p style="margin-bottom: 8px; font-weight: 500;">
                                Thumbnail saat ini:
                            </p>

                            <img src="{{ asset('storage/' . $post->thumbnail) }}"
                                 alt="Thumbnail berita"
                                 style="width: 240px; max-width: 100%; height: auto; object-fit: cover; border-radius: 8px; border: 1px solid #d1d5db;">
                        </div>
                    @endif

                    <input type="file" id="thumbnail" name="thumbnail" accept=".jpg,.jpeg,.png,.webp"
                           style="width: 100%; box-sizing: border-box; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;">

                    <small style="color: #6b7280;">
                        {{ $post->thumbnail ? 'Kosongkan jika tidak ingin mengganti thumbnail.' : 'JPG, JPEG, PNG atau WEBP. Maksimal 2 MB.' }}
                    </small>
                </div>

                {{-- Isi Berita --}}
                <div style="margin-bottom: 20px;">
                    <label for="content" style="display: block; font-weight: 600; margin-bottom: 8px;">
                        Isi Berita <span style="color: red;">*</span>
                    </label>

                    <textarea id="content" name="content" rows="12" required
                              placeholder="Tuliskan isi berita..."
                              style="width: 100%; box-sizing: border-box; padding: 14px; border: 1px solid #d1d5db; border-radius: 8px; resize: vertical;">{{ old('content', $post->content) }}</textarea>
                </div>
            </div>

            {{-- PUBLIKASI --}}
            <div style="margin-bottom: 30px; padding-top: 24px; border-top: 1px solid #e5e7eb;">
                <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 20px; color: #405f47;">
                    Pengaturan Publikasi
                </h2>

                {{-- Status --}}
                <div style="margin-bottom: 20px;">
                    <label for="status" style="display: block; font-weight: 600; margin-bottom: 8px;">
                        Status
                    </label>

                    <select id="status" name="status" required
                            style="width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 8px;">
                        <option value="draft"
                            {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                        <option value="published"
                            {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                            Published
                        </option>
                    </select>
                </div>

                {{-- Tanggal --}}
                <div style="margin-bottom: 20px;">
                    <label for="published_at" style="display: block; font-weight: 600; margin-bottom: 8px;">
                        Tanggal Publikasi
                    </label>

                    <input type="datetime-local" id="published_at" name="published_at"
                           value="{{ old('published_at', $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : '') }}"
                           style="width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 8px;">

                    <small style="color: #6b7280;">
                        Jika status Published dan tanggal dikosongkan, sistem akan menggunakan tanggal publikasi yang tersedia atau waktu saat ini.
                    </small>
                </div>
            </div>

            {{-- SEO --}}
            <div style="margin-bottom: 30px; padding-top: 24px; border-top: 1px solid #e5e7eb;">
                <h2 style="font-size: 18px; font-weight: 700; margin-bottom: 20px; color: #405f47;">
                    SEO
                </h2>

                {{-- Meta Title --}}
                <div style="margin-bottom: 20px;">
                    <label for="meta_title" style="display: block; font-weight: 600; margin-bottom: 8px;">
                        Meta Title
                    </label>

                    <input type="text" id="meta_title" name="meta_title"
                           value="{{ old('meta_title', $post->meta_title) }}"
                           placeholder="Judul untuk mesin pencari"
                           style="width: 100%; box-sizing: border-box; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>

                {{-- Meta Description --}}
                <div style="margin-bottom: 20px;">
                    <label for="meta_description" style="display: block; font-weight: 600; margin-bottom: 8px;">
                        Meta Description
                    </label>

                    <textarea id="meta_description" name="meta_description" rows="4"
                              placeholder="Deskripsi singkat berita untuk mesin pencari"
                              style="width: 100%; box-sizing: border-box; padding: 14px; border: 1px solid #d1d5db; border-radius: 8px; resize: vertical;">{{ old('meta_description', $post->meta_description) }}</textarea>
                </div>
            </div>

            {{-- Tombol --}}
            <div style="display: flex; gap: 12px; flex-wrap: wrap; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                <button type="submit"
                        style="background: #55775b; color: white; padding: 12px 20px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.posts.index') }}"
                   style="background: #e5e7eb; color: #374151; padding: 12px 20px; border-radius: 8px; text-decoration: none;">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>
@endsection
