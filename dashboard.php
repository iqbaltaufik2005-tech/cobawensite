<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIIRRR - Monitoring Ikan Koi</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --bg-body: #EDE7E3;
            --sidebar-bg: #16697a;
            --header-bg: #EDE7E3;
            --card-bg: #09183B;
            --card-bg2: #092B57;
            --card-inner: #15355a;
            --accent-cyan: #00e5ff;
            --accent-green: #00ffa3;
            --accent-red: #ff4d4d;
            --text-white: #ffffff;
            --text-muted: #94a3b8;
            --shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
    
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Space Grotesk', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-white);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        aside {
            width: 260px;
            background-color: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            padding: 40px 0;
            z-index: 100;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
        }

        .brand-header {
            display: flex;
            flex-direction: column; 
            align-items: center;    
            text-align: center;                 
        }

        .logo {
            padding: 0 30px;
            margin-bottom: 60px;
        }

        .logo h1 {
            color: var(--accent-cyan);
            font-size: 36px;
            font-weight: 800;
            letter-spacing: 2px;
            line-height: 1;
        }

        .logo span {
            font-size: 10px;
            color: var(--text-muted);
            letter-spacing: 1px;
            display: block;
            margin-top: 5px;
        }

        nav ul { list-style: none; }
        .nav-item {
            padding: 5px 20px;
            margin-bottom: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            cursor: pointer;
            font-weight: 500;
            gap: 12px;
        }

        .nav-link i { margin-right: 15px; width: 20px; }

        .nav-link:hover, .nav-link.active {
            background: rgba(0, 229, 255, 0.15);
            color: var(--accent-cyan);
        }

        /* MAIN CONTENT */
        main {
            flex: 1;
            margin-left: 260px; /* Memberi ruang untuk sidebar fixed */
            position: relative;
            padding-bottom: 50px;
        }

        /* HEADER */
        header {
            padding: 20px 50px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            position: fixed;
            top: 0;
            left: 260px; /* Menyesuaikan dengan lebar sidebar */
            right: 0;
            background-color: var(--header-bg);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            z-index: 90;
            transition: all 0.3s ease;
        }

        /* Efek Glassy saat di-scroll */
        header.scrolled {
            background-color: rgba(9, 24, 59, 0.7); /* Transparan gelap matching tema card */
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .header-actions { 
            display: flex; 
            align-items: center; 
            gap: 25px; 
            position: relative;
        }

        .icon-btn {
            background: none;
            border: none;
            color: #4f5b6c;
            cursor: pointer;
            position: relative;
            transition: 0.3s;
        }

        .icon-btn:hover { color: var(--sidebar-bg); }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: var(--shadow);
            object-fit: cover;
        }

        /* PAGES */
        .page {
            display: none;
            padding: 110px 50px 0 50px; /* Padding top disesuaikan dengan tinggi header */
            animation: fadeIn 0.4s ease-out;
        }

        .page.active { display: block; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* GRID SYSTEM */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 10px;
        }

        /* CARDS */
        .card {
            background-color: var(--card-bg);
            border-radius: 24px;
            padding: 25px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .kolam-img {
            height: 180px;
            margin: -25px -25px 20px -25px;
            position: relative;
            overflow: hidden;
        }

        .kolam-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .tag-kolam {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(5px);
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .card-header h3 { font-size: 24px; font-weight: 700; }
        .card-header i { color: var(--accent-green); }

        .stat-row {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-box {
            background: var(--card-inner);
            flex: 1;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
        }

        .stat-label { font-size: 10px; color: var(--text-muted); display: block; margin-bottom: 8px; }
        .stat-val { font-size: 20px; font-weight: 800; color: var(--text-white); }
        .stat-val.green { color: var(--accent-green); }
        .stat-val.red { color: var(--accent-red); }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 15px;
        }

        .live-status {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--text-muted);
        }

        .dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent-green); box-shadow: 0 0 10px var(--accent-green); }

        .btn-detail {
            color: var(--accent-cyan);
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* BOTTOM ROW CARDS */
        .bottom-card { height: 320px; display: flex; flex-direction: column; }
        .card-title-sm { font-size: 12px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .card-subtitle { font-size: 18px; margin-bottom: 20px; }

        /* GAUGE CHART */
        .gauge-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .gauge-svg { width: 160px; height: 160px; transform: rotate(-90deg); }
        .gauge-bg { fill: none; stroke: rgba(255,255,255,0.1); stroke-width: 12; }
        .gauge-progress { 
            fill: none; stroke: var(--accent-green); stroke-width: 12; 
            stroke-dasharray: 440; stroke-dashoffset: 110;
            stroke-linecap: round;
        }

        .gauge-text {
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .gauge-val { font-size: 42px; font-weight: 800; line-height: 1; }
        .gauge-label { font-size: 11px; color: var(--accent-green); font-weight: 700; margin-top: 5px; }

        /* PERINGATAN */
        .warning-num { font-size: 80px; font-weight: 800; color: var(--accent-red); opacity: 0.8; }
        .shield-icon {
            position: absolute;
            bottom: 20px; right: 20px;
            font-size: 150px;
            color: rgba(255,255,255,0.03);
            pointer-events: none;
        }

        /* TOGGLE SWITCH */
        .automation-item {
            background: var(--card-inner);
            padding: 20px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
        }

        .icon-box {
            width: 45px; height: 45px;
            background: rgba(255,255,255,0.05);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 44px; height: 22px;
            margin-left: auto;
        }

        .switch input { opacity: 0; width: 0; height: 0; }
        .slider {
            position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
            background-color: #334155; transition: .4s; border-radius: 34px;
        }

        .slider:before {
            position: absolute; content: ""; height: 16px; width: 16px; left: 3px; bottom: 3px;
            background-color: white; transition: .4s; border-radius: 50%;
        }

        input:checked + .slider { background-color: var(--accent-cyan); }
        input:checked + .slider:before { transform: translateX(22px); }

        /* POPUPS & NOTIFICATIONS */
        .popup, .notif-popup {
            position: absolute;
            top: 85px; right: 50px;
            background: white;
            width: 320px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
            color: #1e293b;
            padding: 20px;
            display: none;
            z-index: 200;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown { 
            from { transform: translateY(-10px); opacity: 0; } 
            to { transform: translateY(0); opacity: 1; }
        }

        .popup-header, .notif-header { 
            font-weight: 800; 
            border-bottom: 1px solid #f1f5f9; 
            padding-bottom: 10px; 
            margin-bottom: 15px; 
            color: var(--sidebar-bg); 
        }
        
        .notif-item { display: flex; gap: 12px; margin-bottom: 15px; font-size: 13px; color: #475569; }
        .notif-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent-red); margin-top: 5px; }

        /* PROFILE PAGE */
        .profile-card { background: white; border-radius: 30px; padding: 50px; display: flex; gap: 50px; box-shadow: var(--shadow); max-width: 900px; margin: 0 auto; margin-top: 24px; }
        .profile-left { text-align: center; }
        .profile-img-lg { width: 180px; height: 180px; border-radius: 40px; object-fit: cover; margin-bottom: 20px; border: 5px solid #f1f5f9; }
        .profile-right { flex: 1; }
        .profile-right h2 { font-size: 32px; color: var(--sidebar-bg); margin-bottom: 5px; }
        .profile-right p { color: #64748b; margin-bottom: 30px; }
        
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px; }
        .info-item label { font-size: 12px; color: #94a3b8; display: block; margin-bottom: 5px; }
        .info-item span { font-weight: 700; color: var(--sidebar-bg); font-size: 16px; }

        .profile-actions { display: flex; gap: 15px; }
        .btn { padding: 14px 28px; border-radius: 14px; font-weight: 700; cursor: pointer; border: none; transition: 0.3s; }
        .btn-edit { background: var(--sidebar-bg); color: white; }
        .btn-logout { background: #fee2e2; color: #ef4444; border: 1px solid #fecaca; }
        .btn-logout:hover { background: #ef4444; color: white; }

        /* MONITORING PH SPECIFIC STYLES */
        .ph-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 20px;
        }

        .ph-card {
            background-color: var(--card-bg);
            border-radius: 20px;
            padding: 30px;
            color: white;
            position: relative;
            box-shadow: var(--shadow);
        }

        .ph-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 30px;
        }

        .ph-card-header h3 { font-size: 22px; margin-bottom: 5px; }
        .ph-card-header p { font-size: 12px; color: var(--text-muted); }
        .ph-card-header .wave-icon { color: var(--accent-green); opacity: 0.8; }

        .ph-content-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .ph-gauge-wrapper {
            position: relative;
            width: 110px;
            height: 110px;
        }

        .ph-circle {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 8px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 800;
        }

        .ph-circle.normal { border-top-color: var(--accent-green); border-right-color: var(--accent-green); }
        .ph-circle.danger { border-top-color: var(--accent-red); border-right-color: var(--accent-red); }

        .ph-stats-side {
            text-align: right;
        }

        .ph-stats-side .label-small {
            font-size: 9px;
            color: var(--text-muted);
            text-transform: uppercase;
            display: block;
            margin-top: 10px;
        }

        .ph-stats-side .val-small {
            font-size: 11px;
            font-weight: 700;
            display: block;
        }

        .ph-stats-side .condition {
            font-size: 12px;
            color: white;
            font-weight: 600;
            margin-top: 4px;
        }

        .btn-instant-feed {
            width: 100%;
            background-color: var(--accent-cyan);
            color: var(--sidebar-bg);
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 800;
            font-size: 13px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-instant-feed:hover {
            filter: brightness(1.1);
            transform: translateY(-2px);
        }

        /* STOK & RIWAYAT SPECIFIC STYLES */
        .stok-layout {
            display: flex;
            gap: 25px;
            margin-bottom: 25px;
        }

        .stok-status-card {
            flex: 1;
            background-color: var(--card-bg2);
            border-radius: 24px;
            padding: 30px;
            color: white;
        }

        .stok-item { margin-bottom: 25px; }

        .stok-info-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 8px;
        }

        .stok-info-top span:first-child {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stok-info-top .percent {
            font-size: 22px;
            font-weight: 800;
            color: var(--accent-green);
        }

        .progress-track {
            height: 10px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 6px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 1s ease-in-out;
        }

        .stok-info-bottom {
            text-align: right;
            font-size: 10px;
            font-weight: 600;
        }

        .riwayat-tabel-card {
            flex: 1.5;
            background-color: var(--card-bg2);
            border-radius: 24px;
            padding: 30px;
            color: white;
        }

        .tabel-header-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-bottom: 20px;
        }

        .search-box {
            background: rgba(255, 255, 255, 0.05);
            border: none;
            border-radius: 12px;
            padding: 10px 15px;
            color: white;
            font-size: 13px;
            width: 250px;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .custom-table th {
            text-align: left;
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            padding: 15px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .custom-table td {
            padding: 20px 10px;
            font-size: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        }

        .status-pill {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .status-berhasil { background: rgba(0, 255, 163, 0.1); color: var(--accent-green); }
        .status-manual { background: rgba(255, 77, 77, 0.1); color: var(--accent-red); }

        .bottom-stok-stats {
            display: flex;
            gap: 20px;
        }

        .stat-mini-card {
            background: var(--card-bg);
            padding: 20px 30px;
            border-radius: 20px;
            min-width: 200px;
            box-shadow: var(--shadow);
        }

        .stat-mini-card span { font-size: 10px; color: var(--text-muted); text-transform: uppercase; display: block; margin-bottom: 5px; }
        .stat-mini-card h3 { font-size: 28px; font-weight: 800; color: white; }

        /* JADWAL PAKAN STYLES */
        .schedule-container {
            display: flex;
            gap: 25px;
            margin-bottom: 25px;
        }

        .timeline-card {
            flex: 1.6;
            background: var(--card-bg2);
            border-radius: 24px;
            padding: 30px;
            color: white;
        }

        .timeline-list {
            position: relative;
            margin-top: 30px;
            padding-left: 40px;
        }

        .timeline-list::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: rgba(255, 255, 255, 0.1);
        }

        .timeline-item {
            position: relative;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -35px;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            background: var(--card-bg);
            border: 3px solid var(--accent-cyan);
            border-radius: 50%;
            z-index: 2;
        }

        .timeline-time { color: var(--accent-green); font-weight: 800; font-size: 18px; margin-right: 15px; }

        .history-card {
            flex: 1;
            background: var(--card-bg2);
            border-radius: 24px;
            padding: 30px;
            color: white;
        }

        .history-item {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 12px;
            border-left: 4px solid var(--accent-cyan);
        }

        .history-item.fail { border-left-color: var(--accent-red); }

        /* ARTICLE CARDS */
        .article-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-top: 25px;
        }

        .article-card {
            height: 200px;
            border-radius: 24px;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 25px;
            color: white;
            cursor: pointer;
        }

        .article-card img {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover; z-index: -1;
            filter: brightness(0.6);
        }

        /* MODAL STYLES */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(8px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            width: 600px;
            border-radius: 32px;
            padding: 45px;
            color: #1e293b;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin: 30px 0;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #64748b;
        }

        .input-group input, .input-group select {
            width: 100%;
            padding: 15px;
            background: #f1f5f9;
            border: 2px solid transparent;
            border-radius: 16px;
            font-family: inherit;
            font-weight: 600;
        }

        .input-group input:focus { border-color: var(--accent-cyan); outline: none; }

        .days-row {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        .day-chip {
            width: 55px;
            height: 45px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.2s;
        }

        .day-chip.active {
            border-color: var(--accent-cyan);
            color: var(--accent-cyan);
            background: rgba(0, 229, 255, 0.05);
        }

        .modal-footer {
            display: flex;
            gap: 20px;
            margin-top: 40px;
        }

        .btn-cancel {
            flex: 1;
            padding: 18px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 18px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-save {
            flex: 1;
            padding: 18px;
            background: var(--sidebar-bg);
            color: white;
            border: none;
            border-radius: 18px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(6, 26, 55, 0.3);
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside>
        <div class="brand-header">
            <div class="logo">
            <h1>AIIRR</h1>
            <span>MONITORING IKAN KOI</span>
            </div>
        </div>
        
        <nav>
            <ul>
                <li class="nav-item">
                    <a class="nav-link active" onclick="showPage('beranda', this)">
                        <i data-lucide="layout-grid"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showPage('monitoring', this)">
                        <i data-lucide="droplets"></i> Monitoring pH
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showPage('stok', this)">
                        <i data-lucide="box"></i> Stok
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" onclick="showPage('jadwal', this)">
                        <i data-lucide="calendar"></i> Jadwal
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main>
        <header>
            <div class="header-actions">
                <button class="icon-btn" onclick="togglePopup('notifPopup')">
                    <i data-lucide="bell"></i>
                </button>
                <img src="https://lh3.googleusercontent.com/a/ACg8ocKn4Hlc5Ntn3JzA_ALHbW59BOMD5AwA_HMvyDEX3RLb7Us2d8cI=s360-c-no" class="avatar" onclick="showPage('profile', null)">
                
                <!-- Notif Popup -->
                <div id="notifPopup" class="popup">
                    <div class="popup-header">Notifikasi Terbaru</div>
                    <div class="notif-item">
                        <div class="notif-dot"></div>
                        <div>
                            <strong>Peringatan pH!</strong><br>
                            Kolam 1 mendeteksi pH rendah (5.6).
                        </div>
                    </div>

                    <div class="notif-item">
                        <div class="notif-dot" style="background: var(--accent-green)"></div>
                        <div>
                            <strong>Jadwal Selesai</strong><br>
                            Pemberian pakan pagi Kolam 1 berhasil.
                        </div>
                    </div>
                    <div class="notif-item">
                        <div class="notif-dot" style="background: var(--accent-green)"></div>
                        <div>
                            <strong>Jadwal Selesai</strong><br>
                            Pemberian pakan secara otomatif jam 4 sore
                        </div>
                    </div>

                    <div class="notif-item">
                        <div class="notif-dot" style="background: var(--accent-green)"></div>
                        <div>
                            <strong>Jadwal Selesai</strong><br>
                            Pemberian pakan secara manual jam 6 pagi
                        </div>
                    </div>

                    <div class="notif-item">
                        <div class="notif-dot" style="background: var(--accent-red)"></div>
                        <div>
                            <strong>Jadwal Selesai</strong><br>
                            kolam 1 mendeteksi 25 NTU
                        </div>
                    </div>
                    
                </div>
            </div>
        </header>

        <!-- PAGE: BERANDA -->
        <section id="beranda" class="page active">
            <div class="dashboard-grid">
                <!-- Kolam 1 -->
                <div class="card">
                    <div class="kolam-img">
                        <span class="tag-kolam">Kolam Utama</span>
                        <img src="cupang1.webp">
                    </div>
                    <div class="card-header">
                        <h3>Kolam 1</h3>
                        <i data-lucide="waves"></i>
                    </div>
                    <div class="stat-row">
                        <div class="stat-box">
                            <span class="stat-label">NEXT</span>
                            <span class="stat-val">17.15</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-label">pH</span>
                            <span class="stat-val green">7.5</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="live-status"><div class="dot"></div> Live Monitoring</div>
                        <!-- <a href="#" class="btn-detail">DETAIL <i data-lucide="move-right" style="width:14px"></i></a> -->
                    </div>
                </div>

                <!-- Bottom Cards -->
                <div class="card bottom-card" style="background-color: #092B57">
                    <span class="card-title-sm">Peringatan</span>
                    <div style="flex:1; display:flex; align-items:center; gap:20px;">
                        <span class="warning-num">2</span>
                        <span style="font-size:18px; color:var(--text-muted)">Isu terdeteksi</span>
                    </div>
                    <i data-lucide="shield-check" class="shield-icon"></i>
                </div>

                <div class="card bottom-card">
                    <div class="card-header" style="margin-bottom:0">
                        <div>
                            <span class="card-title-sm">Acidity Levels</span>
                            <div class="card-subtitle">pH Balance</div>
                        </div>
                        <div class="icon-box" style="color:var(--accent-green)"><i data-lucide="test-tube-2"></i></div>
                    </div>
                    <div class="gauge-container">
                        <svg class="gauge-svg">
                            <circle class="gauge-bg" cx="80" cy="80" r="70"></circle>
                            <circle class="gauge-progress" cx="80" cy="80" r="70"></circle>
                        </svg>
                        <div class="gauge-text">
                            <div class="gauge-val">7.4</div>
                            <div class="gauge-label">OPTIMAL</div>
                        </div>
                    </div>
                    <div class="card-footer" style="border:none">
                        <span class="stat-label">24h Stability</span>
                        <span class="stat-label" style="color:var(--accent-green)">98.2%</span>
                    </div>
                </div>

                <div class="card bottom-card" style="background-color: #092B57">
                    <div class="card-header" style="margin-bottom:0">
                        <div>
                            <span class="card-title-sm">Jadwal Pakan</span>
                            <div class="card-subtitle">Automation</div>
                        </div>
                        <i data-lucide="shuffle"></i>
                    </div>
                    
                    <div class="automation-item">
                        <div class="icon-box"><i data-lucide="container" style="color:var(--accent-cyan)"></i></div>
                        <div>
                            <div style="font-size:14px; font-weight:700">Automatic Feeder</div>
                            <div style="font-size:10px; color:var(--text-muted)">Next: 18:30 (45g Pellets)</div>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
        </section>

        
        <!-- PAGE: PROFILE -->
            <section id="profile" class="page">
                <div class="profile-card">
                    <div class="profile-left">
                        <img src="https://lh3.googleusercontent.com/a/ACg8ocKn4Hlc5Ntn3JzA_ALHbW59BOMD5AwA_HMvyDEX3RLb7Us2d8cI=s360-c-no" class="profile-img-lg">
                        <div class="profile-actions">
                            <button class="btn btn-edit">Edit Profil</button>
                            <button class="btn btn-logout" onclick="handleLogout()">Logout</button>
                        </div>
                    </div>
                    <div class="profile-right">
                        <h2>Muhammad iqbal taufiqqurrahman</h2>
                        <p>Pemilik Koi Farm & Kolektor Ikan Koi</p>
                        
                        <div class="info-grid">
                            <div class="info-item"><label>Email</label><span>roses.koi@farm.com</span></div>
                            <div class="info-item"><label>Telepon</label><span>+62 812-3456-7890</span></div>
                            <div class="info-item"><label>Lokasi</label><span>Jember, Jawa Timur</span></div>
                        </div>

                        <div style="background:#f8fafc; padding:20px; border-radius:20px; border:1px solid #e2e8f0">
                            <h4 style="color:var(--sidebar-bg); margin-bottom:10px">Statistik Akun</h4>
                            <div style="display:flex; gap:30px">
                                <div><small style="color:#94a3b8">Total Kolam</small><div style="font-weight:800; color:var(--sidebar-bg)">3 Unit</div></div>
                                <div><small style="color:#94a3b8">Waktu Aktif</small><div style="font-weight:800; color:var(--sidebar-bg)">124 Hari</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <!-- PAGE: MONITORING PH -->
        <section id="monitoring" class="page">
            <h1 style="color: var(--sidebar-bg); font-size: 36px; margin-bottom: 10px;">Monitoring pH</h1>
            <p style="color: #64748b; margin-bottom: 30px;">Manajemen pH dan log aktivitas pemeriksaan secara real-time untuk ekosistem koi Anda.</p>

            <div class="ph-grid">
                <!-- Kolam 1 (Normal) -->
                <div class="ph-card" style="background-color: #092B57">
                    <div class="ph-card-header">
                        <div>
                            <h3>Kolam 1</h3>
                            <p>Kejernihan : 75%</p>
                        </div>
                        <i data-lucide="waves" class="wave-icon"></i>
                    </div>
                    <div class="ph-content-row">
                        <div class="ph-gauge-wrapper">
                            <div class="ph-circle normal">7.5</div>
                        </div>
                        <div class="ph-stats-side">
                            <span class="label-small">Terakhir Makan</span>
                            <span class="val-small">07:00</span>
                            <span class="label-small">Kondisi Air</span>
                            <span class="condition">Sangat Jernih</span>
                        </div>
                    </div>
                    <button class="btn-instant-feed" onclick="instantFeed('Kolam 1')">Beri makan instan</button>
                </div>

            </div>
        </section>

        <!-- PAGE: STOK & RIWAYAT -->
        <section id="stok" class="page">
            <h1 style="color: var(--sidebar-bg); font-size: 36px; margin-bottom: 10px;">Stok & Riwayat</h1>
            <p style="color: #64748b; margin-bottom: 35px; max-width: 600px;">Manajemen persediaan pakan dan log aktivitas pemberian makan real-time untuk ekosistem koi Anda.</p>

            <div class="stok-layout">
                
                <!-- Kartu Status Stok (Kiri) -->
                <div class="stok-status-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                        <h3 style="font-size: 22px;">Status Stok</h3>
                        <i data-lucide="box" style="color: var(--accent-green)"></i>
                    </div>

                    <!-- Aquarium 1 -->
                    <div class="stok-item">
                        <div class="stok-info-top">
                            <span>Aquarium 1</span>
                            <span class="percent">85%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 85%; background: var(--accent-cyan);"></div>
                        </div>
                        <div class="stok-info-bottom" style="color: var(--text-muted);">Estimasi Habis: 12 Hari</div>
                    </div>

                    <!-- Aquarium 2 -->
                    <div class="stok-item">
                        <div class="stok-info-top">
                            <span>Aquarium 2</span>
                            <span class="percent" style="color: var(--accent-red)">12%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 12%; background: var(--accent-red);"></div>
                        </div>
                        <div class="stok-info-bottom" style="color: var(--accent-red);">Stok Kritis!</div>
                    </div>

                    <div class="stok-item">
                        <div class="stok-info-top">
                            <span>Aquarium 3</span>
                            <span class="percent" style="color: var(--accent-cyan)">42%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 42%; background: var(--accent-green);"></div>
                        </div>
                        <div class="stok-info-bottom" style="color: var(--accent-green);">Segera Isi Ulang</div>
                    </div>

                    <div class="stok-item">
                        <div class="stok-info-top">
                            <span>Aquarium 4</span>
                            <span class="percent" style="color: var(--accent-red)">12%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 12%; background: var(--accent-red);"></div>
                        </div>
                        <div class="stok-info-bottom" style="color: var(--accent-red);">Stok Kritis!</div>
                    </div>

                    <div class="stok-item">
                        <div class="stok-info-top">
                            <span>Aquarium 5</span>
                            <span class="percent" style="color: var(--accent-cyan)">42%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 42%; background: var(--accent-green);"></div>
                        </div>
                        <div class="stok-info-bottom" style="color: var(--accent-green);">Segera Isi Ulang</div>
                    </div>

                    <div class="stok-item">
                        <div class="stok-info-top">
                            <span>Aquarium 6</span>
                            <span class="percent">85%</span>
                        </div>
                        <div class="progress-track">
                            <div class="progress-fill" style="width: 85%; background: var(--accent-cyan);"></div>
                        </div>
                        <div class="stok-info-bottom" style="color: var(--text-muted);">Estimasi Habis: 12 Hari</div>
                    </div>

                </div>

                <!-- Kartu Riwayat Tabel (Kanan) -->
                <div class="riwayat-tabel-card">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px;">
                        <div>
                            <h3 style="font-size: 22px;">Riwayat Pemberian</h3>
                            <p style="font-size: 12px; color: var(--text-muted);">Log aktivitas 1 hari terakhir</p>
                        </div>
                        <div style="display: flex; gap: 10px;">
                            <input type="text" class="search-box" placeholder="Cari akuarium..." onkeyup="filterTabel()" style="margin-bottom: 0;">
                            <button class="icon-btn" style="background: rgba(255,255,255,0.05); padding: 10px; border-radius: 12px;" title="Cari">
                                <i data-lucide="search" style="width: 18px; color: white;"></i>
                            </button>
                        </div>
                    </div>

                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>Waktu</th>
                                <th>Nama Kolam/Akuarium</th>
                                <th>Jenis Pakan</th>
                                <th>Jumlah (G)</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tabelRiwayat">
                            <tr>
                                <td>Hari ini, 08:30</td>
                                <td>Aquarium 1</td>
                                <td>Growth Formula</td>
                                <td>150g</td>
                                <td><span class="status-pill status-berhasil">otomatif</span></td>
                            </tr>
                            <tr>
                                <td>Hari ini, 15:19</td>
                                <td>Aquarium 5</td>
                                <td>Growth Formula</td>
                                <td>150g</td>
                                <td><span class="status-pill status-manual">Manual</span></td>
                            </tr>
                            <tr>
                                <td>Hari ini, 01:00</td>
                                <td>Aquarium 4</td>
                                <td>Growth Formula</td>
                                <td>150g</td>
                                <td><span class="status-pill status-berhasil">otomatif</span></td>
                            </tr>
                            <tr>
                                <td>Kemarin, 17:15</td>
                                <td>Aquarium 2</td>
                                <td>Wheat Germ</td>
                                <td>45g</td>
                                <td><span class="status-pill status-berhasil">otomatif</span></td>
                            </tr>
                            <tr>
                                <td>Kemarin, 08:30</td>
                                <td>Aquarium 3</td>
                                <td>Growth Formula</td>
                                <td>150g</td>
                                <td><span class="status-pill status-manual">Manual</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 30px;">
                        <span style="font-size: 12px; color: var(--text-muted);">Menampilkan 3 dari 128 data</span>
                        <div style="display: flex; gap: 10px;">
                            <button class="btn" style="padding: 8px 15px; font-size: 12px; background: rgba(255,255,255,0.05); color: white;">Sebelumnya</button>
                            <button class="btn" style="padding: 8px 15px; font-size: 12px; background: rgba(255,255,255,0.05); color: white;">Berikutnya</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Bawah -->
            <div class="bottom-stok-stats">
                <div class="stat-mini-card">
                    <span>Pemberian Hari Ini</span>
                    <h3>450g</h3>
                </div>
                <div class="stat-mini-card" style="background: var(--accent-green);">
                    <span style="color: var(--sidebar-bg)">Pemberian Bulanan</span>
                    <h3 style="color: var(--sidebar-bg)">111kg</h3>
                </div>
            </div>
        </section>

        <!-- PAGE: JADWAL-->
        <section id="jadwal" class="page">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px;">
                <div>
                    <h1 style="color: var(--sidebar-bg); font-size: 36px; margin-bottom: 5px;">Jadwal Pakan</h1>
                    <p style="color: #64748b;">Atur nutrisi ekosistem Koi Anda dengan presisi.</p>
                </div>
                <button class="btn" style="margin-top: 12px;  background: var(--accent-cyan); color: var(--sidebar-bg); padding: 15px 25px; border-radius: 15px; font-weight: 800; display: flex; align-items: center; gap: 10px;" onclick="toggleModal(true)">
                    <i data-lucide="plus"></i> Tambah Jadwal
                </button>
            </div>

            <div class="schedule-container">
                <!-- Timeline Section -->
                <div class="timeline-card">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="font-size: 20px;"><i data-lucide="calendar" style="width:18px; vertical-align:middle; margin-right:8px"></i> Timeline Hari Ini</h3>
                        <span style="font-size: 12px; background: rgba(255,255,255,0.1); padding: 5px 12px; border-radius: 20px;">Senin, 24 Mei</span>
                    </div>

                    <div class="timeline-list">
                        <div class="timeline-item">
                            <div style="display: flex; align-items: center;">
                                <div class="timeline-time">07:00 <small style="font-size: 10px; color: var(--text-muted)">WIB</small></div>
                                <div>
                                    <div style="font-weight: 700;">Pakan Pagi (Kolam 1)</div>
                                    <div style="font-size: 11px; color: var(--text-muted)">Dosis: 150g • Suhu Ideal: 24°C</div>
                                </div>
                            </div>
                            <div style="display: flex; gap: 10px;">
                                <i data-lucide="edit-3" style="width: 16px; cursor: pointer;"></i>
                                <i data-lucide="trash-2" style="width: 16px; cursor: pointer; color: var(--accent-red)"></i>
                            </div>
                        </div>

                        <div class="timeline-item" style="border: 1px solid var(--accent-cyan); background: rgba(0, 229, 255, 0.05);">
                            <div style="display: flex; align-items: center;">
                                <div class="timeline-time">12:30 <small style="font-size: 10px; color: var(--text-muted)">WIB</small></div>
                                <div>
                                    <div style="font-weight: 700;">Pakan Siang (Kolam 2)</div>
                                    <div style="font-size: 11px; color: var(--text-muted)">Dosis: 100g • Multi-vitamin Mix</div>
                                </div>
                            </div>
                            <span style="background: var(--accent-green); color: var(--sidebar-bg); font-size: 10px; padding: 4px 10px; border-radius: 6px; font-weight: 800;">Siap</span>
                        </div>

                        <div class="timeline-item">
                            <div style="display: flex; align-items: center;">
                                <div class="timeline-time">18:00 <small style="font-size: 10px; color: var(--text-muted)">WIB</small></div>
                                <div>
                                    <div style="font-weight: 700;">Pakan Malam (Kolam 3)</div>
                                    <div style="font-size: 11px; color: var(--text-muted)">Dosis: 80g • Easy Digest</div>
                                </div>
                            </div>
                            <i data-lucide="edit-3" style="width: 16px; cursor: pointer;"></i>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Pakan Section -->
                <div class="history-card">
                    <h3 style="font-size: 20px; margin-bottom: 25px;"><i data-lucide="history" style="width:18px; vertical-align:middle; margin-right:8px"></i> Riwayat Pakan</h3>
                    
                    <div class="history-item">
                        <div style="font-size: 10px; color: var(--accent-cyan); font-weight: 700; margin-bottom: 5px;">SUKSES - 07:02 AM</div>
                        <div style="font-weight: 700; font-size: 13px;">Auto-Feeder: Pakan Pagi</div>
                        <div style="font-size: 11px; color: var(--text-muted)">Dispensed: 152g (Auto-corrected)</div>
                    </div>

                    <div class="history-item">
                        <div style="font-size: 10px; color: var(--accent-cyan); font-weight: 700; margin-bottom: 5px;">SUKSES - 18:15 PM</div>
                        <div style="font-weight: 700; font-size: 13px;">Manual: Pakan Malam</div>
                        <div style="font-size: 11px; color: var(--text-muted)">Dispensed: 80g • Oleh: User Admin</div>
                    </div>

                    <div class="history-item fail">
                        <div style="font-size: 10px; color: var(--accent-red); font-weight: 700; margin-bottom: 5px;">GAGAL - 12:30 PM</div>
                        <div style="font-weight: 700; font-size: 13px;">Auto-Feeder: Pakan Siang</div>
                        <div style="font-size: 11px; color: var(--text-muted)">Error: Sensor pakan tersumbat</div>
                    </div>

                    <div class="history-item">
                        <div style="font-size: 10px; color: var(--accent-cyan); font-weight: 700; margin-bottom: 5px;">SUKSES - 07:02 AM</div>
                        <div style="font-weight: 700; font-size: 13px;">Auto-Feeder: Pakan Pagi</div>
                        <div style="font-size: 11px; color: var(--text-muted)">Dispensed: 152g (Auto-corrected)</div>
                    </div>

                    <div style="text-align: center; margin-top: 20px;">
                        <span style="font-size: 12px; color: var(--text-muted); cursor: pointer;">Lihat Semua Riwayat</span>
                    </div>
                </div>
            </div>

            <!-- Sisa Stok Mini Cards -->
            <div style="display: flex; gap: 20px;">
                <div class="card" style="flex: 1; background: #dbeafe; color: #1e40af; display: flex; align-items: center; gap: 20px; padding: 20px;">
                    <div style="background: white; width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center;"><i data-lucide="archive"></i></div>
                    <div>
                        <div style="font-size: 10px; text-transform: uppercase;">Sisa Stok Pakan</div>
                        <div style="font-size: 24px; font-weight: 800;">4.2 <small style="font-size: 14px">kg</small></div>
                    </div>
                </div>
                <div class="card" style="flex: 1; background: #dcfce7; color: #166534; display: flex; align-items: center; gap: 20px; padding: 20px;">
                    <div style="background: white; width: 45px; height: 45px; border-radius: 12px; display: flex; align-items: center; justify-content: center;"><i data-lucide="check-circle"></i></div>
                    <div>
                        <div style="font-size: 10px; text-transform: uppercase;">Target Hari Ini</div>
                        <div style="font-size: 24px; font-weight: 800;">33% <small style="font-size: 14px">selesai</small></div>
                    </div>
                </div>
            </div>

            <!-- Articles -->
            <div class="article-grid">
                <div class="article-card">
                    <img src="https://images.unsplash.com/photo-1517361265-3bd77c6f1689?q=80&w=1171&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                    <span style="background: var(--accent-cyan); color: var(--sidebar-bg); font-size: 10px; padding: 4px 10px; border-radius: 5px; width: fit-content; margin-bottom: 10px;">TIPS NUTRISI</span>
                    <h4 style="font-size: 18px;">Suhu Air & Porsi Pakan</h4>
                    <p style="font-size: 11px; opacity: 0.8;">Pelajari cara menyesuaikan porsi pakan berdasarkan suhu air kolam.</p>
                </div>
                <div class="article-card">
                    <img src="https://media.istockphoto.com/id/2175380330/photo/hand-holding-fish-food-for-feeding-koi-fish-in-the-natural-pond.webp?a=1&b=1&s=612x612&w=0&k=20&c=TtnpK0PfFh_1FUVXvPb8cFn0Mn3h7Pb-eeXxZ9Arvrk=">
                    <span style="background: var(--accent-green); color: var(--sidebar-bg); font-size: 10px; padding: 4px 10px; border-radius: 5px; width: fit-content; margin-bottom: 10px;">UPDATE STOK</span>
                    <h4 style="font-size: 18px;">Beli Pakan Premium</h4>
                    <p style="font-size: 11px; opacity: 0.8;">Stok High Growth menipis. Pesan sekarang melalui marketplace resmi.</p>
                </div>
            </div>
        </section>

        <!-- MODAL TAMBAH JADWAL BARU -->
        <div class="modal-overlay" id="addScheduleModal">
            <div class="modal-content">
                <h2 style="font-size: 28px;">Tambah Jadwal Baru</h2>
                <p style="color: #64748b; font-size: 14px;">Atur presisi nutrisi untuk ekosistem Koi Anda.</p>

                <div class="form-grid">
                    <div class="input-group">
                        <label><i data-lucide="clock" style="width: 14px; vertical-align: middle;"></i> Waktu Pemberian Pakan</label>
                        <input type="time" value="08:00">
                    </div>
                    <div class="input-group">
                        <label><i data-lucide="target" style="width: 14px; vertical-align: middle;"></i> Target Dispenser</label>
                        <select>
                            <option>Kolam 1</option>
                            <option>Kolam 2</option>
                            <option>Kolam 3</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label><i data-lucide="layers" style="width: 14px; vertical-align: middle;"></i> Jenis Pakan</label>
                        <select>
                            <option>Growth Formula</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label><i data-lucide="scale" style="width: 14px; vertical-align: middle;"></i> Takaran (Gram)</label>
                        <div style="position: relative;">
                            <input type="number" placeholder="500">
                            <span style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-weight: 700;">gr</span>
                        </div>
                    </div>
                </div>

                <div class="input-group">
                    <label><i data-lucide="repeat" style="width: 14px; vertical-align: middle;"></i> Pengulangan Jadwal</label>
                    <div class="days-row">
                        <div class="day-chip active">SEN</div>
                        <div class="day-chip active">SEL</div>
                        <div class="day-chip active">RAB</div>
                        <div class="day-chip active">KAM</div>
                        <div class="day-chip active">JUM</div>
                        <div class="day-chip">SAB</div>
                        <div class="day-chip">MIN</div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn-cancel" onclick="toggleModal(false)">Batal</button>
                    <button class="btn-save" onclick="saveNewSchedule()">Simpan Jadwal</button>
                </div>
            </div>
        </div>

        <!-- Other Placeholder Pages -->
        <section id="monitoring" class="page"><h1 style="color:#061a37">Monitoring pH Detail</h1></section>
        <section id="stok" class="page"><h1 style="color:#061a37">Manajemen Stok Pakan</h1></section>
        <section id="jadwal" class="page"><h1 style="color:#061a37">Pengaturan Jadwal</h1></section>

    </main>

    <script>
    // Inisialisasi Icon Lucide
    lucide.createIcons();

    // Fungsi Navigasi Halaman
    function showPage(pageId, element) {
        // Sembunyikan semua halaman
        document.querySelectorAll('.page').forEach(page => page.classList.remove('active'));
        // Tampilkan halaman target
        document.getElementById(pageId).classList.add('active');

        // Update status Sidebar
        if(element) {
            document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
            element.classList.add('active');
        }
        
        // Tutup popup notif jika pindah halaman
        document.getElementById('notifPopup').style.display = 'none';
    }

    // Toggle Notifikasi
    function togglePopup(id) {
        const popup = document.getElementById(id);
        popup.style.display = (popup.style.display === 'block') ? 'none' : 'block';
    }

    // Fungsi Logout
    function handleLogout() {
        if(confirm("Apakah Anda yakin ingin keluar dari sistem AIIRRR?")) {
            window.location.href = "login";
        }
    }

    // Close popup clicking outside
    window.onclick = function(event) {
        if (!event.target.closest('.header-actions')) {
            const notifPopup = document.getElementById('notifPopup');
            if (notifPopup) notifPopup.style.display = 'none';
        }
    }

    // Fungsi Beri Makan Instan
    function instantFeed(kolamName) {
        alert("Instruksi dikirim: Memberi makan instan ke " + kolamName + ". Dispenser diaktifkan!");
    }

    // Fungsi untuk membuka/menutup modal
    function toggleModal(show) {
        const modal = document.getElementById('addScheduleModal');
        if (modal) modal.style.display = show ? 'flex' : 'none';
    }

    // Handler klik pada chip hari agar bisa toggle aktif/mati
    document.querySelectorAll('.day-chip').forEach(chip => {
        chip.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    });

    // Simpan Jadwal (Simulasi)
    function saveNewSchedule() {
        alert("Jadwal pakan baru berhasil disimpan ke sistem!");
        toggleModal(false);
    }

    // Tutup modal jika user klik di luar area konten modal
    window.addEventListener('click', function(e) {
        const modal = document.getElementById('addScheduleModal');
        if (e.target === modal) {
            toggleModal(false);
        }
    });

    // Fungsi Filter Tabel Riwayat
    function filterTabel() {
        const inputElement = document.getElementById('inputPencarian');
        const tbody = document.getElementById('tabelRiwayat');
        
        if (!inputElement || !tbody) return;

        const input = inputElement.value.toLowerCase();
        const rows = tbody.getElementsByTagName('tr');
        
        for (let i = 0; i < rows.length; i++) {
            const rowText = rows[i].textContent.toLowerCase();
            if (rowText.includes(input)) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none"; // Diperbaiki dari typo "rowns[i].stayle.display"
            }
        }
    }

    function jalakanpencarianButton() {
        filterTabel(); // Disesuaikan dengan nama fungsi yang benar
    }

    // Efek Scroll Header (Glassy)
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (header) {
            if (window.scrollY > 20) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }
    });
</script>
</body>
</html>