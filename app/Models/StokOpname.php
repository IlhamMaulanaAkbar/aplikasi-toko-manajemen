<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    protected $table = 'stok_opname';
    protected $primaryKey = 'id_opname';
    public const UPDATED_AT = null;

    protected $fillable = [
        'id_batch',
        'tanggal_opname',
        'stok_sistem',
        'stok_fisik',
        'selisih',
        'keterangan',
    ];

    public function batch()
    {
        return $this->belongsTo(ProdukBatch::class, 'id_batch');
    }
}
