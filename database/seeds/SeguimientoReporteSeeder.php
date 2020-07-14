<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SeguimientoReporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seguimiento_reportes')->insert([
            [
                'id' => 1,
                'fecha' => Carbon::now(),
                'estatus' => 'En Progreso',
                'mensaje' => 'Ya nos encontramos atendiendo tu reporte',
                'reporte_id' => 1
            ],
            [
                'id' => 2,
                'fecha' => Carbon::now(),
                'estatus' => 'Atendido',
                'mensaje' => 'Tu reporte fue atendido',
                'reporte_id' => 1
            ],
            [
                'id' => 3,
                'fecha' => Carbon::now(),
                'estatus' => 'Cancelado',
                'mensaje' => 'La información enviada no es lo suficientemente clara',
                'reporte_id' => 2
            ]
        ]);
    }
}
