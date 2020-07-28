<?php

namespace App;

use App\Services\ReportService;
use Mockery;

class ObjectFactory
{
    public static $useMocks = false;
    public static $reportServiceMock = null;

    public static function getReportService()
    {
        if (ObjectFactory::$useMocks) {
            return ObjectFactory::$reportServiceMock;
        } else {
            return new ReportService();
        }
    }
}
