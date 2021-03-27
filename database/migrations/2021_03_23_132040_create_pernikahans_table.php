<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePernikahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pernikahan', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('keluarga_id');
            $table->string('kepala_keluarga');
            $table->uuid('mempelai')->nullable();
            $table->uuid('pasangan_mempelai')->nullable();
            $table->date('tanggal_pemberkatan')->nullable();
            $table->uuid('ucapan_syukur')->nullable();
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
        Schema::dropIfExists('pernikahan');
    }
}
