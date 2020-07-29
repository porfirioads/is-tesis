<?php

namespace Tests\Unit;

use App\Http\Controllers\ReporteController;
use App\ObjectFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Tests\DatabaseEachTestCase;
use Tests\Mocks\InsertReportValidatorMockBuilder;
use Tests\Mocks\ReportServiceMockBuilder;

class U04_ReporteControllerTest extends DatabaseEachTestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        ObjectFactory::$useMocks = true;
    }

    public function tearDown(): void
    {
        parent::tearDown();
        ObjectFactory::$useMocks = false;
    }

    public function testGetReports()
    {
        ObjectFactory::$reportServiceMock = ReportServiceMockBuilder::create()
            ->mockGetReportsWithData()
            ->getResult();

        $controller = new ReporteController();
        $request = new Request();
        $response = $controller->getReports($request);
        $this->assertEquals(200, $response->status());

        foreach ($response->getData() as $report) {
            $this->assertObjectHasAttribute('id', $report);
            $this->assertObjectHasAttribute('fecha', $report);
            $this->assertObjectHasAttribute('tipo', $report);
            $this->assertObjectHasAttribute('lat', $report);
            $this->assertObjectHasAttribute('lng', $report);
            $this->assertObjectHasAttribute('direccion', $report);
            $this->assertObjectHasAttribute('incidencias', $report);
            $this->assertObjectHasAttribute('estatus', $report);
            $this->assertObjectHasAttribute('seguimientos', $report);
        }
    }

    public function testInsertReport()
    {
        ObjectFactory::$reportServiceMock = ReportServiceMockBuilder::create()
            ->mockInsertReport()
            ->getResult();

        ObjectFactory::$insertReportValidatorMock = InsertReportValidatorMockBuilder::create()
            ->mockValidateTrue()
            ->mockgetErrorsEmpty()
            ->getResult();

        $controller = new ReporteController();
        $request = new Request();
        $response = $controller->insertReport($request);

        dump($response);

        $this->assertEquals(200, $response->status());
        $this->assertIsArray($response->getData());

        foreach ($response->getData() as $report) {
            $this->assertObjectHasAttribute('reporte_id', $report);
            $this->assertObjectHasAttribute('incidencia_id', $report);
            $this->assertObjectHasAttribute('reincidencia', $report);
        }
    }

    public function testInsertReportInvalid()
    {
        ObjectFactory::$reportServiceMock = ReportServiceMockBuilder::create()
            ->getResult();

        $controller = new ReporteController();
        $request = new Request();
        $response = $controller->insertReport($request);
        $this->assertEquals(200, $response->status());
        $this->assertIsArray($response->getData());

        foreach ($response->getData() as $report) {
            $this->assertObjectHasAttribute('reporte_id', $report);
            $this->assertObjectHasAttribute('incidencia_id', $report);
            $this->assertObjectHasAttribute('reincidencia', $report);
        }
    }
}
