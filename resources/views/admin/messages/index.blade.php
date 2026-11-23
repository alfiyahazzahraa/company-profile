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

        :root {
            --forest: #31463A;
            --forest-soft: #526747;
            --sage: #687D59;
            --sage-light: #E6EBDD;
            --cream: #FAF9F5;
            --cream-bg: #F3F5EF;
            --border: #DCE3D5;
            --text: #31463A;
            --muted: #7B8875;
            --terracotta: #A66B5E;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: var(--cream-bg);
            color: var(--text);
        }

        header {
            background: var(--forest);
            color: var(--cream);
            padding: 25px 40px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .header-content {
            max-width: 1100px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        header h1 {
            margin: 0;
            font-size: 26px;
        }

        header p {
            margin: 8px 0 0;
            color: #D7E0D3;
        }

        .header-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .nav-button {
            display: inline-block;
            padding: 11px 16px;
            background: var(--cream);
            color: var(--forest);
            text-decoration: none;
            border-radius: 30px;
            font-size: 14px;
            font-weight: bold;
            transition: .2s;
        }

        .nav-button:hover {
            background: var(--sage-light);
        }

        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        main h2 {
            color: var(--forest);
            font-size: 25px;
            margin-bottom: 10px;
        }

        main > p {
            color: var(--muted);
            margin-bottom: 25px;
        }

        .message {
            background: var(--cream);
            padding: 25px;
            margin-bottom: 20px;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 14px rgba(49,70,58,.04);
        }

        .message h3 {
            margin-top: 0;
            color: var(--forest);
            font-size: 19px;
        }

        .meta {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .content {
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            line-height: 1.8;
            color: #465747;
        }

        .status {
            margin: 20px 0 12px;
            font-weight: bold;
            color: var(--forest);
        }

        select, button {
            padding: 11px 15px;
            border-radius: 9px;
            border: 1px solid var(--border);
            font-size: 14px;
            font-family: inherit;
        }

        select {
            background: #F1F4EC;
            color: var(--forest);
        }

        select:focus, input:focus {
            outline: none;
            border-color: var(--sage);
            box-shadow: 0 0 0 3px rgba(104,125,89,.12);
        }

        button {
            background: var(--sage);
            color: var(--cream);
            cursor: pointer;
            border: 1px solid var(--sage);
            font-weight: bold;
            transition: .2s;
        }

        button:hover {
            background: var(--forest-soft);
            border-color: var(--forest-soft);
        }

        .delete-button {
            background: var(--terracotta);
            border-color: var(--terracotta);
        }

        .delete-button:hover {
            background: #89574C;
            border-color: #89574C;
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
            background: #E6EBDD;
            color: var(--forest);
            border: 1px solid #D3DFCB;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .empty {
            background: var(--cream);
            padding: 30px;
            border-radius: 16px;
            text-align: center;
            border: 1px solid var(--border);
            color: var(--muted);
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .summary-card {
            background: var(--cream);
            padding: 22px;
            border-radius: 15px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 14px rgba(49,70,58,.035);
        }

        .summary-card h3 {
            margin: 0 0 12px;
            font-size: 14px;
            color: var(--muted);
        }

        .summary-card p {
            margin: 0;
            font-size: 29px;
            font-weight: bold;
            color: var(--forest);
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 25px;
        }

        .search-form input {
            flex: 1;
            min-width: 200px;
            padding: 12px 15px;
            border: 1px solid var(--border);
            background: var(--cream);
            color: var(--forest);
            border-radius: 9px;
            font-size: 14px;
        }

        .search-form input::placeholder {
            color: #9AA594;
        }

        .reset-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 20px;
            background: var(--sage-light);
            color: var(--forest);
            border: 1px solid var(--border);
            border-radius: 9px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: .2s;
        }

        .reset-button:hover {
            background: #D6E1CF;
        }

        footer {
            text-align: center;
            color: var(--muted);
            padding: 30px;
        }

        @media (max-width: 700px) {
            header {
                padding: 25px 20px;
            }

            .header-content {
                align-items: flex-start;
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

            .status-form select,
            .status-form button {
                width: 100%;
            }

            .search-form button,
            .search-form .reset-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="header-content">
            <div>
                <h1>RuangRona Admin</h1>
                <p>Inbox Pesan Pelanggan</p>
            </div>

            <nav class="header-nav">
                <a href="{{ route('admin.dashboard') }}" class="nav-button">
                    Dashboard
                </a>
            </nav>
        </div>
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