<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Kelola Menu - Kantin Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            --bg-main: #f4f6f9; 
            --text-main: #1e293b;
            --text-muted: #64748b; 
            --sidebar-width: 280px;
            --transition-speed: 0.25s;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            -webkit-text-size-adjust: 100%; /* Mencegah auto-resize text di iOS */
        }

        @keyframes fadeInPage {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-page {
            animation: fadeInPage 0.4s ease-out forwards;
        }

        /* --- TOP NAVBAR MOBILE --- */
        .mobile-header {
            display: none;
            background-color: #111827;
            padding: 15px 20px;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1050;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .mobile-header .brand span {
            font-size: 1.2rem;
            font-weight: 800;
            color: #ffffff;
        }

        .mobile-header .brand i {
            color: #fbbf24;
            margin-right: 8px;
        }

        .btn-toggle-sidebar {
            background: none;
            border: none;
            color: #ffffff;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* --- SIDEBAR (NAVBAR SAMPING) --- */
        .sidebar {
            width: var(--sidebar-width);
            background-color: #111827; 
            border-right: 1px solid #1f2937;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1100;
            padding: 35px 20px;
            transition: transform var(--transition-speed) ease;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 10px;
            margin-bottom: 50px;
        }

        .sidebar-brand i {
            font-size: 1.6rem;
            color: #fbbf24; 
        }

        .sidebar-brand span {
            font-size: 1.4rem;
            font-weight: 800;
            color: #ffffff; 
            letter-spacing: -0.5px;
        }

        .sidebar-menu-wrapper {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-item {
            margin-bottom: 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 14px 18px;
            color: #9ca3af; 
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            border-radius: 12px;
            transition: all var(--transition-speed) ease;
            position: relative;
        }

        .sidebar-link i {
            margin-right: 14px;
            font-size: 1.15rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-link:hover {
            color: #ffffff;
            background-color: #1f2937; 
        }

        .sidebar-link.active {
            background-color: #2563eb; 
            color: #ffffff;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 25%;
            height: 50%;
            width: 4px;
            background-color: #ffffff;
            border-radius: 0 4px 4px 0;
        }

        .sidebar-footer {
            border-top: 1px solid #1f2937;
            padding-top: 20px;
        }
        
        .btn-logout-sidebar {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 18px;
            color: #ffffff;
            background-color: #dc2626; 
            border: none;
            font-weight: 700;
            font-size: 0.95rem;
            border-radius: 12px;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.2);
        }
        
        .btn-logout-sidebar:hover {
            background-color: #b91c1c; 
            box-shadow: 0 6px 14px rgba(220, 38, 38, 0.3);
            transform: translateY(-1px);
        }

        .btn-logout-sidebar i {
            margin-right: 10px;
        }

        /* --- OVERLAY UNTUK MOBILE --- */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1090;
        }

        /* --- KONTEN UTAMA --- */
        .main-content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            padding: 40px 45px;
            width: calc(100% - var(--sidebar-width));
        }

        .top-profile-bar {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 16px 24px;
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.01);
        }

        .panel-title-text {
            font-size: 1.25rem;
            font-weight: 700;
            color: #0f172a;
        }

        .custom-avatar-circle {
            width: 42px;
            height: 42px;
            background-color: #1e7e34; 
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.15rem;
            border-radius: 50%;
            text-transform: uppercase;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* --- TOMBOL TAMBAH MENU --- */
        .btn-add {
            background-color: #2563eb;
            color: white;
            font-weight: 700;
            border-radius: 12px;
            padding: 12px 24px;
            border: none;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
        }
        
        .btn-add:hover {
            background-color: #1d4ed8;
            color: white;
            box-shadow: 0 6px 14px rgba(37, 99, 235, 0.3);
            transform: translateY(-1px);
        }

        /* --- TABEL MENU --- */
        .card-table-wrapper {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .table-custom {
            vertical-align: middle;
            margin-top: 15px;
        }

        .table-custom thead th {
            background-color: #1e293b; 
            color: #ffffff;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 16px;
            border: none;
            white-space: nowrap;
        }

        .table-custom thead th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
        .table-custom thead th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

        .table-custom tbody tr {
            transition: background-color 0.2s ease;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }

        .table-custom tbody td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155; 
            font-size: 0.95rem;      
            font-weight: 500;   
        }

        .nowrap-column {
            white-space: nowrap;
        }

        /* Bungkus normal khusus deskripsi agar rapi ke bawah */
        .table-custom tbody td.col-deskripsi {
            white-space: normal;
            min-width: 220px;
            max-width: 300px;
            color: #64748b;
        }

        .table-custom tbody td.text-important {
            font-weight: 700;
            color: #0f172a; 
            font-size: 1rem;
        }

        /* Badge Kategori & Status Diperjelas */
        .badge-kategori {
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 0.88rem;
            font-weight: 700;
            display: inline-block;
            white-space: nowrap;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-block;
            text-align: center;
            min-width: 105px; /* Sedikit diperlebar agar seimbang */
            white-space: nowrap;
        }

        /* --- RESPONSIVE CSS (MEDIA QUERIES) --- */
        @media (max-width: 991.98px) {
            .mobile-header {
                display: flex;
            }

            .sidebar {
                transform: translateX(-100%);
                top: 0;
                bottom: 0;
                height: 100vh;
            }

            .sidebar.show {
                transform: translateX(0);
                box-shadow: 5px 0 15px rgba(0,0,0,0.2);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 24px 16px;
            }

            .top-profile-bar {
                padding: 16px;
                margin-bottom: 20px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .card-table-wrapper {
                padding: 20px 16px;
            }

            .table-custom thead th {
                padding: 12px;
                font-size: 0.85rem;
            }

            .table-custom tbody td {
                padding: 12px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>

    <div class="mobile-header">
        <div class="brand">
            <i class="fa-solid fa-utensils"></i>
            <span>Kantin Sekolah</span>
        </div>
        <button class="btn-toggle-sidebar" id="toggleSidebar">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="sidebar" id="sidebarMenu">
        <div class="sidebar-brand d-none d-lg-flex">
            <i class="fa-solid fa-utensils"></i>
            <span>Kantin Sekolah</span>
        </div>
        
        <div class="sidebar-menu-wrapper">
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <a href="/dashboard" class="sidebar-link">
                        <i class="fa-solid fa-chart-pie"></i>Dashboard
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('menu.index') }}" class="sidebar-link active">
                        <i class="fa-solid fa-bowl-food"></i>Kelola Menu
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('laporan.index') }}" class="sidebar-link">
                        <i class="fa-solid fa-file-invoice"></i>Laporan Daftar Menu
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-logout-sidebar">
                    <i class="fa-solid fa-right-from-bracket"></i>Keluar Akun
                </button>
            </form>
        </div>
    </div>

    <div class="main-content animate-page">
        
        <div class="top-profile-bar d-none d-lg-flex">
            <div class="panel-title-text">Ruang Kerja Manajemen Menu</div>
            
            <div class="d-flex align-items-center gap-3">
                <div class="custom-avatar-circle">
                    {{ substr($penjual->name, 0, 1) }}
                </div>
                
                <div class="text-start">
                    <div class="fw-bold mb-0 text-dark" style="line-height: 1.2; font-size: 1rem;">{{ $penjual->name }}</div>
                    <small class="text-muted" style="font-size: 0.8rem; font-weight: 500;"></small>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-4" style="border-left: 4px solid #10b981 !important; border-radius: 12px;">
                <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->has('error'))
            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-left: 4px solid #ef4444 !important; border-radius: 12px;">
                <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ $errors->first('error') }}
            </div>
        @endif

        <div class="card-table-wrapper">
            <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
                <div>
                    <h5 class="fw-bold mb-1" style="color: #0f172a;">Kelola Seluruh Hidangan Kuliner</h5>
                    <p class="text-muted mb-0 small">Gunakan ruang ini untuk menambah, mengubah informasi stok/harga, atau menghapus menu kantin.</p>
                </div>
                <div>
                    <a href="{{ route('menu.tambah') }}" class="btn btn-add w-100 justify-content-center">
                        <i class="fa-solid fa-plus me-2"></i>Tambah Menu Baru
                    </a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-5 col-lg-4">
                    <form action="{{ route('menu.index') }}" method="GET">
                        <div class="input-group shadow-sm">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama menu..." value="{{ request('search') }}" style="border-radius: 10px 0 0 10px; padding: 10px 15px;">
                            <button class="btn btn-primary" type="submit" style="border-radius: 0 10px 10px 0; background-color: #2563eb; border: none; padding: 0 20px;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px;" class="text-center">No</th>
                            <th>Nama Menu</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Harga Jual</th>
                            <th class="text-center" style="width: 90px;">Stok</th>
                            <th>Tanggal</th>
                            <th class="text-center" style="width: 130px;">Status</th>
                            <th class="text-center" style="width: 140px;">Aksi Berkelanjutan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($all_menus as $index => $menu)
                            <tr>
                                <td class="text-center fw-bold text-dark nowrap-column">{{ $all_menus->firstItem() + $index }}</td>
                                <td class="text-important">{{ $menu->nama_menu }}</td>
                                <td class="col-deskripsi">{{ $menu->deskripsi ?? '-' }}</td>
                                <td class="nowrap-column">
                                    <span class="badge-kategori bg-primary-subtle text-primary-emphasis border border-primary-subtle">
                                        {{ $menu->kategori_menu }}
                                    </span>
                                </td>
                                <td class="fw-bold text-dark nowrap-column">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                <td class="text-center fw-bold text-dark nowrap-column">{{ $menu->stok }}</td>
                                <td class="text-dark nowrap-column">{{ $menu->tanggal_input }}</td>
                                
                                <td class="text-center nowrap-column">
                                    @if($menu->status_menu == 'Tersedia' && $menu->stok > 0)
                                        <span class="badge-status" style="background-color: #d1fae5; color: #065f46;">Tersedia</span>
                                    @else
                                        <span class="badge-status" style="background-color: #fee2e2; color: #991b1b;">Tidak Tersedia</span>
                                    @endif
                                </td>
                                
                                <td class="text-center nowrap-column">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-sm btn-outline-warning" title="Edit Data" style="border-radius: 8px; padding: 6px 12px; font-weight: 600;">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        
                                        <form action="{{ route('menu.hapus', $menu->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda benar-benar yakin ingin menghapus hidangan ini dari sistem?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Data" style="border-radius: 8px; padding: 6px 12px; font-weight: 600;">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-5" style="font-weight: 600;">
                                    <i class="fa-solid fa-box-open d-block fs-2 mb-2 text-secondary"></i>
                                    @if(request('search'))
                                        Menu dengan kata kunci "<strong>{{ request('search') }}</strong>" tidak ditemukan.
                                    @else
                                        Anda belum memiliki data menu apa pun saat ini. Silakan klik tombol <strong>Tambah Menu Baru</strong> di atas.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $all_menus->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebarMenu = document.getElementById('sidebarMenu');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function toggleMobileMenu() {
            sidebarMenu.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        }

        if(toggleSidebar && sidebarMenu && sidebarOverlay) {
            toggleSidebar.addEventListener('click', toggleMobileMenu);
            sidebarOverlay.addEventListener('click', toggleMobileMenu);
        }
    </script>
</body>
</html>