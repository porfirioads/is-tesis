<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Services\ReportService;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function getReports(Request $request)
    {
        $reports = ReportService::getInstance()->getReports();
        return JsonResponse::ok($reports);
    }
}
