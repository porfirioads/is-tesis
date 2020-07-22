<?php

namespace App\Http\Validators;

use App\Services\DatabaseEnums;

/**
 * Validador para la inserción de feedback en los reportes.
 */
class InsertFeedbackValidator extends RequestValidator
{
    public function prepareValidations()
    {
        $this->validations = [
            'estatus' => [
                'required',
                'in:' . implode(',', DatabaseEnums::REPORTE_ESTATUS)
            ],
            'mensaje' => [
                'required',
                'max:500'
            ],
            'reporte_id' => [
                'required',
                'exists:reportes,id'
            ]
        ];
    }
}
