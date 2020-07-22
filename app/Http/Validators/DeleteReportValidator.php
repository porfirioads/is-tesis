<?php

namespace App\Http\Validators;

use App\Services\DatabaseEnums;

/**
 * Contiene las validaciones para la eliminación de reportes.
 */
class DeleteReportValidator extends RequestValidator
{
    public function prepareValidations()
    {
        $this->validations = [
            'reporte_id' => [
                'required',
                'exists:reportes,id'
            ]
        ];
    }
}
