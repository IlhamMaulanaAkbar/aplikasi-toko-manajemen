<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    protected $table = 'jenis_barang';
    protected $primaryKey = 'id_jenis';

    protected $fillable = [
        'nama_jenis',
        'keterangan'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_jenis');
    }
}
