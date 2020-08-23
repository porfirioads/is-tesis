<?php

namespace App\Http\Validators;

use App\Models\BenBeneficiario;

class InsertBeneficiaryValidator extends RequestValidator
{
    public function prepareValidations()
    {
        $table = (new BenBeneficiario())->getTable();

        $this->validations = [
            'nombre' => [
                'required',
                'max:' . $this->getFieldMaxSize($table, 'nombre')
            ],
            'primer_apellido' => [
                'required',
                'max:' . $this->getFieldMaxSize($table, 'primer_apellido')
            ],
            'segundo_apellido' => [
                'max:' . $this->getFieldMaxSize($table, 'segundo_apellido')
            ],
            'sexo' => [
                'required',
                'in:M,F'
            ],
            'curp' => [
                'required',
                'max:' . $this->getFieldMaxSize($table, 'curp'),
                "unique:$table"
            ],
            'telefono' => [
                'required',
                'max:' . $this->getFieldMaxSize($table, 'telefono')
            ],
            'nombre_vialidad' => [
                'required',
                'max:' . $this->getFieldMaxSize($table, 'nombre_vialidad')
            ],
            'numero_exterior' => [
                'required',
                'max:' . $this->getFieldMaxSize($table, 'numero_exterior')
            ],
            'numero_interior' => [
                'max:' . $this->getFieldMaxSize($table, 'numero_exterior')
            ],
            'colonia' => [
                'required',
                'max:' . $this->getFieldMaxSize($table, 'colonia')
            ],
        ];
    }
}
