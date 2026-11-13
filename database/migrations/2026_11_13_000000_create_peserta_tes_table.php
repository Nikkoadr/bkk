<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peserta_tes', function (Blueprint $table) {
            $table->id();
            $table->string('no_tes', 50)->unique();
            $table->string('nama_lengkap')->index();
            $table->string('asal_sekolah')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('hari', 50)->nullable()->index();
            $table->string('waktu', 50)->nullable()->index();
            $table->string('perangkat', 50)->nullable()->index();
            $table->string('link', 2048)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peserta_tes');
    }
};
