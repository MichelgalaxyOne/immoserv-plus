<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ImmoServ+ — Votre plateforme immobilière sûre</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --navy: #0D1F3C;
            --navy2: #1a3560;
            --gold: #B8972A;
            --gold2: #D4AF37;
            --white: #FFFFFF;
            --gray: #F4F6FA;
            --text: #1A1A2E;
            --muted: #6B7280;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; color: var(--text); overflow-x: hidden; }

        /* ══════════ NAVBAR ══════════ */
        #navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 14px 0;
            transition: all 0.4s ease;
            background: transparent;
        }

        #navbar.scrolled {
            background: var(--navy);
            padding: 8px 0;
            box-shadow: 0 4px 30px rgba(13,31,60,0.5);
        }

        .nav-logo img { height: 52px; object-fit: contain; }

        .nav-links a {
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .nav-links a:hover {
            color: var(--gold2);
            background: rgba(255,255,255,0.08);
        }

        .btn-nav-login {
            color: rgba(255,255,255,0.85) !important;
            border: 1px solid rgba(255,255,255,0.3) !important;
            padding: 8px 20px !important;
            border-radius: 25px !important;
        }

        .btn-nav-register {
            background: linear-gradient(135deg, var(--gold), var(--gold2)) !important;
            color: var(--navy) !important;
            font-weight: 700 !important;
            padding: 8px 22px !important;
            border-radius: 25px !important;
            border: none !important;
        }

        .btn-nav-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(184,151,42,0.5);
        }

        /* ══════════ HERO SLIDER ══════════ */
        .hero {
            height: 100vh;
            min-height: 600px;
            position: relative;
            overflow: hidden;
            background: var(--navy);
        }

        .hero-slider {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            background: var(--navy);
        }

        .hero-slide {
            position: absolute;
            inset: 0;
            background-color: var(--navy);
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.4s ease-in-out;
            will-change: opacity;
        }

        .hero-slide.active {
            opacity: 1;
            z-index: 1;
        }

        .hero-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                rgba(13,31,60,0.85) 0%,
                rgba(13,31,60,0.65) 50%,
                rgba(13,31,60,0.55) 100%);
            z-index: 1;
        }

        .slide-1 {
            background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=1600&auto=format');
        }
        .slide-2 {
            background-image: url('https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=1600&auto=format');
        }
        .slide-3 {
            background-image: url('https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=1600&auto=format');
        }

        .hero-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            align-items: center;
            padding-top: 70px;
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(36px, 5vw, 64px);
            font-weight: 700;
            color: white;
            line-height: 1.15;
            margin-bottom: 20px;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .hero-title .gold {
            background: linear-gradient(135deg, var(--gold), var(--gold2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-subtitle {
            font-size: 17px;
            color: rgba(255,255,255,0.75);
            line-height: 1.8;
            max-width: 540px;
            margin-bottom: 36px;
            animation: fadeInUp 0.8s ease 0.4s both;
        }

        .hero-btns {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.6s both;
        }

        .btn-hero-gold {
            background: linear-gradient(135deg, var(--gold), var(--gold2));
            color: var(--navy);
            font-weight: 700;
            font-size: 15px;
            padding: 14px 32px;
            border-radius: 50px;
            border: none;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(184,151,42,0.4);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-hero-gold:hover {
            color: var(--navy);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(184,151,42,0.6);
        }

        .btn-hero-outline {
            background: transparent;
            color: white;
            font-weight: 600;
            font-size: 15px;
            padding: 14px 32px;
            border-radius: 50px;
            border: 2px solid rgba(255,255,255,0.4);
            text-decoration: none;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-hero-outline:hover {
            color: white;
            border-color: var(--gold2);
            background: rgba(184,151,42,0.1);
        }

        /* Stats hero */
        .hero-stats {
            display: flex;
            gap: 32px;
            margin-top: 48px;
            animation: fadeInUp 0.8s ease 0.8s both;
        }

        .hero-stat-item { text-align: left; }

        .hero-stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--gold2);
            line-height: 1;
        }

        .hero-stat-label {
            font-size: 12px;
            color: rgba(255,255,255,0.6);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 4px;
        }

        /* Slider controls */
        .slider-dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .slider-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            cursor: pointer;
            transition: all 0.3s;
        }

        .slider-dot.active {
            background: var(--gold2);
            width: 28px;
            border-radius: 4px;
        }

        /* Hero card flottante */
        .hero-card {
            background: rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(184,151,42,0.25);
            border-radius: 20px;
            padding: 28px;
            animation: fadeInRight 0.8s ease 0.5s both;
        }

        .latest-badge {
            background: rgba(34,197,94,0.2);
            color: #4ade80;
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .trust-badge {
            background: rgba(184,151,42,0.12);
            border: 1px solid rgba(184,151,42,0.25);
            color: var(--gold2);
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 20px;
        }

        /* ══════════ SEARCH BAR ══════════ */
        .search-section {
            background: var(--navy);
            padding: 30px 0;
        }

        .search-bar {
            background: white;
            border-radius: 16px;
            padding: 8px;
            display: flex;
            gap: 8px;
            align-items: center;
            box-shadow: 0 8px 40px rgba(0,0,0,0.2);
        }

        .search-bar input, .search-bar select {
            border: none;
            outline: none;
            font-size: 14px;
            padding: 10px 14px;
            flex: 1;
            color: var(--text);
            background: transparent;
        }

        .search-bar .divider {
            width: 1px;
            height: 30px;
            background: #E5E7EB;
            flex-shrink: 0;
        }

        .btn-search {
            background: linear-gradient(135deg, var(--gold), var(--gold2));
            color: var(--navy);
            font-weight: 700;
            padding: 12px 28px;
            border-radius: 12px;
            border: none;
            font-size: 14px;
            white-space: nowrap;
            transition: all 0.2s;
        }

        .btn-search:hover { transform: translateY(-1px); }

        /* ══════════ SECTIONS COMMUNES ══════════ */
        section { padding: 90px 0; }

        .section-tag {
            display: inline-block;
            background: rgba(184,151,42,0.12);
            color: var(--gold);
            font-size: 12px;
            font-weight: 600;
            padding: 4px 14px;
            border-radius: 20px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 14px;
        }

        .section-sub {
            font-size: 16px;
            color: var(--muted);
            max-width: 580px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .gold-bar {
            width: 50px;
            height: 3px;
            background: linear-gradient(135deg, var(--gold), var(--gold2));
            border-radius: 2px;
            margin: 0 auto 16px;
        }

        /* ══════════ SERVICES ══════════ */
        .services-section { background: var(--gray); }

        .service-card {
            background: white;
            border-radius: 18px;
            padding: 32px 24px;
            text-align: center;
            border: 1px solid transparent;
            transition: all 0.3s;
            height: 100%;
            box-shadow: 0 2px 15px rgba(13,31,60,0.06);
            text-decoration: none;
            display: block;
            color: inherit;
        }

        .service-card:hover {
            transform: translateY(-8px);
            border-color: var(--gold);
            box-shadow: 0 16px 50px rgba(13,31,60,0.15);
            color: inherit;
        }

        .service-icon {
            width: 68px;
            height: 68px;
            background: linear-gradient(135deg, var(--navy), var(--navy2));
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 30px;
            transition: all 0.3s;
        }

        .service-card:hover .service-icon {
            background: linear-gradient(135deg, var(--gold), var(--gold2));
        }

        .service-count {
            display: inline-block;
            background: var(--gray);
            color: var(--muted);
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 20px;
            margin-top: 8px;
        }

        /* ══════════ COMMENT CA MARCHE ══════════ */
        .how-section { background: white; }

        .step-wrapper {
            position: relative;
            text-align: center;
            padding: 20px;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--gold), var(--gold2));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--navy);
            margin: 0 auto 20px;
            box-shadow: 0 4px 20px rgba(184,151,42,0.3);
        }

        .step-icon-wrap {
            width: 52px;
            height: 52px;
            background: var(--gray);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 24px;
            color: var(--navy);
        }

        .step-connector {
            position: absolute;
            top: 50px;
            right: -30%;
            width: 60%;
            height: 2px;
            background: linear-gradient(to right, var(--gold), transparent);
        }

        /* ══════════ ANNONCES ══════════ */
        .annonces-section { background: var(--gray); }

        .annonce-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 2px 15px rgba(13,31,60,0.08);
            transition: all 0.3s;
            height: 100%;
        }

        .annonce-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 50px rgba(13,31,60,0.15);
        }

        .annonce-img {
            width: 100%;
            height: 210px;
            object-fit: cover;
        }

        .annonce-img-placeholder {
            height: 210px;
            background: linear-gradient(135deg, var(--navy), var(--navy2));
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cat-badge {
            background: var(--navy);
            color: white;
            font-size: 11px;
            font-weight: 500;
            padding: 4px 12px;
            border-radius: 20px;
        }

        .price-text {
            font-size: 20px;
            font-weight: 700;
            background: linear-gradient(135deg, var(--gold), var(--gold2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-see-detail {
            display: block;
            text-align: center;
            background: var(--navy);
            color: white;
            padding: 11px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
            margin-top: 14px;
        }

        .btn-see-detail:hover {
            background: var(--navy2);
            color: white;
        }

        /* ══════════ A PROPOS ══════════ */
        .about-section {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
            padding: 90px 0;
        }

        .about-feature {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 22px;
        }

        .about-icon {
            width: 46px;
            height: 46px;
            background: rgba(184,151,42,0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: var(--gold2);
            flex-shrink: 0;
        }

        .about-stat-box {
            background: rgba(184,151,42,0.1);
            border: 1px solid rgba(184,151,42,0.2);
            border-radius: 14px;
            padding: 20px;
            text-align: center;
        }

        /* ══════════ TEMOIGNAGES ══════════ */
        .temoignages-section { background: white; }

        .temoignage-card {
            background: var(--gray);
            border-radius: 18px;
            padding: 28px;
            position: relative;
            border: 1px solid transparent;
            transition: all 0.3s;
            height: 100%;
        }

        .temoignage-card:hover {
            border-color: var(--gold);
            transform: translateY(-4px);
        }

        .quote-icon {
            font-size: 48px;
            color: var(--gold);
            line-height: 1;
            margin-bottom: 12px;
            font-family: Georgia, serif;
        }

        .stars { color: var(--gold2); font-size: 16px; }

        .avatar-circle {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--navy), var(--navy2));
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold2);
            font-weight: 700;
            font-size: 16px;
            flex-shrink: 0;
        }

        /* ══════════ CONTACT ══════════ */
        .contact-section { background: var(--gray); }

        .contact-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 4px 30px rgba(13,31,60,0.08);
        }

        .form-input {
            border: 1.5px solid #E5E7EB;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 14px;
            width: 100%;
            transition: border-color 0.2s;
            outline: none;
        }

        .form-input:focus { border-color: var(--gold); }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 20px;
        }

        .contact-info-icon {
            width: 44px;
            height: 44px;
            background: var(--navy);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* ══════════ CTA SECTION ══════════ */
        .cta-section {
            background: linear-gradient(135deg, var(--navy), var(--navy2));
            padding: 80px 0;
            text-align: center;
        }

        /* ══════════ FOOTER ══════════ */
        footer {
            background: #060F1E;
            padding: 60px 0 0;
        }

        .footer-desc {
            color: rgba(255,255,255,0.5);
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .footer-title {
            color: var(--gold2);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .footer-link {
            display: block;
            color: rgba(255,255,255,0.5);
            font-size: 13px;
            text-decoration: none;
            margin-bottom: 10px;
            transition: color 0.2s;
        }

        .footer-link:hover { color: var(--gold2); }

        .social-btn {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .social-btn:hover {
            background: var(--gold);
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding: 20px 0;
            margin-top: 40px;
        }

        /* ══════════ ANIMATIONS ══════════ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Scroll animations */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ══════════ RESPONSIVE ══════════ */
        @media (max-width: 768px) {
            #navbar {
                padding: 8px 0;
            }

            #navbar img {
                height: 42px;
            }

            .hero {
                height: auto;
                min-height: auto;
            }

            .hero-content {
                height: auto;
                align-items: flex-start;
                padding-top: 90px;
                padding-bottom: 30px;
            }

            .hero-title {
                font-size: 30px;
                line-height: 1.25;
                margin-bottom: 14px;
            }

            .hero-subtitle {
                font-size: 14px;
                margin-bottom: 20px;
            }

            .hero-btns {
                flex-direction: column;
                width: 100%;
                gap: 10px;
            }

            .hero-btns a {
                width: 100%;
                justify-content: center;
                text-align: center;
                padding: 12px 24px;
            }

            .hero-stats {
                flex-wrap: wrap;
                gap: 14px !important;
                margin-top: 28px;
            }

            .hero-stat-item {
                flex: 1 1 40%;
                min-width: 70px;
            }

            .hero-stat-num {
                font-size: 20px;
            }

            .hero-stat-label {
                font-size: 10px;
            }

            .slider-dots {
                bottom: 14px;
            }

            .search-bar { flex-direction: column; border-radius: 12px; }
            .search-bar .divider { display: none; }
            .btn-search { width: 100%; }
            .step-connector { display: none; }
            section { padding: 50px 0; }
        }
    </style>
</head>
<body>

{{-- ══════════ NAVBAR ══════════ --}}
<nav id="navbar">
    <div class="container d-flex justify-content-between align-items-center" style="height:70px">

        {{-- Logo --}}
        <a href="#hero" style="text-decoration:none;flex-shrink:0">
            <img src="{{ asset('images/logo.png') }}"
                alt="ImmoServ+"
                style="height:55px;width:auto;object-fit:contain">
        </a>

        {{-- Liens navigation --}}
        <div class="d-none d-lg-flex align-items-center gap-1">
            <a href="#services" style="color:rgba(255,255,255,0.85);text-decoration:none;font-size:14px;font-weight:500;padding:8px 14px;border-radius:8px;transition:all 0.2s">Services</a>
            <a href="#comment" style="color:rgba(255,255,255,0.85);text-decoration:none;font-size:14px;font-weight:500;padding:8px 14px;border-radius:8px">Comment ça marche</a>
            <a href="#annonces" style="color:rgba(255,255,255,0.85);text-decoration:none;font-size:14px;font-weight:500;padding:8px 14px;border-radius:8px">Annonces</a>
            <a href="#apropos" style="color:rgba(255,255,255,0.85);text-decoration:none;font-size:14px;font-weight:500;padding:8px 14px;border-radius:8px">À propos</a>
            <a href="#contact" style="color:rgba(255,255,255,0.85);text-decoration:none;font-size:14px;font-weight:500;padding:8px 14px;border-radius:8px">Contact</a>
        </div>

        {{-- Boutons --}}
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('login') }}"
                style="color:rgba(255,255,255,0.85);font-size:14px;font-weight:500;
                text-decoration:none;padding:8px 20px;border-radius:25px;
                border:1px solid rgba(255,255,255,0.3);white-space:nowrap">
                Connexion
            </a>
            <a href="{{ route('register') }}"
                style="background:linear-gradient(135deg,#B8972A,#D4AF37);
                color:#0D1F3C;font-weight:700;font-size:14px;padding:8px 22px;
                border-radius:25px;text-decoration:none;white-space:nowrap">
                S'inscrire
            </a>
        </div>
    </div>
