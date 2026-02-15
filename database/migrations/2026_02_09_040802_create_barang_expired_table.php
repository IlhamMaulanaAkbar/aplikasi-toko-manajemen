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
        Schema::create('barang_expired', function (Blueprint $table) {
            $table->id('id_expired');
            $table->foreignId('id_batch')->constrained('produk_batch', 'id_batch')->onDelete('cascade');
            $table->date('tanggal_dicatat');
            $table->integer('jumlah');
            $table->enum('status', ['Dimusnahkan','Dikembalikan']);
            $table->string('keterangan', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_expired');
    }
};
