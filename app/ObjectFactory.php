<?php

namespace App;

use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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

    public static function getFile(Request $request, $key)
    {
        if (ObjectFactory::$useMocks) {
            return UploadedFile::fake()->image("$key.png");
        } else {
            return $request->file($key);
        }
    }
}
