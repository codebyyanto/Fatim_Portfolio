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
        // Table: tbkeahlian_23312241
        Schema::create('tbkeahlian_23312241', function (Blueprint $table) {
            $table->id();
            $table->string('nama_keahlian', 100);
            $table->text('deskripsi');
            $table->string('icon', 500)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });

        // Table: tbproyek_23312241
        Schema::create('tbproyek_23312241', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek', 200);
            $table->year('tahun_proyek');
            $table->string('jenis_proyek', 50);
            $table->text('tim_pengembang');
            $table->text('deskripsi')->default('Deskripsi proyek belum diisi.');
            $table->string('durasi', 50);
            $table->string('gambar', 500)->nullable();
            $table->string('video_demo', 500)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbkeahlian_23312241');
        Schema::dropIfExists('tbproyek_23312241');
    }
};
