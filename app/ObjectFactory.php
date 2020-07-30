<?php

namespace App;

use App\Http\Validators\InsertReportValidator;
use App\Http\Validators\UpdateTipoReporteValidator;
use App\Services\JwtService;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

/**
 * Factory para la instanciación de objetos.
 */
class ObjectFactory
{
    public static $useMocks = false;
    public static $reportServiceMock = null;
    public static $insertReportValidatorMock = null;
    public static $updateReportTypeValidatorMock = null;
    public static $jwtServiceMock = null;

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

    public static function getInsertReportValidator($request)
    {
        if (ObjectFactory::$useMocks) {
            return ObjectFactory::$insertReportValidatorMock;
        } else {
            return new InsertReportValidator($request);
        }
    }

    public static function getUpdateReportTypeValidatorMock($request)
    {
        if (ObjectFactory::$useMocks) {
            return ObjectFactory::$updateReportTypeValidatorMock;
        } else {
            return new UpdateTipoReporteValidator($request);
        }
    }

    public static function getJwtService()
    {
        return new JwtService();
    }
}
