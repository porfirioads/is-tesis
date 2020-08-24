<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenApoyosSecretariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ben_apoyos_secretarias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apoyo_id');
            $table->foreignId('secretaria_id');

            $table->foreign('apoyo_id')
                ->references('id')
                ->on('ben_apoyos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('secretaria_id')
                ->references('id')
                ->on('secretarias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ben_apoyos_secretarias');
    }
}
