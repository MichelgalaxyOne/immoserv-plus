<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ImmoServ+ — Connexion</title>

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

        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 560px;
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

        .left-logo img { height: 90px; object-fit: contain; }

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

        .form-header p { color: #6B7280; font-size: 14px; }

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
            margin-bottom: 20px;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            font-size: 15px;
        }

        .toggle-password {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #9CA3AF;
            cursor: pointer;
            font-size: 15px;
            transition: color 0.2s;
        }

        .toggle-password:hover { color: var(--navy); }

        .remember-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #6B7280;
            cursor: pointer;
        }

        .remember-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--gold);
            cursor: pointer;
        }

        .forgot-link {
            font-size: 13px;
            color: var(--gold);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover { color: var(--gold2); }

        .btn-login {
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

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(184,151,42,0.4);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: #D1D5DB;
            font-size: 12px;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #E5E7EB;
        }

        .btn-landing {
            width: 100%;
            background: transparent;
            color: var(--navy);
            font-weight: 600;
            font-size: 14px;
            padding: 12px;
            border-radius: 12px;
            border: 2px solid #E5E7EB;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-landing:hover {
            border-color: var(--navy);
            color: var(--navy);
            background: #F4F6FA;
        }

        .register-link {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: #6B7280;
        }

        .register-link a {
            color: var(--navy);
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover { color: var(--gold); }

        .error-msg {
            color: #EF4444;
            font-size: 12px;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .alert-success {
            background: #ECFDF5;
            border: 1px solid #6EE7B7;
            color: #065F46;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        @media (max-width: 768px) {
            .left-panel { display: none; }
            .right-panel { padding: 36px 24px; }
            .login-wrapper { max-width: 440px; border-radius: 20px; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    {{-- ── PANNEAU GAUCHE ── --}}
    <div class="left-panel">
        <div class="left-logo">
            <img src="{{ asset('images/logo.png') }}" alt="ImmoServ+">
        </div>

        <div class="left-content">
            <h2 class="left-title">
                Bon retour sur<br>
                <span>ImmoServ+</span>
            </h2>
            <p class="left-desc">
                Connectez-vous pour accéder à votre espace personnel et retrouver toutes vos annonces et demandes.
            </p>

            @foreach([
                ['house-fill', 'Des milliers d\'annonces disponibles'],
                ['geo-alt-fill', 'Biens géolocalisés sur carte'],
                ['chat-dots-fill', 'Messagerie temps réel intégrée'],
                ['shield-check-fill', 'Plateforme 100% sécurisée'],
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
            <h2>Se connecter</h2>
            <p>Entrez vos identifiants pour accéder à votre compte</p>
        </div>

        {{-- Message de statut --}}
        @if (session('status'))
            <div class="alert-success">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

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
                        required autofocus>
                </div>
                @error('email')
                    <div class="error-msg">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Mot de passe --}}
            <div>
                <label class="form-label-custom">
                    <i class="bi bi-lock me-1" style="color:var(--gold)"></i>Mot de passe
                </label>
                <div class="input-wrapper">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password" id="password"
                        class="form-input-custom"
                        placeholder="••••••••"
                        required>
                    <i class="bi bi-eye toggle-password" id="togglePwd"
                        onclick="togglePassword()"></i>
                </div>
                @error('password')
                    <div class="error-msg">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Se souvenir + Mot de passe oublié --}}
            <div class="remember-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember" id="remember_me">
                    Se souvenir de moi
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>

            {{-- Bouton connexion --}}
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i>
                Se connecter
            </button>

            <div class="divider">ou</div>

            {{-- Retour accueil --}}
            <a href="{{ route('home') }}" class="btn-landing">
                <i class="bi bi-house"></i>
                Retour à l'accueil
            </a>

            <div class="register-link">
                Pas encore de compte ?
                <a href="{{ route('register') }}">Créer un compte gratuit</a>
            </div>
        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword() {
        const pwd = document.getElementById('password');
        const icon = document.getElementById('togglePwd');
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            pwd.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    }
</script>

</body>
</html>