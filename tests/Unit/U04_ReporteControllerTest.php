<?php

namespace Tests\Unit;

use App\Http\Controllers\ReporteController;
use App\ObjectFactory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Tests\DatabaseEachTestCase;
use Tests\Mocks\RequestValidatorMockBuilder;
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

        ObjectFactory::$insertReportValidatorMock = RequestValidatorMockBuilder::create()
            ->mockValidateTrue()
            ->mockGetErrorsEmpty()
            ->getResult();

        $controller = new ReporteController();
        $request = new Request();
        $response = $controller->insertReport($request);
        $this->assertEquals(200, $response->status());
        $data = $response->getData();
        $this->assertObjectHasAttribute('reporte_id', $data);
        $this->assertObjectHasAttribute('incidencia_id', $data);
        $this->assertObjectHasAttribute('reincidencia', $data);
    }

    public function testInsertReportInvalid()
    {
        ObjectFactory::$reportServiceMock = ReportServiceMockBuilder::create()
            ->getResult();

        ObjectFactory::$insertReportValidatorMock = RequestValidatorMockBuilder::create()
            ->mockValidateFalse()
            ->mockGetErrors()
            ->getResult();

        $controller = new ReporteController();
        $request = new Request();
        $response = $controller->insertReport($request);
        $this->assertEquals(400, $response->status());
        $data = $response->getData();
        $this->assertObjectHasAttribute('errors', $data);
        $this->assertObjectHasAttribute('testing', $data->errors);
        $this->assertIsArray($data->errors->testing);
        $this->assertCount(1, $data->errors->testing);
    }
}