</nav>

{{-- ══════════ HERO SLIDER ══════════ --}}
<section class="hero" id="hero">
    <div class="hero-slider">
        <div class="hero-slide slide-1 active"></div>
        <div class="hero-slide slide-2"></div>
        <div class="hero-slide slide-3"></div>
    </div>

    <div class="hero-content container">
        <div class="row align-items-center w-100">

            {{-- Texte gauche --}}
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="hero-title">
                    Trouvez votre<br>
                    bien immobilier<br>
                    <span class="gold">idéal au Bénin</span>
                </h1>
                <p class="hero-subtitle">
                    ImmoServ+ connecte clients et prestataires immobiliers.
                    Location, vente : trouvez le bien qu'il vous faut
                    en quelques clics, en toute sécurité.
                </p>
                <div class="hero-btns">
                    <a href="{{ route('register') }}" class="btn-hero-gold">
                        <i class="bi bi-rocket-takeoff"></i>
                        Commencer gratuitement
                    </a>
                    <a href="#annonces" class="btn-hero-outline">
                        <i class="bi bi-search"></i>
                        Voir les annonces
                    </a>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat-item">
                        <div class="hero-stat-num">{{ $stats['annonces'] }}+</div>
                        <div class="hero-stat-label">Annonces</div>
                    </div>
                    <div style="width:1px;background:rgba(255,255,255,0.15);margin:0 8px"></div>
                    <div class="hero-stat-item">
                        <div class="hero-stat-num">{{ $stats['prestataires'] }}+</div>
                        <div class="hero-stat-label">Experts</div>
                    </div>
                    <div style="width:1px;background:rgba(255,255,255,0.15);margin:0 8px"></div>
                    <div class="hero-stat-item">
                        <div class="hero-stat-num">{{ $stats['clients'] }}+</div>
                        <div class="hero-stat-label">Clients</div>
                    </div>
                    <div style="width:1px;background:rgba(255,255,255,0.15);margin:0 8px"></div>
                    <div class="hero-stat-item">
                        <div class="hero-stat-num">{{ $stats['demandes'] }}+</div>
                        <div class="hero-stat-label">Missions</div>
                    </div>
                </div>
            </div>

            {{-- Card flottante droite --}}
            <div class="col-lg-6 d-none d-lg-block">
                <div class="hero-card">
                    {{-- Dernière annonce --}}
                    @if($dernieres_annonces->count() > 0)
                        @php $a = $dernieres_annonces->first(); $img = $a->images->first(); @endphp
                        <div style="margin-bottom:20px">
                            <div style="font-size:11px;color:rgba(255,255,255,0.5);margin-bottom:10px;text-transform:uppercase;letter-spacing:1px">
                                Dernière annonce publiée
                            </div>
                            <div style="display:flex;align-items:center;gap:14px;background:rgba(255,255,255,0.06);border-radius:12px;padding:14px">
                                @if($img)
                                    <img src="{{ asset('storage/'.$img->image) }}"
                                        style="width:64px;height:64px;border-radius:10px;object-fit:cover;flex-shrink:0">
                                @else
                                    <div style="width:64px;height:64px;border-radius:10px;background:rgba(184,151,42,0.2);display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                        <i class="bi bi-building" style="color:var(--gold2);font-size:26px"></i>
                                    </div>
                                @endif
                                <div style="flex:1;min-width:0">
                                    <div style="color:white;font-weight:600;font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                        {{ Str::limit($a->titre, 30) }}
                                    </div>
                                    <div style="color:rgba(255,255,255,0.5);font-size:12px;margin:3px 0">
                                        <i class="bi bi-geo-alt-fill" style="color:var(--gold2)"></i>
                                        {{ $a->localisation }}
                                    </div>
                                    @if($a->prix)
                                        <div style="color:var(--gold2);font-weight:700;font-size:13px">
                                            {{ number_format($a->prix, 0, ',', ' ') }} FCFA
                                        </div>
                                    @endif
                                </div>
                                <span class="latest-badge">Nouveau</span>
                            </div>
                        </div>
                    @endif

                    {{-- Mini stats --}}
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:20px">
                        @foreach([
                            ['bi-building', $stats['annonces'], 'Annonces actives'],
                            ['bi-people-fill', $stats['clients'], 'Clients inscrits'],
                            ['bi-person-badge', $stats['prestataires'], 'Prestataires'],
                            ['bi-check-circle', $stats['demandes'], 'Missions réussies'],
                        ] as [$icon, $val, $label])
                            <div style="background:rgba(255,255,255,0.06);border-radius:10px;padding:12px;text-align:center">
                                <i class="bi {{ $icon }}" style="color:var(--gold2);font-size:20px"></i>
                                <div style="color:white;font-weight:700;font-size:18px;margin-top:4px">{{ $val }}+</div>
                                <div style="color:rgba(255,255,255,0.5);font-size:11px">{{ $label }}</div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Badges confiance --}}
                    <div style="display:flex;gap:8px;flex-wrap:wrap">
                        @foreach(['✓ 100% Gratuit', '✓ Sécurisé', '✓ Vérifié', '✓ Responsive'] as $b)
                            <span class="trust-badge">{{ $b }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Slider dots --}}
    <div class="slider-dots">
        <div class="slider-dot active" onclick="goToSlide(0)"></div>
        <div class="slider-dot" onclick="goToSlide(1)"></div>
        <div class="slider-dot" onclick="goToSlide(2)"></div>
    </div>
