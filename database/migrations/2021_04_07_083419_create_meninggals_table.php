<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeninggalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meninggal', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('jemaat_id');
            $table->date('tanggal')->nullable();
            $table->string('tempat')->nullable();
            $table->string('dimakamkan_di')->nullable();
            $table->text('keterangan')->nullable();
            $table->boolean('temporary')->nullable();
            $table->timestamps();

            $table->foreign('jemaat_id')->references('id')->on('jemaat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meninggal');
    }
}
