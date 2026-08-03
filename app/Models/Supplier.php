<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    public const UPDATED_AT = null;

    protected $fillable = [
        'kode_supplier',
        'nama_supplier',
        'alamat',
        'no_telepon',
        'email',
        'kontak_person',
        'keterangan',
    ];

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_supplier');
    }
}