</section>

{{-- ══════════ SEARCH BAR ══════════ --}}
<div class="search-section">
    <div class="container">
        <div class="search-bar">
            <i class="bi bi-search" style="color:var(--muted);font-size:18px;padding:0 8px;flex-shrink:0"></i>
            <input type="text" placeholder="Rechercher un bien, une ville..." id="searchInput">
            <div class="divider"></div>
            <select id="catSelect" style="min-width:160px">
                <option value="">Toutes catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                @endforeach
            </select>
            <div class="divider"></div>
            <input type="number" placeholder="Prix max (FCFA)" id="prixInput" style="max-width:160px">
            <button class="btn-search" onclick="doSearch()">
                <i class="bi bi-search me-1"></i> Rechercher
            </button>
        </div>
    </div>
</div>

{{-- ══════════ NOS SERVICES ══════════ --}}
<section id="services" class="services-section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <div class="gold-bar"></div>
            <span class="section-tag">Nos Services</span>
            <h2 class="section-title">Ce que nous proposons</h2>
            <p class="section-sub">Découvrez l'ensemble des services immobiliers proposés par nos prestataires certifiés au Bénin</p>
        </div>

        <div class="row g-4">
            @php $icons = ['🏠','🔑','📋','📊','🏗️','🔨','🚚','🏢']; @endphp
            @foreach($categories as $index => $cat)
                <div class="col-6 col-md-3 reveal">
                    <a href="{{ route('services.index', ['categorie' => $cat->id]) }}" class="service-card">
                        <div class="service-icon">{{ $icons[$index] ?? '🏠' }}</div>
                        <h6 style="font-family:'Playfair Display',serif;color:var(--navy);font-size:15px;margin-bottom:6px">
                            {{ $cat->nom }}
                        </h6>
                        <span class="service-count">{{ $cat->services_count }} annonce(s)</span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════ COMMENT CA MARCHE ══════════ --}}
