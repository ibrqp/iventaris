<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = "Peminjamen";
    protected $fillable = ['id_siswa', 'id_barang', 'tgl_pinjam', 'tgl_kembali'];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}
