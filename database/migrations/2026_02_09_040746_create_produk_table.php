<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('kode_produk', 20)->unique();
            $table->string('nama_produk', 100);
            $table->string('brand', 50);
            $table->foreignId('id_jenis')->constrained('jenis_barang', 'id_jenis');
            $table->foreignId('id_satuan')->constrained('satuan_barang', 'id_satuan');
            $table->integer('stok')->default(0);
            $table->integer('stok_minimum')->default(5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
