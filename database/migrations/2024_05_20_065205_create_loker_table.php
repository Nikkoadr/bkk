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
        Schema::create('loker', function (Blueprint $table) {
            $table->id('id_loker');
            $table->string('nama_loker');
            $table->string('posisi');
            $table->text('deskripsi');
            $table->string('administrasi');
            $table->enum('status_loker',['aktif','tidak aktif'])->default('tidak aktif');
            $table->string('grup_wa');
            $table->enum('form_npwp',['aktif','tidak aktif'])->default('aktif');
            $table->enum('form_npsn',['aktif','tidak aktif'])->default('aktif');
            $table->enum('form_nilai_ijazah',['aktif','tidak aktif'])->default('aktif');
            $table->enum('form_nilai_matematika',['aktif','tidak aktif'])->default('aktif');
            $table->enum('form_domisili',['aktif','tidak aktif'])->default('aktif');
            $table->enum('form_pernah_mengikuti_reqrutment_calon_karyawan',['aktif','tidak aktif'])->default('aktif');
            $table->enum('form_pernah_bekerja',['aktif','tidak aktif'])->default('aktif');
            $table->enum('form_vaksin',['aktif','tidak aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loker');
    }
};