<section id="comment" class="how-section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <div class="gold-bar"></div>
            <span class="section-tag">Processus</span>
            <h2 class="section-title">Comment ça marche ?</h2>
            <p class="section-sub">En 4 étapes simples, trouvez le bien immobilier idéal pour votre projet</p>
        </div>

        <div class="row g-4">
            @php
                $steps = [
                    ['1','bi-person-plus','Créez votre compte','Inscrivez-vous gratuitement en tant que client ou prestataire en quelques secondes.'],
                    ['2','bi-search','Recherchez','Parcourez les annonces et filtrez par catégorie, localisation ou budget.'],
                    ['3','bi-envelope-check','Contactez','Envoyez une demande et discutez via le chat intégré en temps réel.'],
                    ['4','bi-star-fill','Évaluez','Après votre expérience, laissez un avis pour aider la communauté.'],
                ];
            @endphp

            @foreach($steps as $i => $step)
                <div class="col-md-3 reveal">
                    <div class="step-wrapper" style="position:relative">
                        <div class="step-number">{{ $step[0] }}</div>
                        <div class="step-icon-wrap">
                            <i class="bi {{ $step[1] }}"></i>
                        </div>
                        <h5 style="font-family:'Playfair Display',serif;color:var(--navy);font-size:17px;margin-bottom:10px">
                            {{ $step[2] }}
                        </h5>
                        <p style="color:var(--muted);font-size:13px;line-height:1.7;margin:0">{{ $step[3] }}</p>
                        @if($i < 3)
                            <div class="step-connector d-none d-md-block"></div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5 reveal">
            <a href="{{ route('register') }}" class="btn-hero-gold" style="display:inline-flex">
                <i class="bi bi-rocket-takeoff"></i> Rejoindre ImmoServ+
            </a>
        </div>
    </div>
