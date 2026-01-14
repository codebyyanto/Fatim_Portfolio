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
        Schema::table('tbkeahlian_23312241', function (Blueprint $table) {
            $table->string('kategori_23312241')->nullable()->after('nama_keahlian');
        });
    }

    public function down(): void
    {
        Schema::table('tbkeahlian_23312241', function (Blueprint $table) {
            $table->dropColumn('kategori_23312241');
        });
    }
};
