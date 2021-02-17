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
        Schema::create('jemaat', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('no_anggota');
            $table->integer('sektor_id');
            $table->string('keluarga_id');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
            $table->string('alamat_rumah');
            $table->enum('status_rumah', ['Tetap', 'Sementara']);
            $table->string('nomor_telepon');
            $table->enum('pendidikan', ['-', 'SD', 'SMP', 'SMA/SMK', 'DIPLOMA (D1, D2, D3)', 'SARJANA (D4, S1)', 'MAGISTER (S2)', 'DOKTORAL (S3)']);
            $table->string('pekerjaan');
            $table->date('tanggal_anggota');
            $table->boolean('hidup');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('jemaat');
    }
}
