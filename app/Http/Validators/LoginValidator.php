<?php

namespace App\Http\Validators;

class LoginValidator extends RequestValidator
{
    public function prepareValidations()
    {
        $this->validations = [
            'username' => [
                'required'
            ],
            'password' => [
                'required'
            ]
        ];
    }
}
