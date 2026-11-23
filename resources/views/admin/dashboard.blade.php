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

    .dashboard-status {
        display: inline-block;
        padding: 7px 11px;
        border-radius: 20px;
        background: #E7DDD0;
        color: #76614A;
        font-size: 12px;
    }

    .dashboard-empty {
        text-align: center;
        color: #897967;
        padding: 30px;
    }

    @media (max-width: 1000px) {
        .dashboard-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 500px) {
        .dashboard-stats {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="dashboard-welcome">
    <h2>Selamat Datang di Dashboard</h2>
    <p>RuangRona Interior & Living Studio</p>
</div>

<div class="dashboard-stats">

    <div class="dashboard-stat">
        <h3>Total Pesan</h3>
        <div class="number">{{ $totalMessages }}</div>
    </div>

    <div class="dashboard-stat">
        <h3>Belum Dibaca</h3>
        <div class="number">{{ $newMessages }}</div>
    </div>

    <div class="dashboard-stat">
        <h3>Dibaca</h3>
        <div class="number">{{ $processedMessages }}</div>
    </div>

    <div class="dashboard-stat">
        <h3>Sudah Dibalas</h3>
        <div class="number">{{ $completedMessages }}</div>
    </div>

</div>

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
                            <span class="dashboard-status">
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
