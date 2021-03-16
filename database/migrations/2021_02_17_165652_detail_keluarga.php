<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailKeluarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_keluarga', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('keluarga_id');
            $table->foreignId('jemaat_id');
            $table->enum('hubungan', ['Suami', 'Istri', 'Anak', 'Menantu', 'Cucu', 'Orang Tua', 'Mertua', 'Famili Lain'])->nullable();
            $table->integer('anak_ke')->nullable();
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
        Schema::dropIfExists('detail_keluarga');
    }
}
