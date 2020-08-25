<?php

namespace App\Http\Validators;

use App\Models\BenBeneficiario;

class SearchBeneficiaryValidator extends RequestValidator
{
    public function prepareValidations()
    {
        $table = (new BenBeneficiario())->getTable();

        $this->validations = [
            'curp' => [
                'nullable',
                "exists:$table,curp"
            ],
            'colonia' => [
                'nullable',
                "exists:$table,colonia"
            ],
        ];
    }
}
