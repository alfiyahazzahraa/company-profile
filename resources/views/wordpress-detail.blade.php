
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ strip_tags($post['title']['rendered']) }} | RuangRona</title>

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
            line-height: 1.8;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .navbar {
            padding: 22px 8%;
            background: #fff;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .container {
            max-width: 850px;
            margin: 60px auto;
            padding: 0 20px;
        }

        .back-link {
            display: inline-block;
            color: #a47b58;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .date {
            color: #a47b58;
            font-size: 13px;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 42px;
            line-height: 1.3;
            margin-bottom: 30px;
        }

        .cover {
            width: 100%;
            border-radius: 14px;
            margin-bottom: 35px;
            display: block;
        }

        .article-content {
            background: #fff;
            padding: 35px;
            border-radius: 12px;
            overflow-wrap: break-word;
        }

        .article-content p {
            margin-bottom: 20px;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .article-content h2,
        .article-content h3 {
            margin: 25px 0 15px;
        }

        .footer {
             background: #292929;
             color: white;
             text-align: center;
             padding: 45px 20px;
             margin-top: 60px;
             font-size: 13px;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 20px;
                flex-direction: column;
                gap: 20px;
            }

            .nav-links {
                gap: 18px;
            }

            .container {
                margin: 35px auto;
            }

            h1 {
                font-size: 30px;
            }

            .article-content {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <div class="logo">RUANGRONA.</div>

        <div class="nav-links">
            <a href="/">Beranda</a>
            <a href="/berita-wordpress">Berita</a>
            <a href="/kontak">Kontak</a>
        </div>
    </nav>

    <main class="container">

        <a href="/berita-wordpress" class="back-link">
            ← Kembali ke berita
        </a>

        <div class="date">
            {{ \Carbon\Carbon::parse($post['date'])->translatedFormat('d F Y') }}
        </div>

        <h1>
            {!! $post['title']['rendered'] !!}
        </h1>

        @php
            $image = $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? null;
        @endphp

        @if ($image)
            <img src="{{ $image }}" class="cover" alt="Gambar artikel">
        @endif

        <article class="article-content">
            {!! $post['content']['rendered'] !!}
        </article>

    </main>

    <footer class="footer">
        &copy; {{ date('Y') }} RuangRona. All rights reserved.
    </footer>

</body>
</html>