</section>

{{-- ══════════ DERNIÈRES ANNONCES ══════════ --}}
<section id="annonces" class="annonces-section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <div class="gold-bar"></div>
            <span class="section-tag">Annonces récentes</span>
            <h2 class="section-title">Dernières Annonces</h2>
            <p class="section-sub">Découvrez les dernières offres publiées par nos prestataires vérifiés</p>
        </div>

        <div class="row g-4">
            @forelse($dernieres_annonces as $service)
                @php $img = $service->images->where('principale',true)->first() ?? $service->images->first(); @endphp
                <div class="col-md-4 reveal">
                    <div class="annonce-card">
                        @if($img)
                            <img src="{{ asset('storage/'.$img->image) }}" class="annonce-img" alt="{{ $service->titre }}">
                        @else
                            <div class="annonce-img-placeholder">
                                <i class="bi bi-building" style="font-size:3rem;color:var(--gold2)"></i>
                            </div>
                        @endif
                        <div style="padding:20px">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px">
                                <span class="cat-badge">{{ $service->categorie->nom }}</span>
                                @if($service->images->count() > 1)
                                    <span style="color:var(--muted);font-size:12px">
                                        <i class="bi bi-images me-1"></i>{{ $service->images->count() }} photos
                                    </span>
                                @endif
                            </div>
                            <h5 style="font-family:'Playfair Display',serif;color:var(--navy);font-size:16px;margin-bottom:8px">
                                {{ Str::limit($service->titre, 45) }}
                            </h5>
                            <p style="color:var(--muted);font-size:13px;margin-bottom:10px">
                                <i class="bi bi-geo-alt-fill me-1" style="color:var(--gold)"></i>
                                {{ $service->localisation }}
                            </p>
                            @if($service->prix)
                                <div class="price-text">{{ number_format($service->prix, 0, ',', ' ') }} <span style="font-size:13px;-webkit-text-fill-color:var(--muted);font-weight:400">FCFA</span></div>
                            @endif
                            <a href="{{ route('login') }}" class="btn-see-detail">
                                <i class="bi bi-eye me-1"></i> Voir le détail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p style="color:var(--muted)">Aucune annonce disponible pour le moment.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5 reveal">
            <a href="{{ route('login') }}"
                style="display:inline-block;background:white;color:var(--navy);border:2px solid var(--navy);font-weight:600;font-size:15px;padding:13px 36px;border-radius:50px;text-decoration:none;transition:all 0.3s"
                onmouseover="this.style.background='var(--navy)';this.style.color='white'"
                onmouseout="this.style.background='white';this.style.color='var(--navy)'">
                Voir toutes les annonces →
            </a>
        </div>
    </div>
