@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px; flex-wrap:wrap; gap:10px;">
        <div>
            <h1>Sliders</h1>
            <p style="color:#777;">Kelola banner homepage.</p>
        </div>

        <a href="{{ route('admin.sliders.create') }}"
           style="background:#556B2F; color:white; padding:10px 18px; border-radius:8px; text-decoration:none;">
            + Tambah Slider
        </a>
    </div>

    @if(session('success'))
        <div style="background:#d1fae5; color:#065f46; padding:15px; border-radius:8px; margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="background:white; padding:20px; border-radius:12px; overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; min-width:850px;">
            <thead>
                <tr style="text-align:left; border-bottom:1px solid #eee;">
                    <th style="padding:12px;">Gambar</th>
                    <th style="padding:12px;">Judul</th>
                    <th style="padding:12px;">Urutan</th>
                    <th style="padding:12px;">Status</th>
                    <th style="padding:12px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($sliders as $slider)
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:12px;">
                            <img src="{{ asset('storage/'.$slider->image) }}"
                                 alt="{{ $slider->title }}"
                                 style="width:120px; height:70px; object-fit:cover; border-radius:8px;">
                        </td>

                        <td style="padding:12px;">
                            <strong>{{ $slider->title }}</strong>
                            <div style="color:#777; font-size:13px;">
                                {{ Str::limit($slider->subtitle, 70) }}
                            </div>
                        </td>

                        <td style="padding:12px;">{{ $slider->sort_order }}</td>

                        <td style="padding:12px;">
                            @if($slider->is_active)
                                <span style="background:#d1fae5; color:#065f46; padding:5px 10px; border-radius:20px;">Aktif</span>
                            @else
                                <span style="background:#eee; color:#666; padding:5px 10px; border-radius:20px;">Tidak Aktif</span>
                            @endif
                        </td>

                        <td style="padding:12px;">
                            <div style="display:flex; gap:8px; flex-wrap:wrap;">
                                <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                   style="background:#e8e3d5; color:#333; padding:7px 12px; border-radius:6px; text-decoration:none;">
                                    Edit
                                </a>

                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus slider ini?')">
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
                        <td colspan="5" style="padding:30px; text-align:center; color:#777;">
                            Belum ada slider.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px;">
            {{ $sliders->links() }}
        </div>
    </div>
</div>
@endsection