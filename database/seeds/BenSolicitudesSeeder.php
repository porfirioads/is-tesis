<?php

use App\Models\BenSolicitud;
use App\Services\DatabaseEnums;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BenSolicitudesSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'fecha_solicitud' => Carbon::now(),
                'fecha_aceptacion' => Carbon::now(),
                'fecha_entrega' => Carbon::now(),
                'estatus' => DatabaseEnums::BEN_EST_APROBADO,
                'evidencia' => null,
                'beneficiario_id' => 1,
                'apoyo_secretaria_id' => 1
            ]
        ];

        $tableName = (new BenSolicitud())->getTable();
        DB::table($tableName)->insert($items);
    }
}
