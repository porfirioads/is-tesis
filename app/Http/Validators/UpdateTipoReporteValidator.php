<?php

namespace App\Http\Validators;

use App\Services\DatabaseEnums;

/**
 * Contiene las validaciones para la actualización de tipo de reporte.
 */
class UpdateTipoReporteValidator extends RequestValidator
{
    public function prepareValidations()
    {
        \Log::debug('in:' . implode(',', DatabaseEnums::REPORTE_ESTATUS));
        $this->validations = [
            'reporte_id' => [
                'required',
                'exists:reportes,id'
            ],
            'estatus' => [
                'required',
                'in:' . implode(',', DatabaseEnums::REPORTE_ESTATUS)
            ]
        ];
    }
}
