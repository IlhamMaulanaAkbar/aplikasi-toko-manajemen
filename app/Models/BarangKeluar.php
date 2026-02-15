<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $table = 'barang_keluar';
    protected $primaryKey = 'id_keluar';

    protected $fillable = [
        'id_batch',
        'tanggal_keluar',
        'jumlah',
        'tujuan',
        'keterangan'
    ];

    public function batch()
    {
        return $this->belongsTo(ProdukBatch::class, 'id_batch');
    }
}
