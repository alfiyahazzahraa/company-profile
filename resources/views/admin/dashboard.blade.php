
@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - RuangRona')
@section('header', 'Dashboard Admin')

@section('content')

<style>
    .dashboard-welcome {
        margin-bottom: 25px;
    }

    .dashboard-welcome p {
        color: #897967;
        margin-top: 8px;
    }

    /* Statistik utama */
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 28px;
    }

    .dashboard-stat {
        background: #FAF7F2;
        border: 1px solid #D5C6B5;
        padding: 25px;
        border-radius: 14px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .dashboard-stat:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(81, 69, 56, 0.10);
    }

    .dashboard-stat h3 {
        font-size: 14px;
        font-weight: normal;
        color: #897967;
        margin-bottom: 14px;
    }

    .dashboard-stat .number {
        font-size: 30px;
        font-weight: bold;
        color: #76614A;
    }

    /* WordPress card */
    .wordpress-card {
        background: #E7DDD0;
        border: 1px solid #D5C6B5;
        padding: 24px;
        border-radius: 14px;
        margin-bottom: 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .wordpress-card h2 {
        color: #514538;
        font-size: 20px;
        margin-bottom: 8px;
    }

    .wordpress-card p {
        color: #897967;
        font-size: 14px;
    }

    .wordpress-button {
        display: inline-block;
        background: #76614A;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        transition: 0.3s;
    }

    .wordpress-button:hover {
        background: #514538;
    }

    /* Ringkasan pesan */
    .message-summary {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin: 24px 0;
    }

    .message-summary-item {
        flex: 1;
        min-width: 180px;
        background: #E7DDD0;
        padding: 18px 20px;
        border-radius: 12px;
        border: 1px solid #D5C6B5;
    }

    .message-summary-item h4 {
        margin: 0 0 8px;
        color: #76614A;
        font-size: 14px;
        font-weight: 500;
    }

    .message-summary-item .summary-number {
        font-size: 24px;
        font-weight: 700;
        color: #514538;
    }

    /* Tabel */
    .dashboard-table-wrapper {
        background: #FAF7F2;
        border: 1px solid #D5C6B5;
        border-radius: 14px;
        padding: 24px;
        overflow-x: auto;
    }

    .dashboard-table-wrapper h2 {
        font-size: 20px;
        margin-bottom: 20px;
        color: #514538;
    }

    .dashboard-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 650px;
    }

    .dashboard-table th,
    .dashboard-table td {
        text-align: left;
        padding: 14px;
        border-bottom: 1px solid #D5C6B5;
        font-size: 14px;
    }

    .dashboard-table th {
        background: #E7DDD0;
        color: #514538;
    }

    .dashboard-table tbody tr {
        transition: background 0.2s ease;
    }

    .dashboard-table tbody tr:hover {
        background: #F3EAE0;
    }

    /* Badge status */
    .dashboard-status {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 20px;
        background: #E7DDD0;
        color: #76614A;
        font-size: 12px;
        font-weight: 500;
    }

    .status-unread {
        background: #F3E0C8;
        color: #8A5427;
    }

    .status-read {
        background: #E5E2D9;
        color: #665D4E;
    }

    .status-replied {
        background: #DCE8DC;
        color: #476447;
    }

    .dashboard-empty {
        text-align: center;
        color: #897967;
        padding: 30px;
    }

    /* Responsive */
    @media (max-width: 1000px) {
        .dashboard-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .dashboard-stats {
            grid-template-columns: 1fr;
        }

        .message-summary-item {
            min-width: 130px;
        }
    }
</style>

{{-- Sambutan --}}
<div class="dashboard-welcome">
    <h2>Selamat Datang di Dashboard</h2>
    <p>RuangRona Interior & Living Studio</p>
</div>

{{-- Statistik utama --}}
<div class="dashboard-stats">

    <div class="dashboard-stat">
        <h3>Total Layanan</h3>
        <div class="number">{{ $totalServices }}</div>
    </div>

    <div class="dashboard-stat">
        <h3>Total Portofolio</h3>
        <div class="number">{{ $totalPortfolios }}</div>
    </div>

    <div class="dashboard-stat">
        <h3>Total Artikel</h3>
        <div class="number">{{ $totalPosts }}</div>
    </div>

    <div class="dashboard-stat">
        <h3>Pesan Belum Dibaca</h3>
        <div class="number">{{ $newMessages }}</div>
    </div>

</div>

{{-- WordPress CMS --}}
<div class="wordpress-card">
    <div>
        <h2>WordPress Headless CMS</h2>
        <p>Kelola berita, artikel, dan konten RuangRona melalui WordPress.</p>
    </div>

    <a href="http://localhost/wordpress-cms/wp-admin"
       target="_blank"
       rel="noopener noreferrer"
       class="wordpress-button">
        Buka WordPress CMS ↗
    </a>
</div>

{{-- Ringkasan pesan --}}
<div class="message-summary">

    <div class="message-summary-item">
        <h4>Belum Dibaca</h4>
        <div class="summary-number">{{ $newMessages }}</div>
    </div>

    <div class="message-summary-item">
        <h4>Dibaca</h4>
        <div class="summary-number">{{ $processedMessages }}</div>
    </div>

    <div class="message-summary-item">
        <h4>Sudah Dibalas</h4>
        <div class="summary-number">{{ $completedMessages }}</div>
    </div>

</div>

{{-- Pesan terbaru --}}
<div class="dashboard-table-wrapper">

    <h2>Pesan Terbaru</h2>

    @if($recentMessages->count() > 0)

        <table class="dashboard-table">

            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Subjek</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>

                @foreach($recentMessages as $message)

                    <tr>
                        <td>{{ $message->name }}</td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject }}</td>

                        <td>
                            <span class="dashboard-status
                                @if($message->status == 'Belum dibaca')
                                    status-unread
                                @elseif($message->status == 'Dibaca')
                                    status-read
                                @elseif($message->status == 'Sudah dibalas')
                                    status-replied
                                @endif
                            ">
                                {{ $message->status }}
                            </span>
                        </td>

                        <td>
                            {{ $message->created_at->format('d/m/Y') }}
                        </td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <div class="dashboard-empty">
            Belum ada pesan masuk.
        </div>

    @endif

</div>

@endsection
