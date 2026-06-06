<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Menu Kantin - {{ $penjual->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #334155;
            background-color: #fff;
            padding: 30px;
        }
        .header-laporan {
            border-bottom: 3px double #334155;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .table-laporan th {
            background-color: #f8fafc !important;
            color: #1e293b;
            font-weight: 600;
        }
        
        @page {
            size: auto;
            margin: 0mm; 
        }

        @media print {
            body {
                padding: 1.5cm; 
            }
            .no-print, .btn, button, a {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="container-fluid no-print mb-4 d-flex gap-2 justify-content-end">
        <a href="{{ route('laporan.index') }}" class="btn btn-secondary fw-semibold">Kembali ke Laporan</a>
        <button onclick="window.print()" class="btn btn-primary fw-semibold">Cetak Sekarang (Print)</button>
    </div>

    <div class="container-fluid">
        <div class="header-laporan text-center">
            <h3 class="fw-bold text-uppercase mb-1">Laporan Daftar Menu Kuliner</h3>
            <h5 class="fw-semibold text-secondary mb-3">Sistem Manajemen Menu Kantin Sekolah</h5>
            <div class="row text-start mt-4 g-2 small">
                <div class="col-6">
                    <strong>Nama Penjual:</strong> {{ $penjual->name }}<br> 
                    <strong>Email Akun:</strong> {{ $penjual->email }}
                </div>
                <div class="col-6 text-end">
                    <strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}<br> 
                    <strong>Status Data:</strong> Terfilter (Hak Akses Penjual)
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle table-laporan">
                <thead>
                    <tr class="text-center">
                        <th style="width: 50px;">No</th>
                        <th>Nama Menu</th> 
                        <th>Deskripsi</th> 
                        <th>Kategori</th> 
                        <th>Harga Jual</th> 
                        <th>Stok</th> 
                        <th>Status</th> 
                    </tr>
                </thead>
                <tbody>
                    @php $totalHargaSelesai = 0; @endphp

                    @forelse($menus as $index => $menu)
                        @php $totalHargaSelesai += $menu->harga; @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $menu->nama_menu }}</td>
                            <td style="color: #475569; font-size: 0.95rem;">{{ $menu->deskripsi ?? '-' }}</td>
                            <td>{{ $menu->kategori_menu }}</td>
                            <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $menu->stok }}</td>
                            <td class="text-center fw-bold">
                                @if($menu->stok > 0)
                                    <span class="text-success">Tersedia</span>
                                @else
                                    <span class="text-danger">Habis</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">Belum ada data hidangan kuliner.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="fw-bold table-light">
                        <td colspan="5" class="text-end">TOTAL HARGA JUAL MENU:</td> 
                        <td colspan="2" class="text-center text-success">Rp {{ number_format($totalHargaSelesai, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="fw-bold table-light">
                        <td colspan="5" class="text-end">TOTAL KESELURUHAN MENU:</td> 
                        <td colspan="2" class="text-center text-primary">{{ $totalMenu }} Item</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row mt-5 pt-4 text-center small">
            <div class="col-4 offset-8">
                <p class="mb-5">Penanggung Jawab,</p>
                <p class="fw-bold text-decoration-underline mb-0">{{ $penjual->name }}</p>
                <span class="text-muted">ID Penjual: #{{ $penjual->id }}</span>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>