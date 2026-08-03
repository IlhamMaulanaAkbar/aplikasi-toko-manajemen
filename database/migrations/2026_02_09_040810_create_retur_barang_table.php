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
        Schema::create('retur_barang', function (Blueprint $table) {
            $table->id('id_retur');
            $table->foreignId('id_batch')->constrained('produk_batch', 'id_batch')->onDelete('cascade');
            $table->date('tanggal_retur');
            $table->integer('jumlah');
            $table->string('jenis_retur', 50);
            $table->string('tujuan_retur', 100);
            $table->string('keterangan', 255)->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retur_barang');
    }
};
