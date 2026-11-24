
@extends('admin.layouts.app')

@section('title', 'Kelola Portfolio')
@section('header', 'Kelola Portfolio')

@section('content')

<style>
    .portfolio-container {
        background: #FAF7F2;
        border: 1px solid #D5C6B5;
        border-radius: 14px;
        padding: 24px;
        overflow-x: auto;
    }

    .portfolio-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 24px;
    }

    .portfolio-button {
        background: #76614A;
        color: white;
        padding: 11px 18px;
        border-radius: 8px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .portfolio-button:hover {
        background: #514538;
    }

    .portfolio-table {
        width: 100%;
        min-width: 800px;
        border-collapse: collapse;
    }

    .portfolio-table th,
    .portfolio-table td {
        padding: 14px;
        text-align: left;
        border-bottom: 1px solid #D5C6B5;
    }

    .portfolio-table th {
        background: #E7DDD0;
        color: #514538;
    }

    .portfolio-table tbody tr:hover {
        background: #F3EAE0;
    }

    .portfolio-image {
        width: 80px;
        height: 65px;
        object-fit: cover;
        border-radius: 8px;
    }

    .portfolio-status {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 12px;
        background: #E7DDD0;
        color: #76614A;
    }

    .portfolio-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .portfolio-delete {
        background: #8A5427;
        color: white;
        padding: 8px 12px;
        border: none;
        border-radius: 7px;
        cursor: pointer;
    }

    .portfolio-delete:hover {
        background: #6D401D;
    }

    .portfolio-empty {
        padding: 30px;
        text-align: center;
        color: #897967;
    }
</style>

<div class="portfolio-container">

    <div class="portfolio-header">
        <div>
            <h2>Daftar Portfolio</h2>

            <p style="color:#897967; margin-top:8px;">
                Kelola hasil proyek dan portofolio RuangRona.
            </p>
        </div>

        <a href="{{ route('admin.portfolios.create') }}"
           class="portfolio-button">
            + Tambah Portfolio
        </a>
    </div>

    @if($portfolios->count() > 0)

        <table class="portfolio-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Proyek</th>
                    <th>Kategori</th>
                    <th>Client</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($portfolios as $portfolio)
                    <tr>
                        <td>
                            @if($portfolio->cover_image)
                                <img
                                    src="{{ asset('storage/' . $portfolio->cover_image) }}"
                                    alt="{{ $portfolio->title }}"
                                    class="portfolio-image"
                                >
                            @else
                                <span>-</span>
                            @endif
                        </td>

                        <td>{{ $portfolio->title }}</td>

                        <td>
                            {{ $portfolio->category->name ?? '-' }}
                        </td>

                        <td>{{ $portfolio->client ?? '-' }}</td>

                        <td>
                            {{ $portfolio->project_date
                                ? $portfolio->project_date->format('d/m/Y')
                                : '-' }}
                        </td>

                        <td>
                            <span class="portfolio-status">
                                {{ $portfolio->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>

                        <td>
                            <div class="portfolio-actions">

                                <a
                                    href="{{ route('admin.portfolios.edit', $portfolio) }}"
                                    class="portfolio-button"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('admin.portfolios.destroy', $portfolio) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus portfolio ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="portfolio-delete"
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
            {{ $portfolios->links() }}
        </div>

    @else

        <div class="portfolio-empty">
            Belum ada portfolio yang ditambahkan.
        </div>

    @endif

</div>

@endsection
