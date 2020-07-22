<?php

namespace App\Http\Validators;

use App\Services\DatabaseEnums;
use Illuminate\Validation\Rule;

/**
 * Contiene las validaciones para la inserción de reportes.
 */
class InsertReportValidator extends RequestValidator
{
    public function prepareValidations()
    {
        // date_format:Y-m-d H:i:s
        $this->validations = [
            'tipo' => [
                'required',
                'in:' . implode(', ', DatabaseEnums::REPORTE_TIPO)
            ],
            'lat' => [
                'required',
                'numeric',
                'between:-90,90'
            ],
            'lng' => [
                'required',
                'numeric',
                'between:-180,180'
            ],
            'direccion' => [
                'alpha_num'
            ],
            'foto' => [
                'required',
                'image'
            ]
        ];
    }
}
