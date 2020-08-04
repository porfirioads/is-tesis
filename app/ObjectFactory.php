<?php

namespace App;

use App\Http\Validators\DeleteFeedbackValidator;
use App\Http\Validators\DeleteReportValidator;
use App\Http\Validators\InsertFeedbackValidator;
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
    public static $deleteReportValidatorMock = null;
    public static $jwtServiceMock = null;
    public static $insertFeedbackValidatorMock = null;
    public static $deleteFeedbackValidatorMock = null;

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

    public static function getUpdateReportTypeValidator($request)
    {
        if (ObjectFactory::$useMocks) {
            return ObjectFactory::$updateReportTypeValidatorMock;
        } else {
            return new UpdateTipoReporteValidator($request);
        }
    }

    public static function getDeleteReportValidator($request)
    {
        if (ObjectFactory::$useMocks) {
            return ObjectFactory::$deleteReportValidatorMock;
        } else {
            return new DeleteReportValidator($request);
        }
    }

    public static function getJwtService()
    {
        return new JwtService();
    }

    public static function getInsertFeedbackValidator($request)
    {
        if (ObjectFactory::$useMocks) {
            return ObjectFactory::$insertFeedbackValidatorMock;
        } else {
            return new InsertFeedbackValidator($request);
        }
    }

    public static function getDeleteFeedbackValidator($request)
    {
        if (ObjectFactory::$useMocks) {
            return ObjectFactory::$deleteFeedbackValidatorMock;
        } else {
            return new DeleteFeedbackValidator($request);
        }
    }
}
