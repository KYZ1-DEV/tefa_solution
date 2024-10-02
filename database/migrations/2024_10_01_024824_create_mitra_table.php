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
        Schema::create('mitra', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra');
            $table->date('tanggal_bermitra');
            $table->enum('progres_bermitra',allowed: ['0%','50%','100%'])->default('0%');
            $table->enum('status_mitra',['proses','dibatalkan','selesai'])->default('proses');
            $table->foreignId('id_sekolah')->constrained('sekolah')->onDelete('cascade');
            $table->foreignId('id_industri')->constrained('industri')->onDelete('cascade');
            $table->foreignId('id_bantuan')->nullable()->constrained('bantuan')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mitra');
    }
};