</section>

{{-- ══════════ À PROPOS ══════════ --}}
<section id="apropos" class="about-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 reveal">
                <div class="gold-bar" style="margin:0 0 14px"></div>
                <span class="section-tag" style="margin-bottom:14px;display:inline-block">À propos</span>
                <h2 style="font-family:'Playfair Display',serif;font-size:clamp(28px,4vw,40px);font-weight:700;color:white;margin-bottom:20px">
                    À propos d'ImmoServ+
                </h2>
                <p style="color:rgba(255,255,255,0.65);font-size:15px;line-height:1.8;margin-bottom:30px">
                    ImmoServ+ est une plateforme numérique béninoise conçue pour simplifier
                    l'accès aux services immobiliers. Notre mission est de connecter de manière
                    transparente et sécurisée les particuliers avec des prestataires qualifiés
                    dans tout le Bénin.
                </p>

                @foreach([
                    ['shield-check-fill','Plateforme sécurisée','Toutes les transactions et échanges sont protégés par des mécanismes de sécurité avancés.'],
                    ['people-fill','Prestataires vérifiés','Chaque prestataire est validé avant de pouvoir publier des annonces.'],
                    ['chat-dots-fill','Communication directe','Messagerie temps réel intégrée entre clients et prestataires.'],
                    ['star-fill','Avis authentiques','Notations basées uniquement sur des missions réellement effectuées.'],
                ] as [$icon, $title, $desc])
                    <div class="about-feature">
                        <div class="about-icon"><i class="bi bi-{{ $icon }}"></i></div>
                        <div>
                            <h6 style="color:white;font-weight:600;margin-bottom:4px">{{ $title }}</h6>
                            <p style="color:rgba(255,255,255,0.55);font-size:13px;margin:0;line-height:1.6">{{ $desc }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-lg-6 reveal">
                <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(184,151,42,0.2);border-radius:22px;padding:36px;text-align:center">
                    <img src="{{ asset('images/logo.png') }}" alt="ImmoServ+" style="height:90px;object-fit:contain;margin-bottom:22px">
                    <h4 style="font-family:'Playfair Display',serif;color:white;margin-bottom:12px">
                        Votre plateforme immobilière sûre
                    </h4>
                    <p style="color:rgba(255,255,255,0.55);font-size:14px;line-height:1.7;margin-bottom:28px">
                        Développée au Bénin, pour le Bénin. ImmoServ+ s'adapte aux réalités
                        du marché immobilier local avec des fonctionnalités pensées pour vous.
                    </p>
                    <div class="row g-3">
                        @foreach([[$stats['annonces'],'Annonces'],[$stats['prestataires'],'Prestataires'],[$stats['demandes'],'Missions']] as [$v,$l])
                            <div class="col-4">
                                <div class="about-stat-box">
                                    <div style="font-family:'Playfair Display',serif;font-size:28px;font-weight:700;color:var(--gold2)">{{ $v }}+</div>
                                    <div style="color:rgba(255,255,255,0.55);font-size:11px">{{ $l }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════ TÉMOIGNAGES ══════════ --}}
