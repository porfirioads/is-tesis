<?php

namespace App\Services;

use App\Models\IncidenciaReporte;
use App\Models\Reporte;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Log;

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
     * Inserta un reporte, agrega incidencia y guarda su evidencia.
     *
     * @param Request $request
     */
    public function insertReport(Request $request)
    {
        $username = JwtService::getInstance()
            ->decrypt($request->bearerToken())['username'];
        $user = Usuario::whereUsername($username)->first();

        // Prepara los reportes y datos de la request.
        $reportes = Reporte::where('estatus', '<>', DatabaseEnums::RE_ATENDIDO)
            ->get();
        $fields = $request->all();
        $reporteExistente = null;
        $reincidencia = false;

        // Busca si existe un reporte cercano.
        foreach ($reportes as $reporte) {
            $distance = $this->distance($reporte->lat, $reporte->lng,
                $fields['lat'], $fields['lng'], 'M');

            if ($distance <= 15) {
                $reporteExistente = $reporte;
                $reincidencia = true;
                break;
            }
        }

        $reporte = $reporteExistente;
        $incidencia = new IncidenciaReporte();

        // Asigna datos correspondientes a si es reporte nuevo o reincidencia.
        if ($reporte) {
            $reporte->incidencias += 1;
            $incidencia->fecha = Carbon::now()->format('Y-m-d H:i:s');
        } else {
            $reporte = new Reporte($request->all());
            $reporte->fecha = Carbon::now()->format('Y-m-d H:i:s');
            $reporte->direccion = 'Unknown'; // TODO: Completar.
            $reporte->incidencias = 0;
            $reporte->estatus = DatabaseEnums::RE_PENDIENTE;
            $incidencia->fecha = $reporte->fecha;
        }

        $reporte->save();

        # Guarda datos de la incidencia.
        $fotoPath = Storage::disk('public')->put('reportes', $request->file('foto'));
        $incidencia->foto = $fotoPath;
        $incidencia->comentario = $request->post('comentario', null);
        $incidencia->reporte_id = $reporte->id;
        $incidencia->usuario_id = $user->id;
        $incidencia->save();

        return [
            'reporte_id' => $reporte->id,
            'incidencia_id' => $incidencia->id,
            'reincidencia' => $reincidencia
        ];
    }

    /**
     * Calcula la distancia entre dos coordenadas.
     *
     * @param $lat1
     * @param $lon1
     * @param $lat2
     * @param $lon2
     * @param $unit string Unidad de medida de la distancia (K - kilómetros,
     *                     M - metros).
     * @return float|int
     */
    private function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +
                cos(deg2rad($lat1)) * cos(deg2rad($lat2))
                * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "M") {
                return ($miles * 1.609344 * 1000);
            } else {
                return $miles;
            }
        }
    }

    public function updateReportType($reporteId, $tipoReporte)
    {
        $reporte = Reporte::find($reporteId);
        $reporte->tipo = $tipoReporte;
        $reporte->save();
        return $reporte;
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
