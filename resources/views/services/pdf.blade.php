<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #333;
            background: #ffffff;
        }

        /* ── HEADER ── */
        .header {
            background: #0D1F3C;
            padding: 24px 30px;
            margin-bottom: 24px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #B8972A;
            padding-bottom: 16px;
            margin-bottom: 14px;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 2px;
        }

        .logo-text span {
            color: #B8972A;
        }

        .logo-tagline {
            font-size: 10px;
            color: rgba(255,255,255,0.6);
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-top: 4px;
        }

        .header-meta {
            text-align: right;
            color: rgba(255,255,255,0.7);
            font-size: 11px;
            line-height: 1.8;
        }

        .header-meta strong {
            color: #B8972A;
            font-size: 13px;
        }

        .doc-title {
            color: rgba(255,255,255,0.9);
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        /* ── STATS BAR ── */
        .stats-bar {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            padding: 0 4px;
        }

        .stat-box {
            flex: 1;
            background: #F4F6FA;
            border-left: 4px solid #B8972A;
            padding: 12px 16px;
            border-radius: 0 8px 8px 0;
        }

        .stat-box .stat-value {
            font-size: 22px;
            font-weight: 700;
            color: #0D1F3C;
        }

        .stat-box .stat-label {
            font-size: 11px;
            color: #6B7280;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ── SERVICE CARD ── */
        .service {
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            margin-bottom: 18px;
            overflow: hidden;
            page-break-inside: avoid;
        }

        .service-header {
            background: #0D1F3C;
            padding: 12px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .service-header h3 {
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            margin: 0;
        }

        .service-header .num {
            color: #B8972A;
            font-size: 11px;
            font-weight: 700;
            border: 1px solid #B8972A;
            padding: 2px 8px;
            border-radius: 12px;
        }

        .service-body {
            padding: 16px 18px;
        }

        .service-meta {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 10px;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            background: #0D1F3C;
            color: white;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .badge-gold {
            background: #B8972A;
            color: white;
        }

        .badge-actif {
            background: #065F46;
            color: white;
        }

        .badge-inactif {
            background: #6B7280;
            color: white;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 10px;
        }

        .info-item {
            font-size: 12px;
            color: #4B5563;
        }

        .info-item strong {
            color: #0D1F3C;
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .description {
            font-size: 12px;
            color: #6B7280;
            line-height: 1.6;
            border-top: 1px solid #F4F6FA;
            padding-top: 10px;
            margin-top: 4px;
        }

        .prix {
            font-size: 18px;
            font-weight: 700;
            color: #B8972A;
        }

        /* ── SEPARATOR ── */
        .gold-line {
            height: 2px;
            background: linear-gradient(to right, #B8972A, #D4AF37, transparent);
            margin: 20px 0;
            border: none;
        }

        /* ── FOOTER ── */
        .footer {
            background: #0D1F3C;
            padding: 16px 30px;
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-left {
            color: rgba(255,255,255,0.6);
            font-size: 10px;
        }

        .footer-left strong {
            color: #B8972A;
        }

        .footer-right {
            color: rgba(255,255,255,0.4);
            font-size: 10px;
            text-align: right;
        }

        /* ── EMPTY STATE ── */
        .empty {
            text-align: center;
            padding: 40px;
            color: #6B7280;
            border: 2px dashed #E5E7EB;
            border-radius: 12px;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <div class="header-top">
            <div>
                <div class="logo-text">IMMO<span>SERV+</span></div>
                <div class="logo-tagline">Votre plateforme immobilière sûre</div>
            </div>
            <div class="header-meta">
                <strong>{{ auth()->user()->name }}</strong><br>
                Prestataire certifié<br>
                Exporté le {{ now()->format('d/m/Y à H:i') }}
            </div>
        </div>
        <div class="doc-title">
            Rapport d'annonces immobilières
        </div>
    </div>

    {{-- STATS --}}
    @php $total = count($services); $actifs = $services->where('statut','actif')->count(); @endphp
    <div class="stats-bar">
        <div class="stat-box">
            <div class="stat-value">{{ $total }}</div>
            <div class="stat-label">Total annonces</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ $actifs }}</div>
            <div class="stat-label">Annonces actives</div>
        </div>
        <div class="stat-box">
            <div class="stat-value">{{ $total - $actifs }}</div>
            <div class="stat-label">Inactives</div>
        </div>
    </div>

    {{-- ANNONCES --}}
    @forelse($services as $index => $service)
        <div class="service">
            <div class="service-header">
                <h3>{{ $service->titre }}</h3>
                <span class="num">#{{ $index + 1 }}</span>
            </div>
            <div class="service-body">
                <div class="service-meta">
                    <span class="badge">{{ $service->categorie->nom }}</span>
                    <span class="badge {{ $service->statut === 'actif' ? 'badge-actif' : 'badge-inactif' }}">
                        {{ ucfirst($service->statut) }}
                    </span>
                    @if($service->prix)
                        <span class="badge badge-gold">
                            {{ number_format($service->prix, 0, ',', ' ') }} FCFA
                        </span>
                    @endif
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <strong>Localisation</strong>
                        {{ $service->localisation }}
                    </div>
                    <div class="info-item">
                        <strong>Date de publication</strong>
                        {{ $service->created_at->format('d/m/Y') }}
                    </div>
                </div>

                <div class="description">
                    {{ $service->description }}
                </div>
            </div>
        </div>
    @empty
        <div class="empty">
            Aucune annonce à exporter.
        </div>
    @endforelse

    {{-- FOOTER --}}
    <div class="footer">
        <div class="footer-left">
            © {{ now()->format('Y') }} <strong>ImmoServ+</strong> — Tous droits réservés
        </div>
        <div class="footer-right">
            Document généré automatiquement<br>
            {{ now()->format('d/m/Y à H:i') }}
        </div>
    </div>

</body>
</html>