<section class="temoignages-section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <div class="gold-bar"></div>
            <span class="section-tag">Témoignages</span>
            <h2 class="section-title">Ce que disent nos utilisateurs</h2>
            <p class="section-sub">Des milliers d'utilisateurs nous font confiance pour leurs projets immobiliers</p>
        </div>

        <div class="row g-4">
            @php
                $temoignages = [
                    ['P','Paul A.','Client','J\'ai trouvé mon appartement à Cotonou en moins de 3 jours grâce à ImmoServ+. La plateforme est simple, rapide et les prestataires sont sérieux.',5],
                    ['I','Ines D.','Cliente','En tant qu\'étudiante nouvellement arrivée à Cotonou, ImmoServ+ m\'a évité des semaines de recherches épuisantes. Je recommande vivement !',5],
                    ['J','Jean K.','Prestataire','Depuis que j\'utilise ImmoServ+ pour publier mes annonces, j\'ai multiplié mes contacts par 3. L\'interface est professionnelle et intuitive.',4],
                ];
            @endphp

            @foreach($temoignages as $t)
                <div class="col-md-4 reveal">
                    <div class="temoignage-card">
                        <div class="quote-icon">"</div>
                        <div class="stars mb-3">
                            @for($i=1;$i<=5;$i++)
                                {{ $i <= $t[4] ? '★' : '☆' }}
                            @endfor
                        </div>
                        <p style="color:#4B5563;font-size:14px;line-height:1.7;margin-bottom:20px;font-style:italic">
                            "{{ $t[3] }}"
                        </p>
                        <div style="display:flex;align-items:center;gap:12px">
                            <div class="avatar-circle">{{ $t[0] }}</div>
                            <div>
                                <div style="font-weight:600;color:var(--navy);font-size:14px">{{ $t[1] }}</div>
                                <div style="color:var(--muted);font-size:12px">{{ $t[2] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════ CTA ══════════ --}}
<section class="cta-section">
    <div class="container reveal">
        <div class="gold-bar"></div>
        <h2 style="font-family:'Playfair Display',serif;font-size:clamp(28px,4vw,42px);font-weight:700;color:white;margin-bottom:16px">
            Prêt à trouver votre bien idéal ?
        </h2>
        <p style="color:rgba(255,255,255,0.65);font-size:16px;max-width:500px;margin:0 auto 36px;line-height:1.7">
            Rejoignez des milliers d'utilisateurs qui font confiance à ImmoServ+ pour leurs projets immobiliers au Bénin.
        </p>
        <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('register') }}" class="btn-hero-gold" style="display:inline-flex">
                <i class="bi bi-person-plus"></i> Créer mon compte gratuit
            </a>
            <a href="#contact" class="btn-hero-outline" style="display:inline-flex">
                <i class="bi bi-envelope"></i> Nous contacter
            </a>
        </div>
    </div>
</section>

{{-- ══════════ CONTACT ══════════ --}}
<section id="contact" class="contact-section">
    <div class="container">
        <div class="text-center mb-5 reveal">
            <div class="gold-bar"></div>
            <span class="section-tag">Contact</span>
            <h2 class="section-title">Contactez-nous</h2>
            <p class="section-sub">Une question ? Notre équipe est à votre écoute</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-5 reveal">
                <div class="contact-card">
                    <h5 style="font-family:'Playfair Display',serif;color:var(--navy);margin-bottom:24px">
                        Envoyez-nous un message
                    </h5>
                    <div style="margin-bottom:16px">
                        <label style="font-size:13px;font-weight:600;color:var(--navy);margin-bottom:6px;display:block">Nom complet</label>
                        <input type="text" class="form-input" placeholder="Votre nom complet">
                    </div>
                    <div style="margin-bottom:16px">
                        <label style="font-size:13px;font-weight:600;color:var(--navy);margin-bottom:6px;display:block">Email</label>
                        <input type="email" class="form-input" placeholder="votre@email.com">
                    </div>
                    <div style="margin-bottom:24px">
                        <label style="font-size:13px;font-weight:600;color:var(--navy);margin-bottom:6px;display:block">Message</label>
                        <textarea class="form-input" rows="4" placeholder="Décrivez votre demande..."></textarea>
                    </div>
                    <button class="btn-hero-gold w-100" style="border-radius:12px;justify-content:center">
                        <i class="bi bi-send"></i> Envoyer le message
                    </button>
                </div>
            </div>

            <div class="col-lg-4 reveal">
                <div style="padding:10px">
                    <h5 style="font-family:'Playfair Display',serif;color:var(--navy);margin-bottom:24px">
                        Nos coordonnées
                    </h5>
                    @foreach([
                        ['geo-alt-fill','Adresse','Cotonou, République du Bénin'],
                        ['envelope-fill','Email','contact@immoserv.bj'],
                        ['telephone-fill','Téléphone','+229 01 52 68 94 13'],
                        ['clock-fill','Horaires','Lun - Sam : 8h - 18h'],
                    ] as [$icon,$label,$value])
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-{{ $icon }}" style="color:var(--gold2);font-size:18px"></i>
                            </div>
                            <div>
                                <div style="font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:3px">{{ $label }}</div>
                                <div style="font-weight:600;color:var(--navy);font-size:14px">{{ $value }}</div>
                            </div>
                        </div>
                    @endforeach

                    <div style="background:var(--navy);border-radius:16px;padding:24px;margin-top:8px">
                        <h6 style="color:white;margin-bottom:14px;font-weight:600">Rejoignez ImmoServ+</h6>
                        <a href="{{ route('register') }}" class="btn-hero-gold d-block text-center" style="border-radius:10px;justify-content:center">
                            <i class="bi bi-person-plus me-1"></i> Créer mon compte
                        </a>
                        <a href="{{ route('login') }}" style="display:block;text-align:center;margin-top:10px;color:rgba(255,255,255,0.55);font-size:13px;text-decoration:none">
                            Déjà inscrit ? Se connecter →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════ FOOTER ══════════ --}}
