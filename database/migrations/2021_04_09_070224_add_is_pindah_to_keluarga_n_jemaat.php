<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsPindahToKeluargaNJemaat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keluarga', function (Blueprint $table) {
            $table->boolean('is_pindah')->default(0);
        });
        Schema::table('jemaat', function (Blueprint $table) {
            $table->boolean('is_pindah')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keluarga', function (Blueprint $table) {
            $table->boolean('is_pindah')->default(0);
        });
        Schema::table('jemaat', function (Blueprint $table) {
            $table->boolean('is_pindah')->default(0);
        });
    }
}
