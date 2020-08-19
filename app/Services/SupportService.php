<?php

namespace App\Services;

use App\Models\BenSolicitud;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SupportService extends BaseService
{
    public function getSupports()
    {
        $beneficiarios = BenSolicitud::with([
            'beneficiario',
            'apoyoSecretaria.apoyo',
            'apoyoSecretaria.secretaria'
        ])->get();

        Log::debug('gdsfgdsf');
        Log::debug($beneficiarios);

        $beneficiarios = $beneficiarios->map(function ($beneficiario) {
            return [
                'id' => $beneficiario->id,
                'fecha_solicitud' => $beneficiario->fecha_solicitud,
                'fecha_aceptacion' => $beneficiario->fecha_aceptacion,
                'fecha_entrega' => $beneficiario->fecha_entrega,
                'estatus' => $beneficiario->estatus,
                'monto' => $beneficiario->monto,
                'evidencia' => $beneficiario->evidencia,
                'beneficiario' => $beneficiario->beneficiario,
                'apoyo_secretaria' => [
                    'id' => $beneficiario->apoyoSecretaria->id,
                    'tipo_apoyo' => $beneficiario->apoyoSecretaria->apoyo->nombre,
                    'secretaria' => $beneficiario->apoyoSecretaria->secretaria->nombre
                ]
            ];
        });

        return $beneficiarios;
    }

    public function addSupportRequest(array $data)
    {
        $solicitud = new BenSolicitud($data);

        if (!$solicitud->fecha_solicitud) {
            $solicitud->fecha_solicitud = Carbon::now()->format('Y-m-d H:i:s');
        }

        $solicitud->save();
        return $solicitud;
    }
}
