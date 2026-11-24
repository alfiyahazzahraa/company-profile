
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RuangRona — Interior & Living Studio</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- CSS External -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <!-- NAVBAR -->
    <header>
        <a href="/" class="logo">
            ruang<span>rona.</span>
        </a>

        <nav>
             <a href="#beranda">Beranda</a>
             <a href="#tentang">Tentang</a>
             <a href="#layanan">Layanan</a>
             <a href="{{ url('/berita-wordpress') }}">Berita</a>
             
             <a href="{{ route('contact') }}" class="nav-contact">
                Hubungi Kami
             </a>
        </nav>
    </header>


    <!-- HERO -->
    <section class="hero" id="beranda">

        <div>
            <p class="eyebrow">Interior & Living Studio</p>

            <h1>
                Ruang yang indah,
                <em>cerita yang bermakna.</em>
            </h1>

            <p class="hero-description">
                Kami percaya setiap ruang memiliki cerita.
                Melalui desain yang hangat dan fungsional,
                kami membantu menciptakan tempat yang terasa seperti rumah.
            </p>

            <div class="hero-actions">
                <a href="#layanan" class="primary-button">
                    Jelajahi Layanan
                </a>

                <a href="#tentang" class="text-link">
                    Tentang Kami ↗
                </a>
            </div>
        </div>

        <div class="hero-image"></div>

    </section>


    <!-- ABOUT -->
    <section class="intro" id="tentang">

        <p class="eyebrow">Cerita Kami</p>

        <h2>
            Menghadirkan keindahan
            <br>
            di setiap sudut ruang.
        </h2>

        <p>
            RuangRona adalah studio desain interior yang berfokus pada
            perpaduan estetika, kenyamanan, dan fungsi. Kami menghadirkan
            solusi desain yang dirancang sesuai karakter dan kebutuhan
            setiap klien.
        </p>

    </section>


    <!-- SERVICES -->
    <section class="services" id="layanan">

        <div class="section-heading">

            <div>
                <p class="eyebrow">Apa yang Kami Kerjakan</p>
                <h2>Layanan Kami</h2>
            </div>

            <p>
                Setiap detail dirancang dengan tujuan untuk
                menciptakan ruang yang lebih baik.
            </p>

        </div>


        <div class="service-grid">

            <!-- SERVICE 1 -->
            <div class="service-card">

                <div class="service-number">01</div>

                <h3>Interior Design</h3>

                <p>
                    Perencanaan desain interior yang nyaman,
                    estetik, dan sesuai karakter ruang.
                </p>

            </div>


            <!-- SERVICE 2 -->
            <div class="service-card">

                <div class="service-number">02</div>

                <h3>Space Planning</h3>

                <p>
                    Pengaturan tata ruang yang efektif agar
                    setiap area berfungsi secara optimal.
                </p>

            </div>


            <!-- SERVICE 3 -->
            <div class="service-card">

                <div class="service-number">03</div>

                <h3>Consultation</h3>

                <p>
                    Konsultasi desain untuk membantu mewujudkan
                    konsep ruang sesuai kebutuhan.
                </p>

            </div>

        </div>

    </section>


    <!-- QUOTE -->
    <section class="quote">

        <p>
            "Desain yang baik bukan hanya tentang bagaimana
            ruang terlihat, tetapi juga bagaimana ruang membuat kita merasa."
        </p>

        <span>RUANGRONA STUDIO</span>

    </section>


    <!-- CONTACT CTA -->
    <section class="contact" id="kontak">

        <div>
            <p class="eyebrow">Mari Berkolaborasi</p>

            <h2>Punya ruang untuk diwujudkan?</h2>

            <p>
                Ceritakan ide dan kebutuhan desain Anda kepada kami.
            </p>
        </div>

        <a href="{{ route('contact') }}" class="primary-button">
            Mulai Percakapan ↗
        </a>

    </section>


    <!-- FOOTER -->
    <footer>

        <p>
            © 2026 RuangRona Studio. All rights reserved.
        </p>

        <p>
            Designed with care.
        </p>

    </footer>

</body>
</html>
