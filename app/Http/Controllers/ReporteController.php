<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Http\Validators\DeleteFeedbackValidator;
use App\Http\Validators\DeleteReportValidator;
use App\Http\Validators\InsertFeedbackValidator;
use App\Http\Validators\InsertReportValidator;
use App\Http\Validators\UpdateTipoReporteValidator;
use App\Services\ReportService;
use Illuminate\Http\Request;

/**
 * Controla las requests relacionadas a los reportes.
 */
class ReporteController extends Controller
{
    private $reportService;

    public function __construct($reportService = null)
    {
        if (!$reportService) {
            $reportService = ReportService::getInstance();
        }

        $this->reportService = $reportService;
    }

    public function getReports(Request $request)
    {
//        $reportService = ReportService::getInstance();
        $reports = $this->reportService->getReports();
        return JsonResponse::ok($reports);
    }

    public function insertReport(Request $request)
    {
        $validator = new InsertReportValidator($request);

        if (!$validator->validate()) {
            return JsonResponse::error($validator->getErrors(), 400);
        }

        $result = ReportService::getInstance()->insertReport($request);

        return JsonResponse::ok($result);
    }

    public function updateReportType(Request $request)
    {
        $validator = new UpdateTipoReporteValidator($request);

        if (!$validator->validate()) {
            return JsonResponse::error($validator->getErrors(), 400);
        }

        $reporteId = $request->post('reporte_id', null);
        $tipo = $request->post('tipo', null);
        $result = ReportService::getInstance()
            ->updateReportType($reporteId, $tipo);

        return JsonResponse::ok($result);
    }

    public function deleteReport(Request $request)
    {
        $validator = new DeleteReportValidator($request);

        if (!$validator->validate()) {
            return JsonResponse::error($validator->getErrors(), 400);
        }

        $reporteId = $request->post('reporte_id', null);
        $result = ReportService::getInstance()->deleteReport($reporteId);

        return JsonResponse::ok($result);
    }

    public function getPendingFeedback(Request $request)
    {
        $result = ReportService::getInstance()->getPendingFeedback();
        return JsonResponse::ok($result);
    }

    public function insertFeedback(Request $request)
    {
        $validator = new InsertFeedbackValidator($request);

        if (!$validator->validate()) {
            return JsonResponse::error($validator->getErrors(), 400);
        }

        $result = ReportService::getInstance()->insertFeedback($request->all());

        return JsonResponse::ok($result);
    }

    public function deleteFeedback(Request $request)
    {
        $validator = new DeleteFeedbackValidator($request);

        if (!$validator->validate()) {
            return JsonResponse::error($validator->getErrors(), 400);
        }

        $result = ReportService::getInstance()
            ->deleteFeedback($request->post('seguimiento_id'));

        return JsonResponse::ok($result);
    }
}
