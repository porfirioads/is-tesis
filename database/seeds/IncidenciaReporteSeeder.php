<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class IncidenciaReporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('incidencia_reportes')->insert([
            [
                'id' => 1,
                'fecha' => Carbon::now(),
                'foto' => 'reportes/00001_00001.png',
                'comentario' => 'No pueden pasar los carros en esa calle',
                'reporte_id' => 1,
                'usuario_id' => 1,
            ],
            [
                'id' => 2,
                'fecha' => Carbon::now(),
                'foto' => 'reportes/00001_00002.png',
                'comentario' => 'Los baches parecen lagunas',
                'reporte_id' => 1,
                'usuario_id' => 2,
            ],
            [
                'id' => 3,
                'fecha' => Carbon::now(),
                'foto' => 'reportes/00002_00001.png',
                'comentario' => 'La fuga lleva tres días',
                'reporte_id' => 2,
                'usuario_id' => 3,
            ],
        ]);
    }
}
