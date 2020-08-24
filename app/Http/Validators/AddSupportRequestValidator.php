<?php

namespace App\Http\Validators;

use App\Models\BenApoyoSecretaria;
use App\Models\BenBeneficiario;
use App\Services\DatabaseEnums;

class AddSupportRequestValidator extends RequestValidator
{
    public function prepareValidations()
    {
        $beneficiarioTable = (new BenBeneficiario())->getTable();
        $apoyoSecretariaTable = (new BenApoyoSecretaria())->getTable();

        $this->validations = [
            'fecha_solicitud' => [
                'nullable',
                'date_format:Y-m-d H:i:s'
            ],
            'fecha_aceptacion' => [
                'nullable',
                'date_format:Y-m-d H:i:s'
            ],
            'fecha_entrega' => [
                'nullable',
                'date_format:Y-m-d H:i:s'
            ],
            'estatus' => [
                'required',
                'in:' . implode(',', DatabaseEnums::BEN_SOLICITUD_ESTATUS)
            ],
            'monto' => [
                'nullable',
                'numeric'
            ],
            // TODO: Validar evidencia
            'beneficiario_id' => [
                'required',
                "exists:$beneficiarioTable,id"
            ],
            'apoyo_secretaria_id' => [
                'required',
                "exists:$apoyoSecretariaTable,id"
            ]
        ];
    }
}
