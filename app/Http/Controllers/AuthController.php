<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6|confirmed', 
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // ==========================================
    // PANEL DASHBOARD UTAMA (MURNI READ-ONLY 5 DATA)
    // ==========================================
    public function dashboard() {
        $penjual = Auth::user(); 

        // 1. Ambil semua menu milik penjual login untuk menghitung statistik data ringkasan
        $allMenus = Menu::where('user_id', $penjual->id)->get(); 

        $totalMenu = $allMenus->count(); // Total menu milik penjual login
        
        // Menghitung status berdasarkan kolom status_menu di database
        $totalTersedia = $allMenus->where('status_menu', 'Tersedia')->count(); 
        $totalHabis = $allMenus->where('status_menu', 'Habis')->count(); 

        // 2. Ambil HANYA 5 menu terbaru milik penjual login untuk tabel ringkasan front-end
        $menus = Menu::where('user_id', $penjual->id)
                     ->orderBy('id', 'DESC')
                     ->take(5)
                     ->get(); 

        return view('dashboard', compact('penjual', 'menus', 'totalMenu', 'totalTersedia', 'totalHabis'));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}