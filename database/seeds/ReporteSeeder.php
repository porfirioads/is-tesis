<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ReporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reportes')->insert([
            [
                'id' => 1,
                'fecha' => Carbon::now(),
                'tipo' => 'Baches',
                'lat' => 22.7540992,
                'lng' => -102.5671168,
                'direccion' => 'Donato Guerra 803 int 1, Centro, Zacatecas, Zacatecas, 98000',
                'incidencias' => 2,
                'estatus' => 'Pendiente'
            ],
            [
                'id' => 2,
                'fecha' => Carbon::now(),
                'tipo' => 'JIAPAZ',
                'lat' => 22.7540992,
                'lng' => -102.5671168,
                'direccion' => 'Donato Guerra 803 int 1, Centro, Zacatecas, Zacatecas, 98000',
                'incidencias' => 1,
                'estatus' => 'En progreso'
            ],
        ]);
    }
}
