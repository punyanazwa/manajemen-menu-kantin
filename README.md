# Manajemen Menu Kantin

Projek aplikasi berbasis web menggunakan Framework Laravel untuk mengelola menu makanan dan laporan penjualan di kantin.

---

## Fitur
- Login dan logout memakai session.
- Register penjual kantin.
- Password disimpan memakai `password_hash()`.
- Dashboard ringkasan menu milik user login.
- CRUD menu makanan, minuman, dan snack.
- Keamanan edit, update, dan hapus memakai kondisi `id` + `user_id`.
- Filter data berdasarkan akun login melalui `user_id`.
- Laporan daftar menu yang bisa dicetak dengan `window.print()`
- UI responsif untuk laptop dan HP dan lain-lain.

---

### Akun Testing
Gunakan 2 akun ini untuk menguji bahwa data penjualan A tidak sama dengan B:

**Akun 1:**
* Email: `nazwa@gmail.com`
* Password: `nazwa123`

**Akun 2:**
* Email: `zulfa@gmail.com`
* Password: `zulfa123`


## 🛠️ Cara Menjalankan Projek
### 1. Clone Repository
Unduh projek ini ke komputer Anda dengan perintah:
```bash
git clone https://github.com/punyanazwa/manajemen-menu-kantin.git
cd manajemen-menu-kantin

### 2. Install Dependency
Unduh semua library PHP yang dibutuhkan oleh Laravel:
```bash
composer install

3.Salin File Konfigurasi .env
Duplikat file .env.example menjadi .env:
Bash
cp .env.example .env

4. Buat Application Key
Generate kunci keamanan untuk aplikasi Laravel:
Bash
php artisan key:generate

5. Konfigurasi Database
Buka file .env yang baru dibuat, lalu sesuaikan dengan database Anda. Jika menggunakan SQLite, ubah bagian database menjadi:
Cuplikan kode
DB_CONNECTION=mysql

6. Jalankan Database Migration
Buat semua tabel yang diperlukan di dalam database:
Bash
php artisan migrate

7. Jalankan Server
Nyalakan server lokal Laravel:
Bash
php artisan serve
Setelah menyala, buka browser dan akses tautan berikut:
 http://127.0.0.1:8000


