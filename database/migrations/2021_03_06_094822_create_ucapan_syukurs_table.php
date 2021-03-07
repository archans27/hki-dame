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
            $table->uuid('id')->primary();
            $table->string('acara');
            $table->uuid('record');
            $table->integer('tk_gereja')->nullable();
            $table->integer('tk_pendeta')->nullable();
            $table->integer('tk_majelis')->nullable();
            $table->integer('tk_guru_huria')->nullable();
            $table->integer('tk_pengembangan')->nullable();
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
