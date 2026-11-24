<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Admin</title>

    <style>
        :root {
            --forest: #405B45;
            --forest-dark: #304735;
            --forest-soft: #617A5B;
            --sage: #829773;
            --sage-light: #DCE5D4;
            --cream: #F5F2E9;
            --cream-bg: #EEEFE6;
            --white: #FAF9F4;
            --text: #465747;
            --muted: #899485;
            --border: #D8DFD1;
            --terracotta: #B78375;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: var(--cream-bg);
            color: var(--text);
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
        }

        /* WRAPPER */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            min-width: 250px;
            background: var(--forest);
            color: var(--cream);
            min-height: 100vh;
            padding: 25px 18px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            padding: 10px 12px 28px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
            margin-bottom: 20px;
        }

        .sidebar-brand h2 {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .sidebar-brand p {
            font-size: 12px;
            margin-top: 6px;
            color: #D8E2D3;
        }

        .nav-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #D1DDCD;
            opacity: 0.8;
            margin: 20px 12px 10px;
        }

        .sidebar-nav {
            list-style: none;
        }

        .sidebar-nav li {
            margin-bottom: 5px;
        }

        .sidebar-nav a {
            display: block;
            padding: 12px 14px;
            border-radius: 9px;
            color: #F5F2E9;
            font-size: 14px;
            transition: 0.2s ease;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: var(--sage-light);
            color: var(--forest-dark);
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.15);
        }

        .sidebar-bottom button {
            width: 100%;
            text-align: left;
            padding: 12px 14px;
            border-radius: 9px;
            background: var(--terracotta);
            border: 1px solid var(--terracotta);
            color: #fff;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s ease;
        }

        .sidebar-bottom button:hover {
            background: #A36E60;
            border-color: #A36E60;
        }

        /* MAIN */
        .main-area {
            flex: 1;
            min-width: 0;
            background: var(--cream-bg);
        }

        .topbar {
            background: var(--white);
            padding: 22px 30px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .topbar h1 {
            font-size: 23px;
            color: var(--forest);
        }

        .topbar-user {
            font-size: 14px;
            color: var(--muted);
            background: var(--cream);
            padding: 9px 15px;
            border: 1px solid var(--border);
            border-radius: 30px;
        }

        .content-area {
            padding: 30px;
        }

        /* CARD */
        .card,
        .stat-card,
        .panel {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(64,91,69,0.04);
        }

        /* BUTTON */
        button,
        .btn,
        .btn-primary {
            background: var(--forest-soft);
            color: #fff;
            border: 1px solid var(--forest-soft);
            padding: 11px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: 0.2s ease;
        }

        button:hover,
        .btn:hover,
        .btn-primary:hover {
            background: var(--forest-dark);
            border-color: var(--forest-dark);
        }

        .btn-secondary {
            background: var(--sage-light);
            color: var(--forest-dark);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--sage);
            color: #fff;
        }

        /* FORM */
        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: var(--white);
            color: var(--text);
            font-size: 14px;
            margin-top: 6px;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--sage);
            box-shadow: 0 0 0 3px rgba(130,151,115,0.15);
        }

        label {
            color: var(--text);
            font-weight: 600;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white);
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid var(--border);
            text-align: left;
            color: var(--text);
        }

        th {
            background: var(--sage-light);
            font-weight: 600;
        }

        /* ALERT */
        .alert-success {
            padding: 15px;
            background: #E5EBDD;
            color: #526746;
            border: 1px solid #C9D6BE;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-danger {
            padding: 15px;
            background: #F0E0D9;
            color: #855849;
            border: 1px solid #DEC1B3;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* GENERAL */
        img {
            max-width: 100%;
        }

        hr {
            border: none;
            border-top: 1px solid var(--border);
            margin: 20px 0;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .admin-wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                min-width: 100%;
                min-height: auto;
                padding: 20px 15px;
            }

            .sidebar-nav {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }

            .sidebar-nav li {
                margin-bottom: 0;
            }

            .sidebar-brand {
                padding-bottom: 15px;
            }

            .nav-label {
                margin-top: 15px;
            }

            .sidebar-bottom {
                margin-top: 20px;
            }

            .content-area {
                padding: 18px;
            }

            .topbar {
                padding: 18px;
            }

            .topbar h1 {
                font-size: 20px;
            }
        }

        @media (max-width: 480px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .topbar-user {
                font-size: 12px;
            }

            .sidebar-nav a {
                padding: 10px 12px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

<div class="admin-wrapper">

    {{-- SIDEBAR --}}
    <aside class="sidebar">

        <div class="sidebar-brand">
            <h2>Admin Panel</h2>
            <p>Website Management</p>
        </div>

        <div class="nav-label">Menu Utama</div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ url('/admin/dashboard') }}"
                   class="{{ request()->is('admin/dashboard') || request()->is('admin') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
        </ul>

        <div class="nav-label">Konten Website</div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.pages.index') }}"
                    class="{{ request()->is('admin/pages*') ? 'active' : '' }}">
                    Halaman
                </a>
            </li>

            <li>
                <a href="{{ route('admin.sliders.index') }}"
                    class="{{ request()->is('admin/sliders*') ? 'active' : '' }}">
                    Slider
                </a>
            </li>

            <li>
                <a href="{{ route('admin.team.index') }}"
                    class="{{ request()->is('admin/team*') ? 'active' : '' }}">
                    Team
                </a>
            </li>

            <li>
                <a href="{{ route('admin.services.index') }}">
                    Services
                </a>
            </li>

            <li>
                <a href="{{ route('admin.portfolios.index') }}">
                    Portfolio
                </a>
            </li>
            
            <li>
                <a href="{{ route('admin.categories.index') }}"
                  class="sidebar-link">
                  <span>Categories</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.posts.index') }}"
                    class="{{ request()->is('admin/posts*') ? 'active' : '' }}">
                    Berita
                </a>
            </li>

            <li>
                <a href="{{ route('admin.testimonials.index') }}"
                     class="{{ request()->is('admin/testimonials*') ? 'active' : '' }}">
                        Testimonials
                </a>
            </li>

            <li>
                <a href="{{ route('admin.clients.index') }}"
                    class="{{ request()->is('admin/clients*') ? 'active' : '' }}">
                    Clients
                </a>
            </li>

        </ul>

        <div class="nav-label">Administrasi</div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ url('/admin/messages') }}">
                    Pesan Masuk
                </a>
            </li>

            <li>
                <a href="{{ url('/admin/settings') }}">
                    Pengaturan Website
                </a>
            </li>

            <li>
                <a href="{{ url('/profile') }}">
                    Profil Admin
                </a>
            </li>
        </ul>

        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- MAIN AREA --}}
    <div class="main-area">

        <header class="topbar">
            <h1>@yield('header', 'Dashboard')</h1>

            <div class="topbar-user">
                {{ Auth::user()->name ?? 'Admin' }}
            </div>
        </header>

        <main class="content-area">

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>
