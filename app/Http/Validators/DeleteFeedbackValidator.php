<?php

namespace App\Http\Validators;

/**
 * Validador para la eliminación de feedbacks en los reportes.
 */
class DeleteFeedbackValidator extends RequestValidator
{
    public function prepareValidations()
    {
        $this->validations = [
            'seguimiento_id' => [
                'required',
                'exists:seguimiento_reportes,id'
            ]
        ];
    }
}
