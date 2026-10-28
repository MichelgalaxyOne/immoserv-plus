<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ImmoServ+ — {{ config('app.name', 'Votre plateforme immobilière sûre') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --navy:   #0D1F3C;
            --gold:   #B8972A;
            --gold-light: #D4AF37;
            --white:  #FFFFFF;
            --gray-bg: #F4F6FA;
            --text-dark: #1A1A2E;
            --text-muted: #6B7280;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-bg);
            color: var(--text-dark);
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        .immo-navbar {
            background: linear-gradient(135deg, #0D1F3C 0%, #1a3560 100%);
            box-shadow: 0 4px 20px rgba(13,31,60,0.4);
            padding: 0 1.5rem;
            height: 70px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .immo-navbar .navbar-brand {
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .immo-navbar .nav-link {
            color: rgba(255,255,255,0.85) !important;
            font-size: 14px;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .immo-navbar .nav-link:hover {
            color: var(--gold-light) !important;
            background: rgba(255,255,255,0.08);
        }

        .immo-navbar .nav-link.active {
            color: var(--gold-light) !important;
        }

        .immo-navbar .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #B8972A, #D4AF37);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--navy);
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
        }

        .immo-navbar .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            border-radius: 12px;
            padding: 8px;
            min-width: 200px;
        }

        .immo-navbar .dropdown-item {
            border-radius: 8px;
            font-size: 14px;
            padding: 8px 14px;
            color: var(--text-dark);
            transition: all 0.15s;
        }

        .immo-navbar .dropdown-item:hover {
            background: #F4F6FA;
            color: var(--navy);
        }

        .notif-badge {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .notif-badge .badge-dot {
    position: absolute;
    top: -4px;
    right: -4px;
    width: 18px;
    height: 18px;
    background: #EF4444;
    border-radius: 50%;
    font-size: 10px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
}

.notif-badge.has-unread i {
    color: #EF4444 !important;
}

.notif-item-unread {
    background: rgba(239,68,68,0.05);
    border-left: 3px solid #EF4444;
}

.notif-mark-read {
    font-size: 10px;
    color: #B8972A;
    text-decoration: none;
    cursor: pointer;
    white-space: nowrap;
}

.notif-mark-read:hover { color: #0D1F3C; }

        /* ── PAGE HEADER ── */
        .page-header {
            background: linear-gradient(135deg, #0D1F3C 0%, #1a3560 100%);
            color: white;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
        }

        .page-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
            color: white;
        }

        .page-header .breadcrumb {
            margin: 0;
            font-size: 13px;
        }

        .page-header .breadcrumb-item,
        .page-header .breadcrumb-item a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
        }

        .page-header .breadcrumb-item.active {
            color: var(--gold-light);
        }

        .page-header .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.4);
        }

        /* ── CARDS ── */
        .immo-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(13,31,60,0.08);
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .immo-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(13,31,60,0.15);
        }

        /* ── BUTTONS ── */
        .btn-navy {
            background: var(--navy);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-navy:hover {
            background: #1a3560;
            color: white;
            transform: translateY(-1px);
        }

        .btn-immo-gold {
            background: linear-gradient(135deg, #B8972A, #D4AF37);
            color: var(--navy);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-immo-gold:hover {
            color: var(--navy);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(184,151,42,0.4);
        }

        /* ── BADGES ── */
        .badge-navy { background: var(--navy); color: white; }
        .badge-gold { background: var(--gold); color: white; }

        /* ── FOOTER ── */
        .immo-footer {
            background: linear-gradient(135deg, #0D1F3C 0%, #1a3560 100%);
            color: rgba(255,255,255,0.7);
            padding: 2rem 0;
            margin-top: 4rem;
            font-size: 13px;
            text-align: center;
        }

        .immo-footer span {
            color: var(--gold-light);
        }

        /* ── ALERTS ── */
        .alert-immo-success {
            background: #ECFDF5;
            border: 1px solid #6EE7B7;
            color: #065F46;
            border-radius: 10px;
        }

        .alert-immo-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            color: #991B1B;
            border-radius: 10px;
        }

        /* ── FORMS ── */
        .form-control:focus, .form-select:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(184,151,42,0.15);
        }

        /* ── SCROLLBAR ── */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: var(--navy); border-radius: 3px; }
    </style>
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="immo-navbar d-flex align-items-center justify-content-between">

        {{-- Logo --}}
        <a href="{{ route('services.index') }}" class="navbar-brand">
            <img src="{{ asset('images/logo.jpeg') }}"
    alt="ImmoServ+"
    style="height:56px;width:auto;object-fit:contain;
    mix-blend-mode:lighten;border-radius:8px">
        </a>

        {{-- Liens navigation --}}
        <div class="d-none d-md-flex align-items-center gap-1">
            <a href="{{ route('services.index') }}" class="nav-link {{ request()->routeIs('services.index') ? 'active' : '' }}">
                <i class="bi bi-grid me-1"></i>Annonces
            </a>
            @auth
                @if(auth()->user()->role === 'client')
                    <a href="{{ route('demandes.envoyees') }}" class="nav-link {{ request()->routeIs('demandes.envoyees') ? 'active' : '' }}">
                        <i class="bi bi-send me-1"></i>Mes demandes
                    </a>
                @endif
                @if(auth()->user()->role === 'prestataire')
                    <a href="{{ route('demandes.recues') }}" class="nav-link {{ request()->routeIs('demandes.recues') ? 'active' : '' }}">
                        <i class="bi bi-inbox me-1"></i>Demandes reçues
                    </a>
                @endif
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}">
                        <i class="bi bi-shield-check me-1"></i>Administration
                    </a>
                @endif
            @endauth
        </div>

        {{-- Droite : notifs + user --}}
        <div class="d-flex align-items-center gap-3">
            @auth
               {{-- Notifications --}}
@php $notifications = auth()->user()->unreadNotifications; @endphp
<div class="dropdown">
    <button class="notif-badge btn p-0 border-0 {{ $notifications->count() > 0 ? 'has-unread' : '' }}"
        data-bs-toggle="dropdown" id="notifBell">
        <i class="bi bi-bell" style="color:rgba(255,255,255,0.85);font-size:20px;"></i>
        @if($notifications->count() > 0)
            <span class="badge-dot" id="notifBadge">{{ $notifications->count() }}</span>
        @endif
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="min-width:320px" id="notifList">
        <li class="px-3 py-2 border-bottom d-flex justify-content-between align-items-center">
            <strong style="font-size:13px">Notifications</strong>
            @if($notifications->count() > 0)
                <a href="{{ route('notifications.lire') }}" class="notif-mark-read">
                    Tout marquer comme lu
                </a>
            @endif
        </li>
        @forelse($notifications->take(8) as $notif)
            @php
                $isMessage = ($notif->data['type'] ?? '') === 'message';
                $link = $isMessage
                    ? route('messages.index', $notif->data['demande_id'])
                    : '#';
            @endphp
            <li class="notif-item-unread" data-notif-id="{{ $notif->id }}">
                <a class="dropdown-item py-2" href="{{ $link }}">
                    <i class="bi {{ $isMessage ? 'bi-chat-dots-fill' : 'bi-bell-fill' }} text-warning me-2"></i>
                    <span style="font-size:12px">{{ $notif->data['message'] }}</span>
                    @if($isMessage && !empty($notif->data['contenu']))
                        <div style="font-size:11px;color:#6B7280;margin-top:2px;margin-left:22px">
                            "{{ \Illuminate\Support\Str::limit($notif->data['contenu'], 40) }}"
                        </div>
                    @endif
                </a>
            </li>
        @empty
            <li id="noNotifMsg">
                <span class="dropdown-item py-2 text-muted" style="font-size:12px">
                    Aucune notification
                </span>
            </li>
        @endforelse
    </ul>
</div>

                {{-- User dropdown --}}
                <div class="dropdown">
                    <div class="user-avatar dropdown-toggle" data-bs-toggle="dropdown" style="list-style:none">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="px-3 py-2 border-bottom">
                            <div style="font-weight:600;font-size:14px">{{ auth()->user()->name }}</div>
                            <div style="font-size:12px;color:var(--text-muted)">{{ ucfirst(auth()->user()->role) }}</div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2"></i>Mon profil
                            </a>
                        </li>
                        @if(auth()->user()->role === 'prestataire')
                            <li>
                                <a class="dropdown-item" href="{{ route('services.create') }}">
                                    <i class="bi bi-plus-circle me-2"></i>Publier une annonce
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('services.export.pdf') }}">
                                    <i class="bi bi-file-pdf me-2"></i>Exporter en PDF
                                </a>
                            </li>
                        @endif
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i>Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            @else
                <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                <a href="{{ route('register') }}"
                    style="background:linear-gradient(135deg,#B8972A,#D4AF37);color:#0D1F3C;
                    padding:8px 18px;border-radius:25px;font-size:13px;font-weight:600;
                    text-decoration:none;transition:all 0.2s">
                    S'inscrire
                </a>
            @endauth
        </div>
    </nav>

    {{-- PAGE HEADER --}}
    @isset($header)
        <div class="page-header">
            <div style="max-width:1280px;margin:0 auto;padding:0 1.5rem">
                {{ $header }}
            </div>
        </div>
    @endisset

    {{-- CONTENU --}}
    <main style="min-height:calc(100vh - 70px - 100px)">
        {{ $slot }}
    </main>

   {{-- FOOTER --}}
