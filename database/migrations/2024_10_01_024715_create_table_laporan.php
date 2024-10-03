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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_laporan');
            $table->enum('progres_laporan',['0%','50%','100%'])->default('0%');
            $table->string('bukti_laporan')->nullable();
            $table->date('tanggal_laporan');
            $table->text('deskripsi_laporan')->nullable();
            $table->enum('status_laporan',['dikirim','diterima','direvisi'])->default('dikirim');
            $table->text('keterangan_laporan')->nullable();
            $table->foreignId('id_sekolah')->constrained('sekolah')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
