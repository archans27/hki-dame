<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKeluargaIdToJemaatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jemaat', function (Blueprint $table) {
            $table->unsignedBigInteger('keluarga_id')->nullable();
            $table->foreign('keluarga_id')->references('id')->on('keluarga');
        });
    }

    public function down()
    {
        Schema::table('jemaat', function (Blueprint $table) {
            $table->dropForeign(['keluarga_id']);
            $table->dropColumn('keluarga_id');
        });
    }


}
