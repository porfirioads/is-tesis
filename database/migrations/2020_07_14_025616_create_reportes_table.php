<?php

use App\Services\DatabaseEnums;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->enum('tipo', DatabaseEnums::REPORTE_TIPO);
            $table->double('lat');
            $table->double('lng');
            $table->string('direccion', 500);
            $table->integer('incidencias');
            $table->enum('estatus', DatabaseEnums::REPORTE_ESTATUS);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reportes');
    }
}
