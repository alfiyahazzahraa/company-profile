<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox Admin | RuangRona</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f3f1e9;
            color: #38483d;
        }

        header {
            background: #536b58;
            color: white;
            padding: 25px 40px;
        }

        header h1 {
            margin: 0;
            font-size: 26px;
        }

        header p {
            margin: 8px 0 0;
        }

        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .message {
            background: white;
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .message h3 {
            margin-top: 0;
            color: #536b58;
        }

        .meta {
            font-size: 14px;
            color: #777;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .content {
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            line-height: 1.7;
        }

        .status {
            margin: 20px 0 12px;
            font-weight: bold;
        }

        select, button {
            padding: 10px 14px;
            border-radius: 7px;
            border: 1px solid #cbd2c7;
            font-size: 14px;
        }

        select {
            background: white;
            color: #38483d;
        }

        button {
            background: #536b58;
            color: white;
            cursor: pointer;
            border: none;
        }

        button:hover {
            background: #405444;
        }

        .delete-button {
            background: #a34444;
        }

        .delete-button:hover {
            background: #873636;
        }

        .status-form, .delete-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .delete-form {
            margin-top: 12px;
        }

        .alert {
            padding: 15px;
            background: #e0eadf;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .empty {
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .summary-card h3 {
            margin: 0 0 10px;
            font-size: 15px;
        }

        .summary-card p {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }

        /* Pencarian */
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 25px;
        }

        .search-form input {
            flex: 1;
            min-width: 200px;
            padding: 12px;
            border: 1px solid #cbd2c7;
            border-radius: 8px;
            font-size: 14px;
        }

        .reset-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            background: #e5e5e5;
            color: #38483d;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        .reset-button:hover {
            background: #d5d5d5;
        }

        footer {
            text-align: center;
            color: #718074;
            padding: 30px;
        }

        @media (max-width: 700px) {
            header {
                padding: 25px 20px;
            }

            .summary {
                grid-template-columns: 1fr;
            }

            main {
                margin: 25px auto;
            }

            .message {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <header>
        <h1>RuangRona Admin</h1>
        <p>Inbox Pesan Pelanggan</p>
    </header>

    <main>

        <h2>Daftar Pesan</h2>

        

        <p>Total pesan masuk: {{ $messages->count() }}</p>

        <div class="summary">
            <div class="summary-card">
                <h3>Belum dibaca</h3>
                <p>{{ $unreadCount }}</p>
            </div>

            <div class="summary-card">
                <h3>Dibaca</h3>
                <p>{{ $readCount }}</p>
            </div>

            <div class="summary-card">
                <h3>Sudah dibalas</h3>
                <p>{{ $repliedCount }}</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.messages.index') }}"
              method="GET"
              class="search-form">

            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari nama, email, atau subjek pesan..."
            >

            <button type="submit">Cari</button>

            @if(!empty($search))
                <a href="{{ route('admin.messages.index') }}"
                   class="reset-button">
                    Reset
                </a>
            @endif
        </form>

        @forelse ($messages as $message)

            <article class="message">

                <h3>{{ $message->subject }}</h3>

                <div class="meta">
                    <strong>Nama:</strong> {{ $message->name }} <br>
                    <strong>Email:</strong> {{ $message->email }} <br>
                    <strong>Tanggal:</strong>
                    {{ $message->created_at->format('d M Y, H:i') }}
                </div>

                <div class="content">{{ $message->message }}</div>

                <div class="status">
                    Status saat ini: {{ $message->status }}
                </div>

                <form
                    action="{{ route('admin.messages.update', $message->id) }}"
                    method="POST"
                    class="status-form"
                >
                    @csrf
                    @method('PATCH')

                    <select name="status" required>
                        <option value="Belum dibaca"
                            {{ $message->status === 'Belum dibaca' ? 'selected' : '' }}>
                            Belum dibaca
                        </option>

                        <option value="Dibaca"
                            {{ $message->status === 'Dibaca' ? 'selected' : '' }}>
                            Dibaca
                        </option>

                        <option value="Sudah dibalas"
                            {{ $message->status === 'Sudah dibalas' ? 'selected' : '' }}>
                            Sudah dibalas
                        </option>
                    </select>

                    <button type="submit">Update Status</button>
                </form>

                <form
                    action="{{ route('admin.messages.destroy', $message->id) }}"
                    method="POST"
                    class="delete-form"
                    onsubmit="return confirm('Yakin ingin menghapus pesan ini?');"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="delete-button">
                        Hapus Pesan
                    </button>
                </form>

            </article>

        @empty

            <div class="empty">
                @if(!empty($search))
                    <p>Pesan dengan kata kunci "{{ $search }}" tidak ditemukan.</p>
                @else
                    <p>Belum ada pesan masuk.</p>
                @endif
            </div>

        @endforelse

    </main>

    <footer>
        &copy; {{ date('Y') }} RuangRona Interior & Living Studio
    </footer>

</body>
</html>