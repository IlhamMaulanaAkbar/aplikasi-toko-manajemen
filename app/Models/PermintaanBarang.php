<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanBarang extends Model
{
    protected $table = 'permintaan_barang';
    protected $primaryKey = 'id_permintaan';

    protected $fillable = [
        'user_id',
        'id_produk',
        'tanggal_permintaan',
        'jumlah_diminta',
        'status',
        'keterangan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function batch()
    {
        return $this->belongsTo(ProdukBatch::class, 'batch_id');
    }
}
