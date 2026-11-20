<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hubungi Kami — RuangRona Studio</title>
    <meta name="description" content="Ceritakan ide ruang Anda kepada RuangRona Studio. Hubungi kami lewat email, telepon, atau formulir kontak.">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>

<body class="rr">

    {{-- HEADER --}}
    <header class="rr-header">
        <div class="rr-container rr-header__inner">

            <a href="{{ url('/') }}" class="rr-logo">
                ruang<span>rona.</span>
            </a>

            {{-- Hamburger --}}
            <button class="rr-burger" id="rrBurger" type="button"
                    aria-label="Buka menu"
                    aria-expanded="false"
                    aria-controls="rrNav">
                <svg width="22" height="22" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round">
                    <path d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
            </button>

            <nav class="rr-nav" id="rrNav">
                <a href="{{ url('/') }}" class="rr-nav__link">Beranda</a>
                <a href="{{ url('/tentang') }}" class="rr-nav__link">Tentang</a>
                <a href="{{ url('/layanan') }}" class="rr-nav__link">Layanan</a>
                <a href="{{ url('/kontak') }}" class="rr-btn">Hubungi Kami</a>
            </nav>

        </div>
    </header>

    <main>

        {{-- HERO --}}
        <section class="rr-hero">
            <div class="rr-container">
                <span class="rr-eyebrow">Let's Talk</span>

                <h1>Mari mulai <em>sebuah cerita.</em></h1>

                <p>
                    Setiap ruang berawal dari sebuah ide.
                    Ceritakan apa yang ingin Anda wujudkan,
                    dan kami akan membantu menemukan solusinya.
                </p>
            </div>
        </section>

        {{-- INFO + FORM --}}
        <section class="rr-container rr-grid">

            {{-- INFORMASI KONTAK --}}
            <div class="rr-info">
                <span class="rr-eyebrow">Informasi</span>

                <h2>Kami senang mendengar cerita Anda.</h2>

                <p>
                    Hubungi kami melalui informasi di bawah
                    atau kirimkan pesan melalui formulir.
                </p>

                <ul class="rr-info__list">

                    {{-- EMAIL --}}
                    <li class="rr-info__item">
                        <span class="rr-info__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="1.8" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <rect x="3" y="5" width="18" height="14" rx="3"/>
                                <path d="m4 7 8 6 8-6"/>
                            </svg>
                        </span>

                        <div>
                            <div class="rr-info__label">Email</div>
                            <a class="rr-info__value"
                               href="mailto:hello@ruangrona.com">
                                hello@ruangrona.com
                            </a>
                        </div>
                    </li>

                    {{-- TELEPON --}}
                    <li class="rr-info__item">
                        <span class="rr-info__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="1.8" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"/>
                            </svg>
                        </span>

                        <div>
                            <div class="rr-info__label">Telepon</div>
                            <a class="rr-info__value" href="tel:+628120000000">
                                +62 812 0000 0000
                            </a>
                        </div>
                    </li>

                    {{-- LOKASI --}}
                    <li class="rr-info__item">
                        <span class="rr-info__icon">
                            <svg width="22" height="22" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="1.8" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="M12 21s7-5.6 7-11a7 7 0 1 0-14 0c0 5.4 7 11 7 11Z"/>
                                <circle cx="12" cy="10" r="2.5"/>
                            </svg>
                        </span>

                        <div>
                            <div class="rr-info__label">Lokasi</div>
                            <div class="rr-info__value">
                                Yogyakarta, Indonesia
                            </div>
                        </div>
                    </li>

                </ul>
            </div>

            <div class="rr-card">

                <div class="rr-card__kicker">RuangRona Studio</div>
                <h3>Kirim Pesan</h3>

                <form id="rrForm"
                      action="{{ route('contact.store') }}"
                      method="POST">

                    @csrf

                    @if (session('success'))
                        <div class="rr-alert is-visible" id="rrAlert" role="status">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="rr-alert is-visible" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="rr-row">

                        <div class="rr-field">
                            <label for="nama">Nama Lengkap</label>

                            <input type="text"
                                   id="nama"
                                   name="nama"
                                   placeholder="Masukkan nama Anda"
                                   autocomplete="name"
                                   value="{{ old('nama') }}"
                                   required>
                        </div>

                        <div class="rr-field">
                            <label for="email">Email</label>

                            <input type="email"
                                   id="email"
                                   name="email"
                                   placeholder="nama@email.com"
                                   autocomplete="email"
                                   value="{{ old('email') }}"
                                   required>
                        </div>

                    </div>

                    <div class="rr-field">
                        <label for="subjek">Subjek</label>

                        <input type="text"
                               id="subjek"
                               name="subjek"
                               placeholder="Apa yang ingin Anda diskusikan?"
                               value="{{ old('subjek') }}"
                               required>
                    </div>

                    <div class="rr-field">
                        <label for="pesan">Pesan</label>

                        <textarea id="pesan"
                                  name="pesan"
                                  placeholder="Tuliskan pesan Anda di sini..."
                                  required>{{ old('pesan') }}</textarea>
                    </div>

                    <button type="submit" class="rr-btn">
                        Kirim Pesan

                        <svg width="18" height="18" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </button>

                    <p class="rr-note">
                        Pesan Anda akan dikirim dan disimpan
                        melalui sistem RuangRona Studio.
                    </p>

                </form>
            </div>

        </section>

    </main>

    <footer class="rr-footer">
        <div class="rr-container rr-footer__inner">
            <p>© 2026 RuangRona Studio. All rights reserved.</p>
            <p><em>Designed with care.</em></p>
        </div>
    </footer>

    <script>
        const burger = document.getElementById('rrBurger');
        const nav = document.getElementById('rrNav');

        burger.addEventListener('click', () => {
            const open = nav.classList.toggle('is-open');
            burger.setAttribute('aria-expanded', open);
        });
    </script>

</body>
</html>
