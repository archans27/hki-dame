<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaptisSidisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baptis_sidi', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('keluarga_id');
            $table->enum('jenis', ['Baptis', 'Sidi'])->nullable();
            $table->date('tanggal')->nullable();
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
        Schema::dropIfExists('baptis_sidi');
    }
}
