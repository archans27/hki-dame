<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTempatToBaptisSidis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('baptis_sidi', function (Blueprint $table) {
            $table->string('tempat')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('baptis_sidi', function (Blueprint $table) {
            $table->dropColumn('tempat');
        });
    }
}
