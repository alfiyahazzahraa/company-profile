
@extends('admin.layouts.app')

@section('title', 'Kelola Testimonial')
@section('header', 'Kelola Testimonial')

@section('content')

<style>
    .testimonial-container {
        background: #FAF7F2;
        border: 1px solid #D5C6B5;
        border-radius: 14px;
        padding: 24px;
        overflow-x: auto;
    }

    .testimonial-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .testimonial-button {
        background: #76614A;
        color: white;
        padding: 11px 18px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .testimonial-button:hover {
        background: #514538;
    }

    .testimonial-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }

    .testimonial-table th,
    .testimonial-table td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #D5C6B5;
    }

    .testimonial-table th {
        background: #E7DDD0;
        color: #514538;
    }

    .testimonial-table tbody tr:hover {
        background: #F3EAE0;
    }

    .testimonial-image {
        width: 65px;
        height: 65px;
        object-fit: cover;
        border-radius: 50%;
    }

    .testimonial-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        background: #E7DDD0;
        color: #76614A;
    }

    .testimonial-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .testimonial-delete {
        background: #8A5427;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 7px;
        cursor: pointer;
    }

    .testimonial-delete:hover {
        background: #6D401D;
    }

    .testimonial-empty {
        padding: 30px;
        text-align: center;
        color: #897967;
    }

    .testimonial-message {
        padding: 12px 16px;
        margin-bottom: 20px;
        background: #E7DDD0;
        color: #514538;
        border-radius: 8px;
    }
</style>

<div class="testimonial-container">

    <div class="testimonial-header">
        <div>
            <h2>Daftar Testimonial</h2>

            <p style="color:#897967; margin-top:8px;">
                Kelola testimoni pelanggan RuangRona.
            </p>
        </div>

        <a href="{{ route('admin.testimonials.create') }}"
           class="testimonial-button">
            + Tambah Testimonial
        </a>
    </div>

    @if(session('success'))
        <div class="testimonial-message">
            {{ session('success') }}
        </div>
    @endif

    @if($testimonials->count() > 0)

        <table class="testimonial-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Perusahaan</th>
                    <th>Testimoni</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($testimonials as $testimonial)
                    <tr>
                        <td>
                            @if($testimonial->photo)
                                <img
                                    src="{{ asset('storage/' . $testimonial->photo) }}"
                                    alt="{{ $testimonial->name }}"
                                    class="testimonial-image"
                                >
                            @else
                                <span>-</span>
                            @endif
                        </td>

                        <td>{{ $testimonial->name }}</td>

                        <td>{{ $testimonial->position ?? '-' }}</td>

                        <td>{{ $testimonial->company ?? '-' }}</td>

                        <td>
                            {{ \Illuminate\Support\Str::limit(
                                $testimonial->testimonial, 80
                            ) }}
                        </td>

                        <td>
                            <span class="testimonial-status">
                                {{ $testimonial->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>

                        <td>
                            <div class="testimonial-actions">

                                <a
                                    href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                    class="testimonial-button"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus testimonial ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="testimonial-delete"
                                    >
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:20px;">
            {{ $testimonials->links() }}
        </div>

    @else

        <div class="testimonial-empty">
            Belum ada testimonial yang ditambahkan.
        </div>

    @endif

</div>

@endsection
