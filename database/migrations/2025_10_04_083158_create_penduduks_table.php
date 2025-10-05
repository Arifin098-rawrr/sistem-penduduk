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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id('id_penduduk');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->string('kewarganegaraan');
            $table->string('alamat');
            $table->string('rt_rw');
            $table->string('kel_desa');
            $table->string('kecamatan');
            $table->string('pendidikan');
            $table->string('pekerjaan');
            $table->string('status_perkawinan');
            $table->string('hubungan_keluarga');
            $table->unsignedBigInteger('id_kk');
            $table->foreign('id_kk')->references('id_kk')->on('kks')->onDelete('cascade');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};
