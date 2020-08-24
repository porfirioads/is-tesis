<?php

namespace Tests\Mocks;

use App\Services\DatabaseEnums;
use App\Services\SupportService;
use Carbon\Carbon;
use Mockery;

class SupportServiceMockBuilder extends BaseMockBuilderV2
{
    public function __construct()
    {
        parent::__construct(SupportService::class);
    }

    public function mockSuccessGetSupports()
    {
        $this->mockFunction('getSupports', [
            [
                'id' => 1,
                'fecha_solicitud' => Carbon::now(),
                'fecha_aceptacion' => Carbon::now(),
                'fecha_entrega' => Carbon::now(),
                'estatus' => DatabaseEnums::BEN_EST_DENEGADO,
                'monto' => 0,
                'beneficiario' => [
                    'id' => 1,
                    'nombre' => 'Porfirio',
                    'primer_apellido' => 'Díaz',
                    'segundo_apellido' => 'Sánchez',
                    'sexo' => 'H',
                    'curp' => 'DISP960720HZSZNR15',
                    'telefono' => '4949428610',
                    'nombre_vialidad' => 'Donato Guerra',
                    'numero_exterior' => '103',
                    'numero_interior' => '',
                    'colonia' => 'Centro'
                ],
                'apoyo' => [
                    'tipo_apoyo' => 'DESPENSA',
                    'secretaria' => 'SECRETARIA DE PLANEACIÓN'
                ]
            ]
        ]);

        return $this;
    }
}
