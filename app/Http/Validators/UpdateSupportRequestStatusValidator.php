<?php

namespace App\Http\Validators;

use App\Models\BenApoyoSecretaria;
use App\Models\BenBeneficiario;
use App\Models\BenSolicitud;
use App\Services\DatabaseEnums;

class UpdateSupportRequestStatusValidator extends RequestValidator
{
    public function prepareValidations()
    {
        $solicitudTable = (new BenSolicitud())->getTable();

        $this->validations = [
            'solicitud_id' => [
                'required',
                "exists:$solicitudTable,id"
            ],
            'estatus' => [
                'required',
                'in:' . implode(',', DatabaseEnums::BEN_SOLICITUD_ESTATUS)
            ],
            'fecha_aceptacion' => [
                'required_if:estatus,==,' . DatabaseEnums::BEN_EST_APROBADO,
                'date_format:Y-m-d H:i:s'
            ],
            'fecha_entrega' => [
                'required_if:estatus,==,' . DatabaseEnums::BEN_EST_ENTREGADO,
                'date_format:Y-m-d H:i:s'
            ]
        ];
    }
}
