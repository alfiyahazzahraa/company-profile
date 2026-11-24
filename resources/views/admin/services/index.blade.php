
@extends('admin.layouts.app')

@section('title', 'Kelola Layanan')
@section('header', 'Kelola Layanan')

@section('content')

<style>
    .services-container {
        background: #FAF7F2;
        border: 1px solid #D5C6B5;
        border-radius: 14px;
        padding: 24px;
        overflow-x: auto;
    }

    .services-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .services-button {
        background: #76614A;
        color: white;
        padding: 11px 18px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .services-button:hover {
        background: #514538;
    }

    .services-table {
        width: 100%;
        min-width: 650px;
        border-collapse: collapse;
    }

    .services-table th,
    .services-table td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #D5C6B5;
    }

    .services-table th {
        background: #E7DDD0;
        color: #514538;
    }

    .services-table tbody tr:hover {
        background: #F3EAE0;
    }

    .service-image {
        width: 70px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
    }

    .service-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        background: #E7DDD0;
        color: #76614A;
    }

    .service-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .service-delete {
        background: #8A5427;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 7px;
        cursor: pointer;
    }

    .service-delete:hover {
        background: #6D401D;
    }

    .service-alert {
        padding: 14px;
        background: #DCE8DC;
        color: #476447;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .service-empty {
        padding: 30px;
        text-align: center;
        color: #897967;
    }
</style>

<div class="services-container">

    <div class="services-header">
        <div>
            <h2>Daftar Layanan</h2>
            <p style="color:#897967; margin-top:8px;">
                Kelola konten layanan RuangRona.
            </p>
        </div>

        <a href="{{ route('admin.services.create') }}"
           class="services-button">
            + Tambah Layanan
        </a>
    </div>

    @if(session('success'))
        <div class="service-alert">
            {{ session('success') }}
        </div>
    @endif

    @if($services->count() > 0)

        <table class="services-table">

            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($services as $service)

                    <tr>
                        <td>
                            @if($service->image)
                                <img
                                    src="{{ asset('storage/' . $service->image) }}"
                                    alt="{{ $service->title }}"
                                    class="service-image"
                                >
                            @else
                                <span>-</span>
                            @endif
                        </td>

                        <td>{{ $service->title }}</td>

                        <td>{{ $service->slug }}</td>

                        <td>
                            <span class="service-status">
                                {{ $service->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>

                        <td>
                            <div class="service-actions">

                                <a href="{{ route('admin.services.edit', $service) }}"
                                   class="services-button">
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.services.destroy', $service) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus layanan ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="service-delete">
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
            {{ $services->links() }}
        </div>

    @else

        <div class="service-empty">
            Belum ada layanan yang ditambahkan.
        </div>

    @endif

</div>

@endsection
