<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loker', function (Blueprint $table) {
            $table->id('id_loker');
            $table->string('nama_loker')->index();
            $table->string('posisi');
            $table->text('deskripsi');
            $table->unsignedInteger('administrasi')->default(0);
            $table->enum('status_loker', ['aktif', 'tidak aktif'])->default('tidak aktif')->index();
            $table->string('grup_wa');
            $table->enum('form_npwp', ['aktif', 'tidak aktif'])->default('aktif');
            $table->enum('form_npsn', ['aktif', 'tidak aktif'])->default('aktif');
            $table->enum('form_nilai_ijazah', ['aktif', 'tidak aktif'])->default('aktif');
            $table->enum('form_nilai_matematika', ['aktif', 'tidak aktif'])->default('aktif');
            $table->enum('form_domisili', ['aktif', 'tidak aktif'])->default('aktif');
            $table->enum('form_pernah_mengikuti_reqrutment_calon_karyawan', ['aktif', 'tidak aktif'])->default('aktif');
            $table->enum('form_pernah_bekerja', ['aktif', 'tidak aktif'])->default('aktif');
            $table->enum('form_vaksin', ['aktif', 'tidak aktif'])->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loker');
    }
};
