<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'stok',
        'harga',
        'jenis_barang_id',
        'gambar'
    ];

    public function jenisBarang(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }
}
