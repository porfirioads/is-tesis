<?php

use App\Services\DatabaseEnums;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeguimientoReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimiento_reportes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->enum('estatus', DatabaseEnums::REPORTE_ESTATUS);
            $table->string('mensaje', 500);
            $table->boolean('notificado');
            $table->foreignId('reporte_id');
            $table->foreign('reporte_id')
                ->references('id')
                ->on('reportes')
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
        Schema::dropIfExists('seguimiento_reportes');
    }
}
