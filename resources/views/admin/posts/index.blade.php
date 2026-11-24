
@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="padding: 24px;">

    {{-- Header --}}
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
        <div>
            <h1 style="margin: 0; font-size: 28px; font-weight: 700;">Manajemen Berita</h1>
            <p style="margin: 6px 0 0; color: #6b7280;">
                Kelola berita dan artikel website.
            </p>
        </div>

        <a href="{{ route('admin.posts.create') }}"
           style="display: inline-block; background: #55775b; color: white; padding: 10px 18px; border-radius: 8px; text-decoration: none; font-weight: 600;">
            + Tambah Berita
        </a>
    </div>

    {{-- Pencarian --}}
    <div style="margin-bottom: 24px;">
        <form action="{{ route('admin.posts.index') }}" method="GET"
              style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari judul berita..."
                   style="width: 320px; max-width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none;">

            <button type="submit"
                    style="background: #55775b; color: white; padding: 10px 18px; border: none; border-radius: 8px; cursor: pointer;">
                Cari
            </button>

            @if(request('search'))
                <a href="{{ route('admin.posts.index') }}"
                   style="color: #55775b; text-decoration: none; padding: 8px;">
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Tabel Berita --}}
    <div style="overflow-x: auto; background: white; border-radius: 10px; border: 1px solid #dce3d5;">
        <table style="width: 100%; border-collapse: collapse; min-width: 800px;">

            <thead>
                <tr style="background: #dce5d5;">
                    <th style="padding: 14px; text-align: left;">Judul</th>
                    <th style="padding: 14px; text-align: left;">Kategori</th>
                    <th style="padding: 14px; text-align: left;">Penulis</th>
                    <th style="padding: 14px; text-align: left;">Status</th>
                    <th style="padding: 14px; text-align: left;">Publikasi</th>
                    <th style="padding: 14px; text-align: center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($posts as $post)
                    <tr style="border-top: 1px solid #e5e7eb;">
                        <td style="padding: 14px;">
                            {{ $post->title }}
                        </td>

                        <td style="padding: 14px;">
                            {{ $post->category->name ?? '-' }}
                        </td>

                        <td style="padding: 14px;">
                            {{ $post->author->name ?? '-' }}
                        </td>

                        <td style="padding: 14px;">
                            @if($post->status === 'published')
                                <span style="background: #d1fae5; color: #065f46; padding: 5px 10px; border-radius: 20px; font-size: 12px;">
                                    Published
                                </span>
                            @else
                                <span style="background: #fef3c7; color: #92400e; padding: 5px 10px; border-radius: 20px; font-size: 12px;">
                                    Draft
                                </span>
                            @endif
                        </td>

                        <td style="padding: 14px;">
                            {{ $post->published_at ? $post->published_at->format('d M Y') : '-' }}
                        </td>

                        <td style="padding: 14px; text-align: center;">
                            <div style="display: flex; justify-content: center; gap: 8px; flex-wrap: wrap;">
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                   style="background: #e0e7d8; color: #385540; padding: 7px 12px; border-radius: 6px; text-decoration: none;">
                                    Edit
                                </a>

                                <form action="{{ route('admin.posts.destroy', $post) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            style="background: #fee2e2; color: #991b1b; padding: 7px 12px; border: none; border-radius: 6px; cursor: pointer;">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 24px; text-align: center; color: #6b7280;">
                            {{ request('search') ? 'Berita tidak ditemukan.' : 'Belum ada berita.' }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div style="margin-top: 20px;">
        {{ $posts->links() }}
    </div>

</div>
@endsection