<footer>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <img src="{{ asset('images/logo.png') }}" alt="ImmoServ+" style="height:65px;object-fit:contain;margin-bottom:16px">
                <p class="footer-desc">
                    ImmoServ+ est votre plateforme de confiance pour la location et la vente immobilière au Bénin.
                </p>
                <div style="display:flex;gap:10px">
                    @foreach(['facebook','instagram','linkedin','whatsapp'] as $rs)
                        <a href="#" class="social-btn"><i class="bi bi-{{ $rs }}"></i></a>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="footer-title">Navigation</div>
                <a href="#services" class="footer-link">Nos services</a>
                <a href="#comment" class="footer-link">Comment ça marche</a>
                <a href="#annonces" class="footer-link">Annonces</a>
                <a href="#apropos" class="footer-link">À propos</a>
                <a href="{{ route('login') }}" class="footer-link">Connexion</a>
                <a href="{{ route('register') }}" class="footer-link">S'inscrire</a>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-title">Services</div>
                @foreach($categories->take(5) as $cat)
                    <a href="{{ route('services.index', ['categorie' => $cat->id]) }}" class="footer-link">
                        {{ $cat->nom }}
                    </a>
                @endforeach
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-title">Contact</div>
                @foreach([
                    ['geo-alt-fill','Cotonou, Bénin'],
                    ['envelope-fill','contact@immoserv.bj'],
                    ['telephone-fill','+229 01 52 68 94 13'],
                ] as [$icon,$val])
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px">
                        <i class="bi bi-{{ $icon }}" style="color:var(--gold2);font-size:14px;flex-shrink:0"></i>
                        <span style="color:rgba(255,255,255,0.5);font-size:13px">{{ $val }}</span>
                    </div>
                @endforeach

                <div style="background:rgba(184,151,42,0.1);border:1px solid rgba(184,151,42,0.25);border-radius:10px;padding:12px;margin-top:8px;display:flex;align-items:center;gap:10px">
                    <i class="bi bi-shield-check-fill" style="color:var(--gold2);font-size:22px"></i>
                    <div>
                        <div style="color:white;font-size:12px;font-weight:600">Plateforme sécurisée</div>
                        <div style="color:rgba(255,255,255,0.4);font-size:11px">Transactions protégées</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span style="color:rgba(255,255,255,0.4);font-size:12px">
                © {{ date('Y') }} <span style="color:var(--gold2);font-weight:600">ImmoServ+</span> — Tous droits réservés.
            </span>
            <span style="color:rgba(255,255,255,0.3);font-size:12px">
                Développé avec <span style="color:var(--gold2)">♥</span> au Bénin
            </span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // ══ NAVBAR SCROLL ══
    window.addEventListener('scroll', () => {
        document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 60);
    });

    // ══ HERO SLIDER ══
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    let current = 0;
    let autoSlide;

    function goToSlide(n) {
        slides[current].classList.remove('active');
        dots[current].classList.remove('active');
        current = n;
        slides[current].classList.add('active');
        dots[current].classList.add('active');
    }

    function nextSlide() {
        goToSlide((current + 1) % slides.length);
    }

    autoSlide = setInterval(nextSlide, 5000);

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            clearInterval(autoSlide);
            goToSlide(i);
            autoSlide = setInterval(nextSlide, 5000);
        });
    });

    // ══ SMOOTH SCROLL ══
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // ══ SCROLL ANIMATIONS ══
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.classList.add('visible');
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    reveals.forEach(r => observer.observe(r));

    // ══ SEARCH ══
    function doSearch() {
        const search = document.getElementById('searchInput').value;
        const cat = document.getElementById('catSelect').value;
        const prix = document.getElementById('prixInput').value;
        let url = '{{ route("services.index") }}?';
        if (search) url += `search=${encodeURIComponent(search)}&`;
        if (cat) url += `categorie=${cat}&`;
        if (prix) url += `prix_max=${prix}`;
        window.location.href = url;
    }

    document.getElementById('searchInput').addEventListener('keypress', e => {
        if (e.key === 'Enter') doSearch();
    });
</script>

</body>
</html>