<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturBarang extends Model
{
    protected $table = 'retur_barang';
    protected $primaryKey = 'id_retur';
    public const UPDATED_AT = null;

    protected $fillable = [
        'id_batch',
        'tanggal_retur',
        'jumlah',
        'jenis_retur',
        'tujuan_retur',
        'keterangan',
    ];

    public function batch()
    {
        return $this->belongsTo(ProdukBatch::class, 'id_batch');
    }
}
