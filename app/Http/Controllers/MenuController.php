<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    // ==========================================
    // HALAMAN UTAMA KELOLA MENU (DENGAN SEARCH & PAGINATION 10)
    // ==========================================
    public function indexMenu(Request $request) {
        $penjual = Auth::user();
        
        // Ambil data kata kunci dari form pencarian text input
        $search = $request->input('search');

        // Query dasar mengunci kepemilikan menu berdasarkan user_id login [cite: 121]
        $query = Menu::where('user_id', $penjual->id);

        // Logika filter pencarian nama menu jika input terisi
        if ($search) {
            $query->where('nama_menu', 'LIKE', "%{$search}%");
        }

        // Batasi data maksimal 10 per halaman menggunakan paginate()
        $all_menus = $query->orderBy('id', 'DESC')->paginate(10);

        return view('menu.index', compact('penjual', 'all_menus'));
    }

    // ==========================================
    // FITUR TAMBAH DATA UTAMA
    // ==========================================
    public function showTambahMenu() {
        return view('menu.tambah');
    }

    public function simpanMenu(Request $request) {
        // Validasi data masukan form sesuai kriteria lembar soal 
        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'kategori_menu' => 'required|in:Makanan,Minuman,Snack', 
            'status_menu' => 'required|in:Tersedia,Habis', // Memenuhi syarat input status menu 
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $menu = new Menu();
        $menu->user_id = Auth::id(); // Mengikat kepemilikan data ke user yang sedang login [cite: 117]
        $menu->nama_menu = $request->nama_menu;
        $menu->kategori_menu = $request->kategori_menu;
        $menu->harga = $request->harga;
        $menu->stok = $request->stok;

        // LOGIKA PENGAMAN CERDAS:
        // Jika user mengisi stok 0, maka otomatis dipaksa 'Habis'.
        // Jika stok lebih dari 0, sistem akan mengikuti pilihan dari form HTML (bisa Tersedia / Habis).
        if ($request->stok == 0) {
            $menu->status_menu = 'Habis';
        } else {
            $menu->status_menu = $request->status_menu;
        }

        $menu->deskripsi = $request->deskripsi;
        $menu->tanggal_input = now()->toDateString(); 
        $menu->save(); 

        return redirect()->route('menu.index')->with('success', 'Menu hidangan baru berhasil ditambahkan ke daftar kerja!');
    }

    // ==========================================
    // PROTEKSI KEAMANAN EDIT & UPDATE [cite: 123]
    // ==========================================
    public function showEditMenu($id) {
        // Cari data berdasarkan id data DAN user_id penjual yang sedang aktif login [cite: 124]
        $menu = Menu::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$menu) {
            return redirect()->route('menu.index')->withErrors(['error' => 'Data tidak ditemukan atau Anda tidak memiliki akses ke menu tersebut.']); 
        }

        return view('menu.edit', compact('menu'));
    }

    public function updateMenu(Request $request, $id) {
        // Pastikan proses update terkunci hanya pada milik user login [cite: 125]
        $menu = Menu::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$menu) {
            return redirect()->route('menu.index')->withErrors(['error' => 'Gagal mengubah data. Akses ditolak!']); 
        }

        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'kategori_menu' => 'required|in:Makanan,Minuman,Snack',
            'status_menu' => 'required|in:Tersedia,Habis',
            'harga' => 'required|integer|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        $menu->nama_menu = $request->nama_menu;
        $menu->kategori_menu = $request->kategori_menu;
        $menu->harga = $request->harga;
        $menu->stok = $request->stok;

        // Logika pengaman cerdas yang sama untuk proses update data
        if ($request->stok == 0) {
            $menu->status_menu = 'Habis';
        } else {
            $menu->status_menu = $request->status_menu;
        }

        $menu->deskripsi = $request->deskripsi;
        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Data menu hidangan berhasil diperbarui!');
    }

    // ==========================================
    // PROTEKSI PROSES HAPUS (DELETE) [cite: 123]
    // ==========================================
    public function hapusMenu($id) {
        // Amankan proses hapus menggunakan kondisi WHERE double id [cite: 126]
        $menu = Menu::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$menu) {
            return redirect()->route('menu.index')->withErrors(['error' => 'Gagal menghapus data. Akses ditolak!']); 
        }

        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu hidangan telah berhasil dihapus dari sistem!');
    }
}