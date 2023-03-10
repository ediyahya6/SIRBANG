<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_pemilik',
        'kelas_pemilik',
        'jenis_barang',
        'merk_barang',
        'lokasi_barang',
        'user_id',
    ];

    public function sirkulasi()
    {
        return $this->hasMany(Sirkulasi::class, 'barang_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}