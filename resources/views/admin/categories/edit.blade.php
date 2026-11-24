
@extends('admin.layouts.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Kategori</h1>
        <p class="text-gray-500 mt-1">Perbarui informasi kategori portofolio.</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Kategori --}}
            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700 mb-2">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2"
                    required
                >

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div class="mb-4">
                <label for="description" class="block font-medium text-gray-700 mb-2">
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2"
                >{{ old('description', $category->description) }}</textarea>

                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-6">
                <label class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                    >

                    <span class="text-gray-700">Kategori Aktif</span>
                </label>
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg"
                >
                    Simpan Perubahan
                </button>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-5 py-2 rounded-lg"
                >
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
