<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database secara eksplisit
    protected $table = 'menu';

    // Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'user_id',
        'nama_menu',
        'kategori_menu',
        'harga',
        'stok',
        'status_menu',
        'deskripsi',
        'tanggal_input'
    ];

    // MATIKAN TIMESTAMPS: Supaya Laravel tidak memaksa mencari kolom created_at / updated_at
    public $timestamps = false;

    // Relasi balik ke tabel Users (Penjual)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}