
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RuangRona</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f1ec;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 40px 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #514638;
        }

        .header p {
            margin-top: 8px;
            color: #777;
        }

        .buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary {
            background: #665440;
            color: white;
        }

        .btn-secondary {
            background: #ddd4c7;
            color: #42372c;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.04);
        }

        .card h3 {
            font-size: 14px;
            color: #777;
            margin-bottom: 15px;
        }

        .card .number {
            font-size: 32px;
            font-weight: bold;
            color: #665440;
        }

        .section {
            background: white;
            padding: 25px;
            border-radius: 14px;
            overflow-x: auto;
        }

        .section h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #514638;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th, td {
            text-align: left;
            padding: 14px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        th {
            background: #f8f6f2;
            color: #665440;
        }

        .status {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 20px;
            background: #eee7dc;
            font-size: 12px;
        }

        .empty {
            padding: 25px;
            text-align: center;
            color: #888;
        }

        @media (max-width: 850px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 500px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .header h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <div>
            <h1>Dashboard Admin</h1>
            <p>RuangRona Interior & Living Studio</p>
        </div>

        <div class="buttons">
            <a href="{{ route('admin.messages.index') }}"
               class="btn btn-primary">
                Lihat Inbox
            </a>

            <a href="{{ route('admin.logout') }}"
               class="btn btn-secondary"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form"
                  action="{{ route('admin.logout') }}"
                  method="POST"
                  style="display:none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="stats">

        <div class="card">
            <h3>Total Pesan</h3>
            <div class="number">{{ $totalMessages }}</div>
        </div>

        <div class="card">
            <h3>Belum Dibaca</h3>
            <div class="number">{{ $newMessages }}</div>
        </div>

        <div class="card">
            <h3>Dibaca</h3>
            <div class="number">{{ $processedMessages }}</div>
        </div>

        <div class="card">
            <h3>Sudah Dibalas</h3>
            <div class="number">{{ $completedMessages }}</div>
        </div>

    </div>

    <div class="section">
        <h2>Pesan Terbaru</h2>

        @if($recentMessages->count() > 0)

            <table>
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
                                <span class="status">
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

            <div class="empty">
                Belum ada pesan masuk.
            </div>

        @endif
    </div>

</div>

</body>
</html>
