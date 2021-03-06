<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJemaatBarusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jemaat_baru', function (Blueprint $table) {
            $table->id();
            $table->uuid('jemaat_id');
            $table->unsignedBigInteger('ucapan_syukur_id');
            $table->string('asal_gereja')->nullable();
            $table->string('gereja_terakhir')->nullable();
            $table->date('tanggal');
            $table->integer('persembahan_tahunan')->nullable();
            $table->timestamps();

            $table->foreign('jemaat_id')->references('id')->on('jemaat');
            $table->foreign('ucapan_syukur_id')->references('id')->on('ucapan_syukur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jemaat_baru');
    }
}
