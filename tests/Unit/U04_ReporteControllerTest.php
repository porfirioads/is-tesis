<?php

namespace Tests\Unit;

use App\Http\Controllers\ReporteController;
use App\Services\ReportService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Tests\DatabaseEachTestCase;

class U04_ReporteControllerTest extends DatabaseEachTestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;
    use DatabaseMigrations;

    public function testGetReports()
    {

        $mock = $this->mock(ReportService::class);

        $mock->shouldReceive('getReports')->once()->andReturn([
            [
                "id" => 1,
                "fecha" => "2020-07-24 22:47:15",
                "tipo" => "baches",
                "lat" => 22.7540992,
                "lng" => -102.5671168,
                "direccion" => "Donato Guerra 803 int 1, Centro, Zacatecas, Zacatecas, 98000",
                "incidencias" => [
                    [
                        "id" => 1,
                        "fecha" => "2020-07-24 22:47:15",
                        "foto" => "reportes/00001_00001.png",
                        "comentario" => "No pueden pasar los carros en esa calle",
                        "usuario_id" => 1,
                        "reporte_id" => 1
                    ],
                    [
                        "id" => 2,
                        "fecha" => "2020-07-24 22:47:15",
                        "foto" => "reportes/00001_00002.png",
                        "comentario" => "Los baches parecen lagunas",
                        "usuario_id" => 2,
                        "reporte_id" => 1
                    ]
                ],
                "estatus" => "pendiente",
                "seguimientos" => [
                    [
                        "id" => 1,
                        "fecha" => "2020-07-24 22:47:15",
                        "estatus" => "en progreso",
                        "mensaje" => "Ya nos encontramos atendiendo tu reporte",
                        "notificado" => 0,
                        "reporte_id" => 1
                    ],
                    [
                        "id" => 2,
                        "fecha" => "2020-07-24 22:47:15",
                        "estatus" => "atendido",
                        "mensaje" => "Tu reporte fue atendido",
                        "notificado" => 0,
                        "reporte_id" => 1
                    ]
                ]
            ],
            [
                "id" => 2,
                "fecha" => "2020-07-24 22:47:15",
                "tipo" => "jiapaz",
                "lat" => 22.7540992,
                "lng" => -102.5671168,
                "direccion" => "Donato Guerra 803 int 1, Centro, Zacatecas, Zacatecas, 98000",
                "incidencias" => [
                    [
                        "id" => 3,
                        "fecha" => "2020-07-24 22:47:15",
                        "foto" => "reportes/00002_00001.png",
                        "comentario" => "La fuga lleva tres días",
                        "usuario_id" => 3,
                        "reporte_id" => 2
                    ]
                ],
                "estatus" => "en progreso",
                "seguimientos" => [
                    [
                        "id" => 3,
                        "fecha" => "2020-07-24 22:47:15",
                        "estatus" => "cancelado",
                        "mensaje" => "La información enviada no es lo suficientemente clara",
                        "notificado" => 1,
                        "reporte_id" => 2
                    ]
                ]
            ]
        ]);

        $controller = new ReporteController($mock);
        $request = new Request();
        $response = $controller->getReports($request);
        $this->assertEquals(200, $response->status());
        $this->assertIsArray($response->getData());
    }
}
