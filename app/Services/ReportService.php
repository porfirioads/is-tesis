<?php

namespace App\Services;

use App\Models\Reporte;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Maneja acciones de base de datos de los reportes.
 *
 * Class ReportService
 * @package App\Services
 */
class ReportService extends BaseService
{
    private static $instance = null;

    /**
     * Obtiene la lista de reportes.
     *
     * @return Reporte[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getReports()
    {
        return Reporte::with(['seguimientos', 'incidencias'])->get();
    }

    /**
     * Obtiene una instancia única de la clase.
     *
     * @return ReportService
     */
    public static function getInstance(): ReportService
    {
        if (!ReportService::$instance) {
            ReportService::$instance = new ReportService();
        }

        return ReportService::$instance;
    }
}
