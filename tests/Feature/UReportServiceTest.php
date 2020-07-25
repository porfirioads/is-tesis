<?php

namespace Tests\Feature;

use App\Services\ReportService;

class UReportServiceTest extends DatabaseTestCase
{
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
}
