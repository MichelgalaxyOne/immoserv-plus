<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ImmoServ+ — Créer un compte</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --navy: #0D1F3C;
            --navy2: #1a3560;
            --gold: #B8972A;
            --gold2: #D4AF37;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 600px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.4);
        }

        /* ── Panneau gauche ── */
        .left-panel {
            background: linear-gradient(160deg, #0a1628 0%, var(--navy2) 100%);
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(184,151,42,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -60px;
            left: -60px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(184,151,42,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .left-logo img {
            height: 90px;
            object-fit: contain;
        }

        .left-content { position: relative; z-index: 1; }

        .left-title {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 16px;
            line-height: 1.3;
        }

        .left-title span {
            background: linear-gradient(135deg, var(--gold), var(--gold2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .left-desc {
            color: rgba(255,255,255,0.6);
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 32px;
        }

        .left-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .left-feature-icon {
            width: 36px;
            height: 36px;
            background: rgba(184,151,42,0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold2);
            font-size: 16px;
            flex-shrink: 0;
        }

        .left-feature-text {
            color: rgba(255,255,255,0.75);
            font-size: 13px;
        }

        .left-bottom {
            color: rgba(255,255,255,0.3);
            font-size: 12px;
            position: relative;
            z-index: 1;
        }

        /* ── Panneau droit ── */
        .right-panel {
            background: white;
            flex: 1.1;
            padding: 50px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-header { margin-bottom: 32px; }

        .form-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 6px;
        }

        .form-header p {
            color: #6B7280;
            font-size: 14px;
        }

        .gold-bar {
            width: 40px;
            height: 3px;
            background: linear-gradient(135deg, var(--gold), var(--gold2));
            border-radius: 2px;
            margin-bottom: 16px;
        }

        .form-label-custom {
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 6px;
            display: block;
        }

        .form-input-custom {
            width: 100%;
            border: 1.5px solid #E5E7EB;
            border-radius: 10px;
            padding: 11px 14px 11px 40px;
            font-size: 14px;
            color: #1A1A2E;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #FAFAFA;
        }

        .form-input-custom:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(184,151,42,0.12);
            background: white;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 16px;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            font-size: 15px;
        }

        .role-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }

        .role-option {
            border: 2px solid #E5E7EB;
            border-radius: 12px;
            padding: 14px 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #FAFAFA;
        }

        .role-option:hover {
            border-color: var(--gold);
            background: rgba(184,151,42,0.05);
        }

        .role-option.selected {
            border-color: var(--gold);
            background: rgba(184,151,42,0.08);
        }

        .role-option input { display: none; }

        .role-icon {
            font-size: 24px;
            margin-bottom: 6px;
            display: block;
        }

        .role-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--navy);
            display: block;
        }

        .role-desc {
            font-size: 11px;
            color: #6B7280;
            display: block;
            margin-top: 2px;
        }

        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, var(--gold), var(--gold2));
            color: var(--navy);
            font-weight: 700;
            font-size: 15px;
            padding: 13px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(184,151,42,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-register:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(184,151,42,0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #6B7280;
        }

        .login-link a {
            color: var(--navy);
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover { color: var(--gold); }

        .error-msg {
            color: #EF4444;
            font-size: 12px;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .select-custom {
            width: 100%;
            border: 1.5px solid #E5E7EB;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 14px;
            color: #1A1A2E;
            outline: none;
            background: #FAFAFA;
            transition: border-color 0.2s;
            display: none;
        }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { padding: 36px 24px; }
            .register-wrapper { max-width: 440px; border-radius: 20px; }
        }
    </style>
</head>
<body>

<div class="register-wrapper">

    {{-- ── PANNEAU GAUCHE ── --}}
    <div class="left-panel">
        <div class="left-logo">
            <img src="{{ asset('images/logo.png') }}" alt="ImmoServ+">
        </div>

        <div class="left-content">
            <h2 class="left-title">
                Rejoignez<br>
                <span>ImmoServ+</span><br>
                dès aujourd'hui
            </h2>
            <p class="left-desc">
                La plateforme numérique béninoise qui connecte clients et prestataires immobiliers en toute sécurité.
            </p>

            @foreach([
                ['shield-check-fill', 'Plateforme 100% sécurisée'],
                ['geo-alt-fill', 'Annonces géolocalisées'],
                ['chat-dots-fill', 'Messagerie temps réel'],
                ['star-fill', 'Système d\'avis certifiés'],
            ] as [$icon, $text])
                <div class="left-feature">
                    <div class="left-feature-icon">
                        <i class="bi bi-{{ $icon }}"></i>
                    </div>
                    <span class="left-feature-text">{{ $text }}</span>
                </div>
            @endforeach
        </div>

        <div class="left-bottom">
            © {{ date('Y') }} ImmoServ+ — Tous droits réservés
        </div>
    </div>

    {{-- ── PANNEAU DROIT ── --}}
    <div class="right-panel">
        <div class="form-header">
            <div class="gold-bar"></div>
            <h2>Créer un compte</h2>
            <p>Remplissez le formulaire pour rejoindre ImmoServ+</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nom --}}
            <div>
                <label class="form-label-custom">
                    <i class="bi bi-person me-1" style="color:var(--gold)"></i>Nom complet
                </label>
                <div class="input-wrapper">
                    <i class="bi bi-person input-icon"></i>
                    <input type="text" name="name" id="name"
                        class="form-input-custom"
                        value="{{ old('name') }}"
                        placeholder="Votre nom complet"
                        required autofocus>
                </div>
                @error('name')
                    <div class="error-msg">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="form-label-custom">
                    <i class="bi bi-envelope me-1" style="color:var(--gold)"></i>Adresse email
                </label>
                <div class="input-wrapper">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" name="email" id="email"
                        class="form-input-custom"
                        value="{{ old('email') }}"
                        placeholder="votre@email.com"
                        required>
                </div>
                @error('email')
                    <div class="error-msg">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Mot de passe --}}
            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label-custom">
                        <i class="bi bi-lock me-1" style="color:var(--gold)"></i>Mot de passe
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" name="password" id="password"
                            class="form-input-custom"
                            placeholder="••••••••"
                            required>
                    </div>
                    @error('password')
                        <div class="error-msg">
                            <i class="bi bi-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-6">
                    <label class="form-label-custom">
                        <i class="bi bi-lock-fill me-1" style="color:var(--gold)"></i>Confirmation
                    </label>
                    <div class="input-wrapper">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" name="password_confirmation"
                            class="form-input-custom"
                            placeholder="••••••••"
                            required>
                    </div>
                </div>
            </div>

            {{-- Rôle --}}
            <div style="margin-bottom:20px">
                <label class="form-label-custom">
                    <i class="bi bi-person-badge me-1" style="color:var(--gold)"></i>Je suis un
                </label>
                <input type="hidden" name="role" id="roleInput" value="client">
                <div class="role-selector">
                    <div class="role-option selected" onclick="selectRole('client', this)">
                        <span class="role-icon">🏠</span>
                        <span class="role-title">Client</span>
                        <span class="role-desc">Je cherche un bien</span>
                    </div>
                    <div class="role-option" onclick="selectRole('prestataire', this)">
                        <span class="role-icon">🏗️</span>
                        <span class="role-title">Prestataire</span>
                        <span class="role-desc">Je propose un service</span>
                    </div>
                </div>
            </div>

            {{-- Bouton --}}
            <button type="submit" class="btn-register">
                <i class="bi bi-person-plus"></i>
                Créer mon compte gratuitement
            </button>

            <div class="login-link">
                Vous avez déjà un compte ?
                <a href="{{ route('login') }}">Se connecter</a>
            </div>
        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function selectRole(role, el) {
        document.querySelectorAll('.role-option').forEach(o => o.classList.remove('selected'));
        el.classList.add('selected');
        document.getElementById('roleInput').value = role;
    }
</script>

</body>
</html>