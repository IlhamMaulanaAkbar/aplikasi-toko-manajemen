<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangExpired extends Model
{
    protected $table = 'barang_expired';
    protected $primaryKey = 'id_expired';
    protected $fillable = [
        'id_batch',
        'tanggal_dicatat',
        'jumlah',
        'status',
        'keterangan'
    ];

    public function batch()
    {
        return $this->belongsTo(ProdukBatch::class, 'id_batch');
    }
}
