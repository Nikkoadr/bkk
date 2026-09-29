<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('code_pendaftaran', 64)->unique();
            $table->enum('status_bayar', ['belum', 'menunggu', 'sudah'])->default('belum')->index();
            $table->string('bukti_transfer')->nullable();
            $table->foreignId('id_loker')->constrained('loker', 'id_loker')->cascadeOnDelete();
            $table->enum('payment_method', ['manual', 'midtrans'])->default('manual')->index();
            $table->string('midtrans_order_id', 64)->nullable()->unique();
            $table->string('midtrans_snap_token')->nullable();
            $table->string('midtrans_transaction_status', 32)->nullable()->index();
            $table->timestamp('paid_at')->nullable()->index();
            $table->string('email')->index();
            $table->string('nomor_wa', 20);
            $table->string('nama')->index();
            $table->string('nomor_nik', 32)->nullable()->index();
            $table->string('npwp', 64)->nullable();
            $table->enum('sim', ['D', 'C1', 'C2', 'C3', 'A', 'A UMUM', 'B1', 'B2', 'B1 UMUM', 'B2 UMUM'])->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('status_perkawinan', ['MENIKAH', 'BELUM MENIKAH'])->nullable();
            $table->enum('jenis_pendidikan_terakhir', ['MA', 'MAK', 'SMA', 'SMK', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'])->nullable();
            $table->string('npsn', 64)->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('jurusan_pendidikan')->nullable();
            $table->string('kota_asal_sekolah')->nullable();
            $table->string('tahun_lulus', 4)->nullable();
            $table->string('nilai_rata_rata_ijazah')->nullable();
            $table->string('nilai_rata_rata_matematika')->nullable();
            $table->string('blok')->nullable();
            $table->string('rt', 5)->nullable();
            $table->string('rw', 5)->nullable();
            $table->string('desa')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('domisili')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('posisi_yang_dilamar')->nullable();
            $table->string('pengalaman_kerja')->nullable();
            $table->enum('pernah_mengikuti_reqrutment_calon_karyawan', ['BELUM PERNAH', 'SUDAH PERNAH'])->nullable();
            $table->enum('pernah_bekerja', ['BELUM PERNAH', 'SUDAH PERNAH'])->nullable();
            $table->string('source')->nullable();
            $table->string('nama_kordinator')->nullable();
            $table->enum('vaksin_1', ['sudah', 'belum'])->nullable();
            $table->enum('jenis_vaksin_1', ['SINOVAC', 'VAKSIN COVID-19 BIO DARMA', 'ASTRAZENECA', 'SINOPHARM', 'MODERNA', 'PFIZER', 'SPUTNIK V', 'INDOVAC', 'INAVAC'])->nullable();
            $table->date('tanggal_vaksin_1')->nullable();
            $table->string('lokasi_vaksin_1')->nullable();
            $table->enum('vaksin_2', ['sudah', 'belum'])->nullable();
            $table->enum('jenis_vaksin_2', ['SINOVAC', 'VAKSIN COVID-19 BIO DARMA', 'ASTRAZENECA', 'SINOPHARM', 'MODERNA', 'PFIZER', 'SPUTNIK V', 'INDOVAC', 'INAVAC'])->nullable();
            $table->date('tanggal_vaksin_2')->nullable();
            $table->string('lokasi_vaksin_2')->nullable();
            $table->enum('vaksin_3', ['sudah', 'belum'])->nullable();
            $table->enum('jenis_vaksin_3', ['SINOVAC', 'VAKSIN COVID-19 BIO DARMA', 'ASTRAZENECA', 'SINOPHARM', 'MODERNA', 'PFIZER', 'SPUTNIK V', 'INDOVAC', 'INAVAC'])->nullable();
            $table->date('tanggal_vaksin_3')->nullable();
            $table->string('lokasi_vaksin_3')->nullable();
            $table->timestamps();

            $table->unique(['id_loker', 'nomor_nik']);
            $table->index(['id_loker', 'status_bayar']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
