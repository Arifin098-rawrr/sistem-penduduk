<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke penduduk
            $table->unsignedBigInteger('penduduk_id');
            $table->foreign('penduduk_id')
                  ->references('id_penduduk')
                  ->on('penduduks')
                  ->onDelete('cascade');

            // Relasi ke admin/user
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->foreign('admin_id')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('set null');

            $table->string('jenis_surat');
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_surat');
            $table->text('keperluan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
