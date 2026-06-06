<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu; // Pastikan nama model Menu kamu sudah benar
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data penjual/user yang sedang login
        $penjual = Auth::user(); 

        // 2. Hitung statistik menu sesuai kiriman data di blade
        $totalMenu = Menu::where('user_id', $penjual->id)->count();
        
        $totalTersedia = Menu::where('user_id', $penjual->id)
                             ->where('stok', '>', 0)
                             ->count();
                             
        $totalHabis = Menu::where('user_id', $penjual->id)
                           ->where('stok', '=', 0)
                           ->count();

        // 3. Ambil 5 data hidangan terbaru (Diubah ke 'id' agar urutan input selalu akurat)
        $menus = Menu::where('user_id', $penjual->id)
                     ->orderBy('id', 'desc') 
                     ->take(5)
                     ->get();

        // 4. Oper semua variabel ke view dashboard.blade.php
        return view('dashboard', compact('penjual', 'totalMenu', 'totalTersedia', 'totalHabis', 'menus'));
    }
}