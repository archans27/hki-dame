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
            $table->uuid('ucapan_syukur_id');
            $table->string('untuk');
            $table->string('dari_acara');
            $table->uuid('record');
            $table->integer('besaran');
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
