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
             // Menambahkan foreign key ke tabel 'sekolah'
             if (!Schema::hasColumn('laporan', 'id_sekolah')) {
                $table->foreignId('id_sekolah')->constrained('sekolah')->onDelete('cascade');
            }

            // Menambahkan foreign key ke tabel 'bantuan'
            if (!Schema::hasColumn('laporan', 'id_bantuan')) {
                $table->foreignId('id_bantuan')->nullable()->constrained('bantuan')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan', function (Blueprint $table) {
            $table->dropForeign(['id_sekolah']);
            $table->dropForeign(['id_bantuan']);
        });
    }
};
