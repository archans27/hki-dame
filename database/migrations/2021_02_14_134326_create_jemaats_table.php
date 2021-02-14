<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJemaatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jemaats', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('no_anggota');
            $table->string('sektor_id');
            $table->string('kepala_keluarga_id');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            $table->string('alamat_rumah');
            $table->enum('status_rumah', ['Pribadi', 'Orang Tua', 'Sewa']);
            $table->string('nomor_telepon');
            $table->enum('pendidikan', ['-', 'SD', 'SMP', 'SMA', 'Diploma 1-3', 'S1/D4', 'S2', 'S3']);
            $table->string('pekerjaan');
            $table->date('tanggal_anggota');
            $table->boolean('hidup');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jemaats');
    }
}
