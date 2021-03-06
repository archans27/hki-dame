<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUcapanSyukursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ucapan_syukur', function (Blueprint $table) {
            $table->id();
            $table->string('acara');
            $table->integer('record');
            $table->integer('gereja ')->nullable();
            $table->integer('pendeta')->nullable();
            $table->integer('majelis')->nullable();
            $table->integer('guru_huria')->nullable();
            $table->integer('pengembangan')->nullable();
            $table->date('tanggal');
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
        Schema::dropIfExists('ucapan_syukur');
    }
}
