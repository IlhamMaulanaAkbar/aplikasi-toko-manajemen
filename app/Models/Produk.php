<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';


    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'brand',
        'id_jenis',
        'id_satuan',
        'stok',
        'stok_minimum'
    ];

    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'id_jenis');
    }

    public function satuan()
    {
        return $this->belongsTo(SatuanBarang::class, 'id_satuan');
    }

    public function batch()
    {
        return $this->hasMany(ProdukBatch::class, 'id_produk');
    }

    public function permintaanBarang()
    {
        return $this->hasMany(PermintaanBarang::class, 'id_produk');
    }

    public function getTotalStokAttribute()
    {
        return $this->batch()->sum('stok_batch');
    }
}
