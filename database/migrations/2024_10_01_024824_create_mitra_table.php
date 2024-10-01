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
            $table->string('progres_bermitra');
            $table->string('status_mitra');
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
