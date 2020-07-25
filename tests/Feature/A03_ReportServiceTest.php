<?php

namespace Tests\Feature;

use App\Services\ReportService;

class A03_ReportServiceTest extends DatabaseTestCase
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
