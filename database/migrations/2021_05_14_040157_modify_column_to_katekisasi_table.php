<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyColumnToKatekisasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('katekisasi', function (Blueprint $table) {
            $table->string('status')->nullable()->change();
            $table->dropColumn('cita');
        });

        Schema::table('katekisasi', function (Blueprint $table) {
            $table->enum('kelas', ['R', 'K'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('katekisasi', function (Blueprint $table) {
            //
        });
    }
}
