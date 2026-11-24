
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita | RuangRona</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f8f7f4;
            color: #292929;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .navbar {
            padding: 22px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border-bottom: 1px solid #eee;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .nav-links {
            display: flex;
            gap: 28px;
            font-size: 14px;
        }

        .nav-links a:hover {
            color: #a47b58;
        }

        .hero {
            text-align: center;
            padding: 90px 20px 70px;
        }

        .hero-label {
            color: #a47b58;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .hero p {
            color: #777;
            max-width: 600px;
            margin: auto;
            line-height: 1.8;
        }

        .news-section {
            padding: 20px 8% 90px;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .news-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #eee;
            transition: transform 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }

        .news-image {
            width: 100%;
            height: 230px;
            object-fit: cover;
            display: block;
        }

        .image-placeholder {
            height: 230px;
            background: #e8e3db;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #82796e;
            font-size: 14px;
        }

        .news-content {
            padding: 25px;
        }

        .news-date {
            font-size: 12px;
            color: #a47b58;
            margin-bottom: 14px;
        }

        .news-title {
            font-size: 21px;
            line-height: 1.5;
            margin-bottom: 14px;
        }

        .news-excerpt {
            font-size: 14px;
            color: #777;
            line-height: 1.8;
            margin-bottom: 22px;
        }

        .news-link {
            font-size: 14px;
            font-weight: bold;
            color: #a47b58;
        }

        .news-link:hover {
            color: #76563d;
        }

        .footer {
            background: #292929;
            color: #fff;
            text-align: center;
            padding: 30px 20px;
            font-size: 13px;
        }

        @media (max-width: 900px) {
            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .hero h1 {
                font-size: 38px;
            }
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 20px;
                flex-direction: column;
                gap: 20px;
            }

            .nav-links {
                gap: 18px;
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero {
                padding: 60px 20px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .news-section {
                padding: 10px 20px 60px;
            }

            .news-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">RUANGRONA.</div>

        <div class="nav-links">
            <a href="/">Beranda</a>
            <a href="/berita-wordpress">Berita</a>
            <a href="/kontak">Kontak</a>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-label">RuangRona Journal</div>

        <h1>Cerita & Informasi</h1>

        <p>
            Temukan berbagai informasi, cerita, dan kabar terbaru
            seputar RuangRona melalui artikel yang kami sajikan.
        </p>
    </section>

    <!-- Berita -->
    <section class="news-section">
        <div class="news-grid">

            @forelse ($posts as $post)

                @php
                    $image = $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? null;
                @endphp

                <article class="news-card">

                    @if ($image)
                        <img
                            src="{{ $image }}"
                            alt="{{ strip_tags($post['title']['rendered']) }}"
                            class="news-image"
                        >
                    @else
                        <div class="image-placeholder">
                            RuangRona Journal
                        </div>
                    @endif

                    <div class="news-content">

                        <div class="news-date">
                            {{ \Carbon\Carbon::parse($post['date'])->translatedFormat('d F Y') }}
                        </div>

                        <h2 class="news-title">
                            {!! $post['title']['rendered'] !!}
                        </h2>

                        <div class="news-excerpt">
                            {!! \Illuminate\Support\Str::limit(strip_tags($post['excerpt']['rendered'] ?? $post['content']['rendered']), 120) !!}
                        </div>

                        <a
                        href="{{ url('/berita-wordpress/' . $post['slug']) }}"
                        class="news-link"
                        >
                            Baca selengkapnya →
                        </a>

                    </div>
                </article>

            @empty

                <p>Belum ada berita yang tersedia.</p>

            @endforelse

        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        &copy; {{ date('Y') }} RuangRona. All rights reserved.
    </footer>

</body>
</html>
