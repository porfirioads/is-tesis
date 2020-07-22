<?php

namespace App\Http\Validators;

use App\Services\DatabaseEnums;
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
        $messages = [
            // username
            'username.required' => 'El nombre de usuario es requerido.',
            'username.min' => 'El nombre de usuario debe tener mínimo {value} caracteres.',
            'username.max' => 'El nombre de usuario debe tener máximo {value} caracteres.',
            'username.unique' => 'El nombre de usuario ya se encuentra en uso.',
            // password
            'password.required' => 'La contraseña es requerida.',
            // fecha
            'fecha.required' => 'La fecha es requerida.',
            'fecha.date_format' => 'El formato de la fecha es incorrecto.',
            // lat
            'lat.required' => 'La latitud es requerida.',
            'lat.numeric' => 'La latitud debe ser numérica.',
            'lat.between' => 'La latitud debe tener un valor entre -90 y 90',
            // lng
            'lng.required' => 'La longitud es requerida.',
            'lng.numeric' => 'La longitud debe ser numérica.',
            'lng.between' => 'La longitud debe tener un valor entre -180 y 180',
            // tipo
            'tipo.required' => 'El tipo es requerido',
            'tipo.in' => 'El tipo debe ser alguno de los siguientes: ' .
                implode(', ', DatabaseEnums::REPORTE_TIPO),
            // direccion
            'direccion.alpha_num' => 'La dirección debe contener caracteres alfanuméricos.',
            // foto
            'foto.required' => 'La fotografía es requerida',
            'foto.image' => 'La fotografía debe ser una imagen',
            // reporte_id
            'reporte_id.required' => 'El id del reporte es requerido',
            'reporte_id.exists' => 'El id debe corresponder a un reporte existente',
            // estatus
            'estatus.required' => 'El estatus es requerido',
            'estatus.in' => 'El estatus debe ser alguno de los siguientes: ' .
                implode(', ', DatabaseEnums::REPORTE_ESTATUS),
            // mensaje
            'mensaje.required' => 'El mensaje es requerido',
            'mensaje.max' => 'El mensaje debe contener máximo 500 caracteres',
            // seguimiento_id
            'seguimiento_id.required' => 'El id del seguimiento es requerido',
            'seguimiento_id.exists' => 'El id debe corresponder a un seguimiento existente',
        ];

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
                        $messages["$field.$validationType"];
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