<footer style="background:linear-gradient(135deg,#0D1F3C 0%,#1a3560 100%);margin-top:4rem">

    <div style="max-width:1280px;margin:0 auto;padding:2rem 1.5rem">
        <div class="row g-3 align-items-start">

            {{-- Colonne 1 : Logo + slogan --}}
            <div class="col-md-3">
                <img src="{{ asset('images/logo.jpeg') }}"
    alt="ImmoServ+"
    style="height:56px;width:auto;object-fit:contain;
    mix-blend-mode:lighten;border-radius:8px">
                <p style="color:rgba(255,255,255,0.5);font-size:12px;line-height:1.7;margin:0">
                    Mise en relation entre clients et prestataires immobiliers au Bénin.
                </p>
                <div class="d-flex gap-2 mt-3">
                    @foreach(['facebook','instagram','linkedin','whatsapp'] as $rs)
                        <a href="#" style="width:30px;height:30px;background:rgba(255,255,255,0.08);
                            border-radius:50%;display:flex;align-items:center;justify-content:center;
                            color:rgba(255,255,255,0.6);text-decoration:none;font-size:13px;
                            transition:all 0.2s"
                            onmouseover="this.style.background='#B8972A';this.style.color='white'"
                            onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.color='rgba(255,255,255,0.6)'">
                            <i class="bi bi-{{ $rs }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Colonne 2 : Navigation --}}
            <div class="col-md-3 offset-md-1">
                <p style="color:#B8972A;font-size:11px;font-weight:600;
                    letter-spacing:2px;text-transform:uppercase;margin-bottom:12px">
                    Navigation
                </p>
                @foreach([
                    ['Annonces', 'services.index', []],
                    ['Mon profil', 'profile.edit', []],
                ] as [$label, $route, $params])
                    <a href="{{ route($route, $params) }}"
                        style="display:block;color:rgba(255,255,255,0.55);font-size:12px;
                        text-decoration:none;margin-bottom:8px;transition:color 0.2s"
                        onmouseover="this.style.color='#B8972A'"
                        onmouseout="this.style.color='rgba(255,255,255,0.55)'">
                        <i class="bi bi-chevron-right me-1" style="font-size:10px"></i>{{ $label }}
                    </a>
                @endforeach
                @auth
                    @if(auth()->user()->role === 'prestataire')
                        <a href="{{ route('services.create') }}"
                            style="display:block;color:rgba(255,255,255,0.55);font-size:12px;
                            text-decoration:none;margin-bottom:8px;transition:color 0.2s"
                            onmouseover="this.style.color='#B8972A'"
                            onmouseout="this.style.color='rgba(255,255,255,0.55)'">
                            <i class="bi bi-chevron-right me-1" style="font-size:10px"></i>Publier une annonce
                        </a>
                        <a href="{{ route('demandes.recues') }}"
                            style="display:block;color:rgba(255,255,255,0.55);font-size:12px;
                            text-decoration:none;margin-bottom:8px;transition:color 0.2s"
                            onmouseover="this.style.color='#B8972A'"
                            onmouseout="this.style.color='rgba(255,255,255,0.55)'">
                            <i class="bi bi-chevron-right me-1" style="font-size:10px"></i>Demandes reçues
                        </a>
                    @endif
                    @if(auth()->user()->role === 'client')
                        <a href="{{ route('demandes.envoyees') }}"
                            style="display:block;color:rgba(255,255,255,0.55);font-size:12px;
                            text-decoration:none;margin-bottom:8px;transition:color 0.2s"
                            onmouseover="this.style.color='#B8972A'"
                            onmouseout="this.style.color='rgba(255,255,255,0.55)'">
                            <i class="bi bi-chevron-right me-1" style="font-size:10px"></i>Mes demandes
                        </a>
                    @endif
                @endauth
            </div>

            {{-- Colonne 3 : Services --}}
            <div class="col-md-2">
                <p style="color:#B8972A;font-size:11px;font-weight:600;
                    letter-spacing:2px;text-transform:uppercase;margin-bottom:12px">
                    Services
                </p>
                @foreach(\App\Models\Categorie::take(5)->get() as $cat)
                    <a href="{{ route('services.index', ['categorie' => $cat->id]) }}"
                        style="display:block;color:rgba(255,255,255,0.55);font-size:12px;
                        text-decoration:none;margin-bottom:8px;transition:color 0.2s"
                        onmouseover="this.style.color='#B8972A'"
                        onmouseout="this.style.color='rgba(255,255,255,0.55)'">
                        <i class="bi bi-chevron-right me-1" style="font-size:10px"></i>{{ $cat->nom }}
                    </a>
                @endforeach
            </div>

            {{-- Colonne 4 : Contact --}}
            <div class="col-md-3">
                <p style="color:#B8972A;font-size:11px;font-weight:600;
                    letter-spacing:2px;text-transform:uppercase;margin-bottom:12px">
                    Contact
                </p>
                @foreach([
                    ['geo-alt-fill', 'Cotonou, Bénin', null],
                    ['envelope-fill', 'contact@immoserv.bj', 'mailto:contact@immoserv.bj'],
                    ['telephone-fill', '+229 00 00 00 00', 'tel:+22900000000'],
                ] as [$icon, $text, $href])
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px">
                        <i class="bi bi-{{ $icon }}" style="color:#B8972A;font-size:13px;flex-shrink:0"></i>
                        @if($href)
                            <a href="{{ $href }}"
                                style="color:rgba(255,255,255,0.55);font-size:12px;text-decoration:none"
                                onmouseover="this.style.color='#B8972A'"
                                onmouseout="this.style.color='rgba(255,255,255,0.55)'">
                                {{ $text }}
                            </a>
                        @else
                            <span style="color:rgba(255,255,255,0.55);font-size:12px">{{ $text }}</span>
                        @endif
                    </div>
                @endforeach

                <div style="background:rgba(184,151,42,0.1);border:1px solid rgba(184,151,42,0.25);
                    border-radius:8px;padding:10px 12px;margin-top:8px;
                    display:flex;align-items:center;gap:8px">
                    <i class="bi bi-shield-check-fill" style="color:#B8972A;font-size:18px"></i>
                    <div>
                        <div style="color:white;font-size:11px;font-weight:600">Plateforme sécurisée</div>
                        <div style="color:rgba(255,255,255,0.4);font-size:10px">Transactions protégées</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Séparateur doré --}}
    <div style="height:1px;background:linear-gradient(to right,transparent,#B8972A,transparent);margin:0 1.5rem"></div>

    {{-- Copyright --}}
    <div style="max-width:1280px;margin:0 auto;padding:1rem 1.5rem;
        display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">
        <span style="color:rgba(255,255,255,0.4);font-size:11px">
            © {{ date('Y') }} <span style="color:#B8972A;font-weight:600">ImmoServ+</span>
            — Tous droits réservés.
        </span>
        <span style="color:rgba(255,255,255,0.3);font-size:11px">
            Développé avec <span style="color:#B8972A">Code Crafted</span> au Bénin
        </span>
    </div>

</footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   @auth
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    const notifToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const pusherNotif = new Pusher("{{ config('broadcasting.connections.reverb.key') }}", {
        wsHost: "127.0.0.1",
        wsPort: 8080,
        wssPort: 8080,
        forceTLS: false,
        enabledTransports: ['ws', 'wss'],
        cluster: 'mt1',
        authEndpoint: '/broadcasting/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': notifToken
            }
        }
    });

    const notifChannel = pusherNotif.subscribe('private-App.Models.User.{{ auth()->id() }}');

    notifChannel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
        console.log('🔔 Nouvelle notification reçue:', data);

        const bell = document.getElementById('notifBell');
        let badge = document.getElementById('notifBadge');

        // Met à jour ou crée le badge
        if (badge) {
            badge.textContent = parseInt(badge.textContent) + 1;
        } else {
            badge = document.createElement('span');
            badge.className = 'badge-dot';
            badge.id = 'notifBadge';
            badge.textContent = '1';
            bell.appendChild(badge);
        }

        // Rend la cloche rouge
        bell.classList.add('has-unread');

        // Supprime le message "Aucune notification"
        const noNotif = document.getElementById('noNotifMsg');
        if (noNotif) noNotif.remove();

        // Détermine le lien et l'icône selon le type
        const isMessage = data.type === 'message';
        const link = isMessage ? `/messages/${data.demande_id}` : '#';
        const icon = isMessage ? 'bi-chat-dots-fill' : 'bi-bell-fill';
        const extra = (isMessage && data.contenu)
            ? `<div style="font-size:11px;color:#6B7280;margin-top:2px;margin-left:22px">"${data.contenu.length > 40 ? data.contenu.substring(0,40)+'...' : data.contenu}"</div>`
            : '';

        // Ajoute la notification en haut de la liste
        const list = document.getElementById('notifList');
        const li = document.createElement('li');
        li.className = 'notif-item-unread';
        li.innerHTML = `
            <a class="dropdown-item py-2" href="${link}">
                <i class="bi ${icon} text-warning me-2"></i>
                <span style="font-size:12px">${data.message}</span>
                ${extra}
            </a>`;

        const header = list.querySelector('li');
        header.after(li);

        // Affiche le lien "Tout marquer comme lu" si absent
        if (!header.querySelector('.notif-mark-read')) {
            const markLink = document.createElement('a');
            markLink.href = "{{ route('notifications.lire') }}";
            markLink.className = 'notif-mark-read';
            markLink.textContent = 'Tout marquer comme lu';
            header.appendChild(markLink);
            header.classList.add('d-flex', 'justify-content-between', 'align-items-center');
        }
    });
</script>
@endauth
</body>
</html>