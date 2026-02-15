<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukBatch extends Model
{
    protected $table = 'produk_batch';
    protected $primaryKey = 'id_batch';

    protected $fillable = [
        'id_produk',
        'nomor_batch',
        'tanggal_expired',
        'stok_batch'
    ];

    public function getRouteKeyName()
    {
        return 'id_batch';
    }
    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_batch');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_batch');
    }

    public function barangExpired()
    {
        return $this->hasMany(BarangExpired::class, 'id_batch');
    }
}
