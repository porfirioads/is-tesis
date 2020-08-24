<?php

use App\Services\DatabaseEnums;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ben_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_solicitud');
            $table->dateTime('fecha_aceptacion')->nullable();
            $table->dateTime('fecha_entrega')->nullable();
            $table->enum('estatus', DatabaseEnums::BEN_SOLICITUD_ESTATUS);
            $table->double('monto')->nullable();
            $table->string('evidencia', 255)->nullable();
            $table->foreignId('beneficiario_id');
            $table->foreignId('apoyo_secretaria_id');

            $table->foreign('beneficiario_id')
                ->references('id')
                ->on('ben_beneficiarios')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('apoyo_secretaria_id')
                ->references('id')
                ->on('ben_apoyos_secretarias')
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
        Schema::dropIfExists('ben_solicitudes');
    }
}
