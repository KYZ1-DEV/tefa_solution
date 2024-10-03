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
        Schema::create('sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('npsn')->unique();
            $table->string('nama_sekolah');
            $table->enum('status',['Negeri','Swasta'])->default('Negeri');
            $table->enum('jenjang',['SD','SMP','SMK','SMA'])->default('SMK');
            $table->string('kepsek');
            $table->text('alamat');
            $table->string('email')->unique();
            $table->string('no_tlpn_sekolah');
            $table->foreignId(column: 'id_user')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah');
    }
};
