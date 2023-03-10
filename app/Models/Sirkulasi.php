<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sirkulasi extends Model
{
    use HasFactory;

    protected $table = 'sirkulasi';

    protected $fillable = [
        'barang_id',
        'status',
        'status',
        'keterangan',
        'user_id',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}