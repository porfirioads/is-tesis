<?php

namespace App\Http\Validators;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

/**
 * Base para la implementación de validadores para las requests.
 */
class RequestValidator
{
    protected $request;
    protected $validations;
    protected $errors;
    protected $messages = [
        'username.required' => 'El nombre de usuario es requerido.',
        'username.min' => 'El nombre de usuario debe tener mínimo {value} caracteres.',
        'username.max' => 'El nombre de usuario debe tener máximo {value} caracteres.',
        'username.unique' => 'El nombre de usuario ya se encuentra en uso.',
        'password.required' => 'La contraseña es requerida.',
    ];

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->errors = [];
    }

    /**
     * Aplica las validaciones de la request.
     *
     * @return bool
     */
    public function validate()
    {
        $this->errors = [];

        try {
            $this->prepareValidations();
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }

        $validator = Validator::make($this->request->all(), $this->validations,
            $this->getValidationMessages());

        if ($validator->passes()) {
            return true;
        }

        $fieldsWithError = $validator->errors()->keys();

        foreach ($fieldsWithError as $field) {
            $this->errors[$field] = [];

            $fieldErrors = $validator->errors()->get($field);

            foreach ($fieldErrors as $error) {
                array_push($this->errors[$field], $error);
            }
        }

        return false;
    }

    /**
     * Prepara las validaciones que se aplicarán en la request.
     *
     * @throws Exception
     */
    protected function prepareValidations()
    {
        throw new Exception('prepareValidations() aún no está implementado');
    }

    /**
     * Obtiene los mensajes de validación correspondientes a las validaciones
     * que se realizan.
     *
     * @return array
     */
    protected function getValidationMessages()
    {
        $customMessages = [];

        foreach ($this->validations as $field => $validations) {
            foreach ($validations as $validation) {
                if (gettype($validation) !== gettype('')) continue;

                $validationParts = explode(':', $validation);
                $validationType = $validationParts[0];

                $validationParameter =
                    count($validationParts) > 1 ? $validationParts[1] : false;

                try {
                    $customMessages["$field.$validationType"] =
                        $this->messages["$field.$validationType"];
                } catch (Exception $e) {
                    $customMessages["$field.$validationType"] = $e->getMessage();
                }

                if ($validationParameter) {
                    $customMessages["$field.$validationType"] =
                        str_replace('{value}', $validationParameter,
                            $customMessages["$field.$validationType"]);
                }
            }
        }

        return $customMessages;
    }

    /**
     * Obtiene los errores arrojados durante la validación de la request.
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

}
