
@extends('admin.layouts.app')

@section('content')

<div style="padding:30px;">

    {{-- Header --}}
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; margin-bottom:25px;">
        <div>
            <h1 style="font-size:28px; font-weight:700; color:#405B45;">
                Categories
            </h1>
            <p style="color:#899485; margin-top:5px;">
                Kelola kategori untuk project portofolio.
            </p>
        </div>

        <a href="{{ route('admin.categories.create') }}"
           style="padding:12px 20px; background:#405B45; color:white; text-decoration:none; border-radius:10px; font-weight:600;">
            + Tambah Kategori
        </a>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div style="padding:15px; background:#DCE5D4; color:#405B45; border-radius:10px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif


    {{-- Error Message --}}
    @if(session('error'))
        <div style="padding:15px; background:#F8DEDE; color:#842029; border-radius:10px; margin-bottom:20px;">
            {{ session('error') }}
        </div>
    @endif


    {{-- Table --}}
    <div style="background:#FAF9F4; border-radius:15px; overflow-x:auto; box-shadow:0 4px 15px rgba(0,0,0,0.04);">

        <table style="width:100%; border-collapse:collapse; min-width:700px;">

            <thead>
                <tr style="background:#DCE5D4; color:#405B45; text-align:left;">
                    <th style="padding:15px;">No</th>
                    <th style="padding:15px;">Nama Kategori</th>
                    <th style="padding:15px;">Slug</th>
                    <th style="padding:15px;">Deskripsi</th>
                    <th style="padding:15px;">Status</th>
                    <th style="padding:15px;">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr style="border-bottom:1px solid #D8DFD1;">

                        <td style="padding:15px;">
                            {{ $categories->firstItem() + $loop->index }}
                        </td>

                        <td style="padding:15px; font-weight:600; color:#465747;">
                            {{ $category->name }}
                        </td>

                        <td style="padding:15px; color:#899485;">
                            {{ $category->slug }}
                        </td>

                        <td style="padding:15px; color:#899485;">
                            {{ $category->description ?: '-' }}
                        </td>

                        <td style="padding:15px;">
                            @if($category->is_active)
                                <span style="background:#DCE5D4; color:#405B45; padding:6px 12px; border-radius:20px; font-size:13px;">
                                    Aktif
                                </span>
                            @else
                                <span style="background:#F1E2D8; color:#9A624B; padding:6px 12px; border-radius:20px; font-size:13px;">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td style="padding:15px; white-space:nowrap;">

                            {{-- Edit --}}
                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                               style="padding:8px 12px; background:#829773; color:white; text-decoration:none; border-radius:8px; display:inline-block; margin-right:5px;">
                                Edit
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus kategori ini?');"
                                  style="display:inline-block;">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        style="padding:8px 12px; background:#B78375; color:white; border:none; border-radius:8px; cursor:pointer;">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" style="padding:30px; text-align:center; color:#899485;">
                            Belum ada kategori yang ditambahkan.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div style="margin-top:20px;">
        {{ $categories->links() }}
    </div>

</div>

@endsection
