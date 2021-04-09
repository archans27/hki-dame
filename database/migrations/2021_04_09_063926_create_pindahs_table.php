<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePindahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pindah', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('keluarga_id');
            $table->string('tempat')->nullable();
            $table->date('tanggal')->nullable();
            $table->boolean('temporary')->nullable();
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
        Schema::dropIfExists('pindah');
    }
}
