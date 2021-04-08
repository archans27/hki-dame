<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisToPernikahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pernikahan', function (Blueprint $table) {
            $table->enum('jenis', ['IJ', 'M'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pernikahan', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
}
