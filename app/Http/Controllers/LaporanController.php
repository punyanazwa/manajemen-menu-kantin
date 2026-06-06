<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    // 1. Halaman Preview Laporan (Mendukung Pencarian & Pagination)
    public function indexLaporan(Request $request)
    {
        $penjual = Auth::user();
        $search = $request->input('search');

        // Hitung total menu murni milik penjual ini
        $totalMenu = Menu::where('user_id', $penjual->id)->count();

        // Ambil data menu dengan filter pencarian jika ada
        $query = Menu::where('user_id', $penjual->id);

        if ($search) {
            $query->where('nama_menu', 'like', '%' . $search . '%');
        }

        // Menggunakan nama variabel $all_menus dan pagination (misal 10 data per halaman)
        $all_menus = $query->orderBy('nama_menu', 'asc')->paginate(10);

        return view('laporan.index', compact('penjual', 'totalMenu', 'all_menus'));
    }

    // 2. Halaman Cetak (Menampilkan semua tanpa pagination agar tercetak utuh)
    public function cetakLaporan()
    {
        $penjual = Auth::user();
        
        $totalMenu = Menu::where('user_id', $penjual->id)->count();
        
        // Menggunakan nama variabel $menus untuk halaman cetak polosan
        $menus = Menu::where('user_id', $penjual->id)
                     ->orderBy('nama_menu', 'asc')
                     ->get();

        return view('laporan.cetak', compact('penjual', 'totalMenu', 'menus'));
    }
}