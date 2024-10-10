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
        Schema::create('industri', function (Blueprint $table) {
            $table->id();
            $table->string('nama_industri');
            $table->string('npwp')->unique();
            $table->string('skdp')->unique();
            $table->string('email')->unique();
            $table->text('alamat');
            $table->enum('bidang_industri', [
                'Teknologi Informasi',
                'Manufaktur',
                'Kesehatan',
                'Pendidikan',
                'Keuangan',
                'Pertanian',
                'Energi',
                'Transportasi',
                'Retail',
                'Pariwisata'
            ])->default('Teknologi Informasi');
            $table->string('no_tlpn_industri');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industri');
    }
};
