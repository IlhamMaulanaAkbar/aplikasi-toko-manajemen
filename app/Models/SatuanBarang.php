<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SatuanBarang extends Model
{
    protected $table = 'satuan_barang';
    protected $primaryKey = 'id_satuan';

    protected $fillable = [
        'nama_satuan',
        'keterangan'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_satuan');
    }
}
