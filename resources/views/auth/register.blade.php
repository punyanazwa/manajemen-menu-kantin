<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Penjual - Kantin Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Pengaturan tema latar belakang selaras dengan Login & Dashboard */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #111827 0%, #1f2937 40%, #f4f6f9 40%, #f4f6f9 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow-x: hidden;
            padding: 40px 0;
        }

        /* Animasi masuk halaman */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-container {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Desain kartu register modern premium */
        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            background-color: #ffffff;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px rgba(15, 23, 42, 0.12) !important;
        }

        /* Desain logo lingkaran di bagian atas */
        .logo-wrapper {
            width: 65px;
            height: 65px;
            background-color: #111827;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px auto;
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.2);
        }

        .logo-wrapper i {
            font-size: 1.8rem;
            color: #fbbf24; /* Emas menyala khas identitas sistem */
        }

        /* Judul teks register */
        .register-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .register-subtitle {
            font-size: 0.9rem;
            color: #64748b;
        }

        /* Komponen Form dengan tulisan diperjelas (hitam pekat & tebal) */
        .form-label {
            font-weight: 700;
            color: #000000; 
            font-size: 0.95rem;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 14px;
            padding: 12px 16px;
            border: 1.5px solid #cbd5e1;
            background-color: #f8fafc;
            color: #000000 !important; /* Teks ketikan hitam pekat */
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.25s ease;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: #2563eb; /* Fokus warna biru premium */
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
            outline: none;
        }

        /* Tombol daftar dengan gaya komponen utama */
        .btn-custom {
            background-color: #2563eb;
            border: none;
            color: white;
            padding: 14px;
            border-radius: 14px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        .btn-custom:hover {
            background-color: #1d4ed8;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        }

        .btn-custom:active {
            transform: translateY(1px);
        }

        /* Pembatas dan Tautan kembali ke login */
        hr {
            border-top: 1.5px solid #e2e8f0;
            opacity: 1;
            margin: 25px 0 20px 0;
        }

        .login-text {
            font-size: 0.95rem;
            color: #000000;
            font-weight: 600;
        }

        .login-link {
            color: #2563eb;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s ease;
        }

        .login-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 register-container">
                
                <div class="card card-custom p-2">
                    <div class="card-body p-4">
                        
                        <div class="text-center mb-4">
                            <div class="logo-wrapper">
                                <i class="fa-solid fa-utensils"></i>
                            </div>
                            <h4 class="register-title mb-1">Daftar Akun Penjual</h4>
                            <p class="register-subtitle">Bergabunglah untuk mulai mengelola menu kantin</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4" style="background-color: #fee2e2; color: #991b1b; font-weight: 600;">
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ url('/register') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password (Minimal 6 karakter)</label>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                            </div>

                            <button type="submit" class="btn btn-custom w-100">
                                Daftar Sekarang <i class="fa-solid fa-user-plus ms-2"></i>
                            </button>
                        </form>
                        
                        <hr>
                        
                        <p class="text-center mb-0 login-text">
                            Sudah punya akun? <a href="{{ url('/login') }}" class="login-link">Login di sini</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>