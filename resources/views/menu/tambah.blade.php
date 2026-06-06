<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Baru - Kantin Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-main: #f1f5f9; /* Latar belakang abu-abu terang yang solid */
            --text-heading: #0f172a; /* Warna tulisan utama yang sangat tegas */
            --text-body: #334155;
            --primary-color: #2563eb; 
            --transition-speed: 0.2s;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-body);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 20px;
        }

        /* --- ANIMASI MASUK --- */
        @keyframes containerPop {
            from { opacity: 0; transform: scale(0.98); }
            to { opacity: 1; transform: scale(1); }
        }

        /* --- FORM CONTAINER MEWAH & PROPORSIONAL --- */
        .form-container {
            max-width: 850px; /* Diperlebar agar tidak menumpuk ke bawah */
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 24px; /* Sudut lebih melengkung halus */
            padding: 45px;
            box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.08), 0 10px 10px -5px rgba(15, 23, 42, 0.04);
            animation: containerPop 0.3s ease-out forwards;
        }

        .header-section {
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 20px;
            margin-bottom: 35px;
        }

        .form-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-heading);
            letter-spacing: -0.5px;
        }

        /* --- DESAIN INPUT & FORMAT TULISAN JELAS --- */
        .form-label {
            color: var(--text-heading);
            font-size: 0.95rem;
            font-weight: 700; /* Tulisan label dibuat tebal dan sangat jelas */
            margin-bottom: 10px;
            display: block;
        }

        .form-control, .form-select {
            border: 2px solid #e2e8f0; /* Border lebih tebal agar tegas */
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-heading);
            background-color: #f8fafc;
            transition: all var(--transition-speed) ease;
        }

        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
            color: #000000;
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        /* Kolom khusus tanggal (Readonly) */
        .form-control[readonly] {
            background-color: #f1f5f9 !important;
            border-color: #e2e8f0;
            color: #64748b;
            font-weight: 600;
        }

        /* --- TOMBOL AKSI MENARIK KONTEMPORER --- */
        .action-box {
            border-top: 2px solid #f1f5f9;
            padding-top: 30px;
            margin-top: 20px;
        }

        .btn-save {
            background-color: var(--primary-color);
            color: #ffffff;
            font-weight: 800;
            font-size: 1rem;
            border-radius: 14px;
            padding: 16px 32px;
            border: none;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
        }

        .btn-save:hover {
            background-color: #1d4ed8;
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
            transform: translateY(-2px);
        }

        .btn-cancel {
            background-color: #ffffff;
            color: #64748b;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 14px;
            padding: 16px 32px;
            border: 2px solid #e2e8f0;
            text-decoration: none;
            text-align: center;
            transition: all var(--transition-speed) ease;
        }

        .btn-cancel:hover {
            background-color: #f8fafc;
            color: #0f172a;
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
    <div class="form-container w-100">
        
        <div class="header-section">
            <h4 class="form-title">Tambah Hidangan Baru</h4>
            <p class="text-muted small mb-0">Masukkan detail hidangan jualan kantin Anda dengan benar sesuai standar LKS.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger border-0 mb-4" style="border-left: 5px solid #ef4444 !important; border-radius: 14px; background-color: #fef2f2; color: #991b1b; padding: 20px;">
                <div class="fw-bold mb-2" style="font-size: 0.95rem;">Periksa kembali isian Anda:</div>
                <ul class="mb-0 small" style="padding-left: 20px; font-weight: 600;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('menu.simpan') }}" method="POST">
            @csrf
            
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="mb-4">
                        <label class="form-label">Nama Hidangan</label>
                        <input type="text" name="nama_menu" class="form-control" placeholder="Ayam Goreng Kremes" value="{{ old('nama_menu') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Kategori Menu</label>
                        <select name="kategori_menu" class="form-select" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="Makanan" {{ old('kategori_menu') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="Minuman" {{ old('kategori_menu') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                            <option value="Snack" {{ old('kategori_menu') == 'Snack' ? 'selected' : '' }}>Snack</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Status Ketersediaan</label>
                        <select name="status_menu" class="form-select" required>
                            <option value="Tersedia" {{ old('status_menu') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="Habis" {{ old('status_menu') == 'Habis' ? 'selected' : '' }}>Tidak Tersedia (Habis)</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="row g-3 mb-4">
                        <div class="col-sm-6">
                            <label class="form-label">Harga Jual (Rp)</label>
                            <input type="number" name="harga" class="form-control" placeholder="15000" min="0" value="{{ old('harga') }}" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Stok Awal</label>
                            <input type="number" name="stok" class="form-control" placeholder="20" min="0" value="{{ old('stok') }}" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tanggal Input Sistem</label>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                        <div class="form-text small text-muted mt-2" style="font-weight: 500;">Tanggal dicatat otomatis oleh sistem hari ini.</div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label">Deskripsi Kuliner (Opsional)</label>
                        <textarea name="deskripsi" class="form-control" rows="5" placeholder="Tulis deskripsi singkat porsi, rasa, atau racikan hidangan..." style="resize: none;">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="action-box">
                <div class="row g-3 justify-content-end">
                    <div class="col-sm-3 col-6">
                        <a href="{{ route('menu.index') }}" class="btn btn-cancel w-100">Batal</a>
                    </div>
                    <div class="col-sm-4 col-6">
                        <button type="submit" class="btn btn-save w-100">Simpan Menu</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>