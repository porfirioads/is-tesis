<?php

namespace App\Http\Validators;

/**
 * Contiene las validaciones para la autenticación de usuarios.
 */
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
