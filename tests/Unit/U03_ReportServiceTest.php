<?php

namespace Tests\Unit;

use App\Services\ReportService;
use Tests\DatabaseTestCase;

class U03_ReportServiceTest extends DatabaseTestCase
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
