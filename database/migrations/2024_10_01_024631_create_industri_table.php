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
            $table->string('npwp');
            $table->string('skdp');
            $table->string('email')->unique();
            $table->string('bidang_industri');
            $table->string('no_tpln_industri');
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
