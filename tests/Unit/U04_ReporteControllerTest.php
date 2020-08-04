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

        ObjectFactory::$insertReportValidatorMock = RequestValidatorMockBuilder::successValidation();

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

        ObjectFactory::$insertReportValidatorMock = RequestValidatorMockBuilder::errorValidation();

        $controller = new ReporteController();
        $request = new Request();
        $response = $controller->insertReport($request);
        $this->assertEquals(400, $response->status());
        $data = $response->getData();
        $this->assertErrorValidation($data);
    }

    public function testUpdateReportType()
    {
        ObjectFactory::$reportServiceMock = ReportServiceMockBuilder::create()
            ->mockUpdateReportType()
            ->getResult();

        ObjectFactory::$updateReportTypeValidatorMock = RequestValidatorMockBuilder::successValidation();

        $controller = new ReporteController();
        $request = new Request();
        $response = $controller->updateReportType($request);
        $this->assertEquals(200, $response->status());
        $data = $response->getData();
        $this->assertObjectHasAttribute('id', $data);
        $this->assertObjectHasAttribute('fecha', $data);
        $this->assertObjectHasAttribute('tipo', $data);
        $this->assertObjectHasAttribute('lat', $data);
        $this->assertObjectHasAttribute('lng', $data);
        $this->assertObjectHasAttribute('direccion', $data);
        $this->assertObjectHasAttribute('incidencias', $data);
        $this->assertObjectHasAttribute('estatus', $data);
    }

    public function testUpdateReportTypeInvalid()
    {
        ObjectFactory::$reportServiceMock = ReportServiceMockBuilder::create()
            ->mockUpdateReportType()
            ->getResult();

        ObjectFactory::$updateReportTypeValidatorMock = RequestValidatorMockBuilder::errorValidation();

        $controller = new ReporteController();
        $request = new Request();
        $response = $controller->updateReportType($request);
        $this->assertEquals(400, $response->status());
        $data = $response->getData();
        $this->assertErrorValidation($data);
    }

    private function assertErrorValidation($data)
    {
        $this->assertObjectHasAttribute('errors', $data);
        $this->assertObjectHasAttribute('testing', $data->errors);
        $this->assertIsArray($data->errors->testing);
        $this->assertCount(1, $data->errors->testing);
    }

    public function testDeleteReport()
    {
        ObjectFactory::$reportServiceMock = ReportServiceMockBuilder::create()
            ->mockDeleteReport()
            ->getResult();

        ObjectFactory::$deleteReportValidatorMock = RequestValidatorMockBuilder::successValidation();

        $controller = new ReporteController();
        $request = new Request();
        $response = $controller->deleteReport($request);
        $this->assertEquals(200, $response->status());
        $data = $response->getData();
        $this->assertObjectHasAttribute('query_status', $data);
        $this->assertEquals(1, $data->query_status);
    }

    public function testDeleteReportInvalid()
    {
        ObjectFactory::$reportServiceMock = ReportServiceMockBuilder::create()
            ->mockDeleteReport()
            ->getResult();

        ObjectFactory::$deleteReportValidatorMock = RequestValidatorMockBuilder::errorValidation();

        $controller = new ReporteController();
        $request = new Request();
        $response = $controller->deleteReport($request);
        $this->assertEquals(400, $response->status());
        $data = $response->getData();
        $this->assertErrorValidation($data);
    }
}
