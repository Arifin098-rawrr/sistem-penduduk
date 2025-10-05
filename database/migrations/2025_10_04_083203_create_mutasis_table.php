<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('mutasis', function (Blueprint $table) {
        $table->id('id_mutasi');
        $table->unsignedBigInteger('id_penduduk');
        $table->enum('jenis_mutasi', ['lahir', 'meninggal', 'pindah', 'datang']);
        $table->date('tanggal_mutasi');
        $table->text('keterangan')->nullable();
        $table->foreign('id_penduduk')->references('id_penduduk')->on('penduduks')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasis');
    }
};
