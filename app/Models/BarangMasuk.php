<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id_masuk';
    public $incrementing = true;

    protected $fillable = [
        'id_batch',
        'tanggal_masuk',
        'jumlah',
        'supplier',
        'keterangan'
    ];

    public function batch()
    {
        return $this->belongsTo(ProdukBatch::class, 'id_batch');
    }
}
