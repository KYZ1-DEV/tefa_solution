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
        Schema::table('laporan', function (Blueprint $table) {
            // Menambahkan foreign key ke tabel 'bantuan'
            $table->foreignId('id_bantuan')->nullable()->after('id_sekolah')->constrained('bantuan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            // Menghapus foreign key dan kolom id_bantuan
            $table->dropForeign(['id_bantuan']);
            $table->dropColumn('id_bantuan');
        });
    }
};
