<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJemaatLahirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jemaat_lahir', function (Blueprint $table) {
            $table->id();
            $table->uuid('detail_keluarga_id');
            $table->uuid('ucapan_syukur_id');
            $table->enum('status_anak', ['Kandung', 'Angkat']);
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
        Schema::dropIfExists('jemaat_lahir');
    }
}
