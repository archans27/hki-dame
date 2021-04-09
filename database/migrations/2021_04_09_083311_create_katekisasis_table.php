<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKatekisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katekisasi', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('jemaat_id');
            $table->date('tanggal')->nullable();
            $table->enum('status', ['L', 'M'])->nullable();
            $table->string('hobi')->nullable();
            $table->string('cita')->nullable();
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
        Schema::dropIfExists('katekisasi');
    }
}
