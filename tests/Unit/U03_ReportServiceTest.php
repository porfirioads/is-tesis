<?php

namespace Tests\Unit;

use App\Models\Reporte;
use App\Models\SeguimientoReporte;
use App\Models\Usuario;
use App\Services\DatabaseEnums;
use App\Services\JwtService;
use App\Services\ReportService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Tests\DatabaseEachTestCase;

class U03_ReportServiceTest extends DatabaseEachTestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;
    use DatabaseMigrations;

    private $reportService;

    public function setUp(): void
    {
        parent::setUp();
        $this->reportService = ReportService::getInstance();
    }

    public function testGetReports()
    {
        $reportes = $this->reportService->getReports();
        $this->assertGreaterThanOrEqual(1, count($reportes));
    }

    private function assertInsertReport($res)
    {
        $this->assertIsArray($res);
        $this->assertArrayHasKey('reporte_id', $res);
        $this->assertIsNumeric($res['reporte_id']);
        $this->assertArrayHasKey('incidencia_id', $res);
        $this->assertIsNumeric($res['incidencia_id']);
        $this->assertArrayHasKey('reincidencia', $res);
        $this->assertIsBool($res['reincidencia']);
    }

    public function testInsertReport()
    {
        $testUser = Usuario::first();
        $token = JwtService::getInstance()->generate($testUser->username);

        $request = new Request([
            'lat' => 22.6482078,
            'lng' => -102.9781093
        ]);

        $request->headers->set('Authorization', "Bearer $token");
        $res = $this->reportService->insertReport($request);
        $this->assertInsertReport($res);
    }

    public function testInsertReportReincidence()
    {
        $testUser = Usuario::first();
        $token = JwtService::getInstance()->generate($testUser->username);

        $request = new Request([
            'lat' => 22.6482078,
            'lng' => -102.9781093
        ]);

        $request->headers->set('Authorization', "Bearer $token");
        $res = $this->reportService->insertReport($request);
        $this->assertInsertReport($res);
        $res = $this->reportService->insertReport($request);
        $this->assertInsertReport($res);
        $this->assertTrue($res['reincidencia']);
    }

    public function testUpdateReportType()
    {
        $testReport = Reporte::first();
        $updatedReport = $this->reportService->updateReportType($testReport->id,
            DatabaseEnums::RT_BASURA);
        $this->assertEquals(DatabaseEnums::RT_BASURA, $updatedReport->tipo);
    }

    public function testDeleteReport()
    {
        $reportCount = Reporte::count();
        $testReport = Reporte::first();
        $updatedReport = $this->reportService->deleteReport($testReport->id);
        $newReportCount = Reporte::count();
        $this->assertEquals($reportCount - 1, $newReportCount);
    }

    public function testGetPendingFeedback()
    {
        $feedbacks = $this->reportService->getPendingFeedback();
        $this->assertGreaterThanOrEqual(0, count($feedbacks));
        $feedbacks = $this->reportService->getPendingFeedback();
        $this->assertCount(0, $feedbacks);
    }

    public function testInsertFeedback()
    {
        $testReport = Reporte::first();
        $fields = [
            'reporte_id' => $testReport->id,
            'estatus' => DatabaseEnums::RE_PROGRESO,
            'mensaje' => 'Estamos trabajando'
        ];
        $this->reportService->getPendingFeedback();
        $this->reportService->insertFeedback($fields);
        $newFeedbacks = $this->reportService->getPendingFeedback();
        $this->assertEquals(1, count($newFeedbacks));
    }

    public function testDeleteFeedback()
    {
        $testFeedback = SeguimientoReporte::first();
        $result = $this->reportService->deleteFeedback($testFeedback->id);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('query_status', $result);
        $this->assertIsNumeric($result['query_status']);
        $this->assertEquals(1, $result['query_status']);
    }
}
