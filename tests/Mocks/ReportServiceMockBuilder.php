<?php

namespace Tests\Mocks;

use App\Services\ReportService;
use Mockery;

class ReportServiceMockBuilder
{
    private $mock;

    private function __construct()
    {
        $this->mock = Mockery::mock(ReportService::class);
    }

    public static function create()
    {
        return new ReportServiceMockBuilder();
    }

    protected function mockFunction($functionName, $returnValue)
    {
        $this->mock->allows([$functionName => $returnValue]);
        return $this;
    }

    public function mockGetReportsWithData()
    {
        $this->mockFunction('getReports', [
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

        return $this;
    }

    public function mockInsertReport()
    {
        $this->mockFunction('insertReport', [
            "reporte_id" => 3,
            "incidencia_id" => 4,
            "reincidencia" => true
        ]);

        return $this;
    }

    public function mockUpdateReportType()
    {
        $this->mockFunction('updateReportType', [
            "id" => 1,
            "fecha" => "2020-07-28 17:32:14",
            "tipo" => "iluminación",
            "lat" => 22.7540992,
            "lng" => -102.5671168,
            "direccion" => "Donato Guerra 803 int 1, Centro, Zacatecas, Zacatecas, 98000",
            "incidencias" => 2,
            "estatus" => "pendiente"
        ]);

        return $this;
    }

    public function mockDeleteReport()
    {
        $this->mockFunction('deleteReport', ["query_status" => 1]);
        return $this;
    }

    public function mockGetPendingFeedback()
    {
        $this->mockFunction('getPendingFeedback', [
            [
                "id" => 1,
                "fecha" => "2020-07-28 17 =>32 =>14",
                "estatus" => "en progreso",
                "mensaje" => "Ya nos encontramos atendiendo tu reporte",
                "notificado" => 0,
                "reporte_id" => 1
            ]
        ]);

        return $this;
    }

    public function mockInsertFeedback()
    {
        $this->mockFunction('insertFeedback', [
            "reporte_id" => "2",
            "estatus" => "atendido",
            "mensaje" => "Tu reporte está siendo atendido",
            "fecha" => "2020-08-04 16:16:12",
            "notificado" => false,
            "id" => 4
        ]);

        return $this;
    }

    public function mockDeleteFeedback()
    {
        $this->mockFunction('deleteFeedback', [
            "query_status" => 1
        ]);

        return $this;
    }

    public function getResult()
    {
        return $this->mock;
    }
}
