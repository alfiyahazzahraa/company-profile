@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; flex-wrap:wrap; gap:10px;">
        <div>
            <h1>Halaman</h1>
            <p style="color:#777;">Kelola halaman website.</p>
        </div>

        <a href="{{ route('admin.pages.create') }}"
           style="background:#556B2F; color:white; padding:10px 18px; border-radius:8px; text-decoration:none;">
            + Tambah Halaman
        </a>
    </div>

    @if(session('success'))
        <div style="background:#d1fae5; color:#065f46; padding:15px; border-radius:8px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:white; padding:20px; border-radius:12px; overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; min-width:750px;">
            <thead>
                <tr style="text-align:left; border-bottom:1px solid #eee;">
                    <th style="padding:12px;">Judul</th>
                    <th style="padding:12px;">Slug</th>
                    <th style="padding:12px;">Status</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pages as $page)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px;">{{ $page->title }}</td>
                        <td style="padding:12px;">{{ $page->slug }}</td>
                        <td style="padding:12px;">
                            @if($page->is_active)
                                <span style="background:#d1fae5; color:#065f46; padding:5px 10px; border-radius:20px;">Aktif</span>
                            @else
                                <span style="background:#eee; color:#666; padding:5px 10px; border-radius:20px;">Tidak Aktif</span>
                            @endif
                        </td>
                        <td style="padding:12px;">
                            <div style="display:flex; gap:8px; flex-wrap:wrap;">
                                <a href="{{ route('admin.pages.edit', $page->id) }}"
                                   style="background:#e8e3d5; color:#333; padding:7px 12px; border-radius:6px; text-decoration:none;">
                                    Edit
                                </a>

                                <form action="{{ route('admin.pages.destroy', $page->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus halaman ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        style="background:#dc2626; color:white; padding:7px 12px; border:none; border-radius:6px; cursor:pointer;">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding:30px; text-align:center; color:#777;">
                            Belum ada halaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px;">
            {{ $pages->links() }}
        </div>
    </div>
</div>
@endsection