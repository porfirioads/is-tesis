<?php

namespace App\Http\Validators;

use App\Services\DatabaseEnums;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        // @codeCoverageIgnoreStart
        try {
            $this->prepareValidations();
        } catch (Exception $e) {
            Log::error($e);
            return false;
        }
        // @codeCoverageIgnoreEnd

        $validator = Validator::make(
            $this->request->all(),
            $this->validations,
            $this->getValidationMessages()
        );

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

        // @codeCoverageIgnoreStart
        throw new Exception('prepareValidations() aún no está implementado');
        // @codeCoverageIgnoreEnd
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
            'estatus.in' => 'El estatus es inválido',
            // mensaje
            'mensaje.required' => 'El mensaje es requerido',
            'mensaje.max' => 'El mensaje debe contener máximo 500 caracteres',
            // seguimiento_id
            'seguimiento_id.required' => 'El id del seguimiento es requerido',
            'seguimiento_id.exists' => 'El id debe corresponder a un seguimiento existente',
            // beneficiario_id
            'beneficiario_id.required' => 'El id del beneficiario es requerido',
            'beneficiario_id.exists' => 'El id debe corresponder a un beneficiario existente',
            // apoyo_secretaria_id
            'apoyo_secretaria_id.required' => 'El id del apoyo de secretaría es requerido',
            'apoyo_secretaria_id.exists' => 'El id debe corresponder a un apoyo de secretaría existente',
            // fecha_solicitud
            'fecha_solicitud.date_format' => 'El formato de la fecha de entrega es inválido',
            // fecha_aceptacion
            'fecha_aceptacion.date_format' => 'El formato de la fecha de entrega es inválido',
            'fecha_aceptacion.required_if' => 'La fecha de aceptación es requerida',
            // fecha_entrega
            'fecha_entrega.date_format' => 'El formato de la fecha de entrega es inválido',
            'fecha_entrega.required_if' => 'La fecha de entrega es requerida',
            // solicitud_id
            'solicitud_id.required' => 'El id de la solicitud es requerido',
            'solicitud_id.exists' => 'El id debe corresponder a una solicitud existente',
            // nombre
            'nombre.required' => 'El nombre es requerido',
            // primer_apellido
            'primer_apellido.required' => 'El primer apellido es requerido',
            // sexo
            'sexo.required' => 'El sexo es requerido',
            // telefono
            'telefono.required' => 'El telefono es requerido',
            // nombre_vialidad
            'nombre_vialidad.required' => 'El nombre de la vialidad es requerido',
            // numero_exterior
            'numero_exterior.required' => 'El número exterior es requerido',
            // colonia
            'colonia.required' => 'La colonia es requerida',
            // curp
            'curp.required' => 'La curp es requerida',
            'curp.unique' => 'La curp proporcionada ya existe',
            'curp.exists' => 'La curp proporcionada no existe',
        ];

        $customMessages = [];

        foreach ($this->validations as $field => $validations) {
            foreach ($validations as $validation) {
                if (gettype($validation) !== gettype('')) {
                    // @codeCoverageIgnoreStart
                    continue;
                    // @codeCoverageIgnoreEnd
                }

                $validationParts = explode(':', $validation);
                $validationType = $validationParts[0];

                $validationParameter =
                    count($validationParts) > 1 ? $validationParts[1] : false;

                // @codeCoverageIgnoreStart
                try {
                    $customMessages["$field.$validationType"] =
                        $messages["$field.$validationType"];
                } catch (Exception $e) {
                    $customMessages["$field.$validationType"] = $e->getMessage();
                }
                // @codeCoverageIgnoreEnd

                if ($validationParameter) {
                    $customMessages["$field.$validationType"] =
                        str_replace(
                            '{value}',
                            $validationParameter,
                            $customMessages["$field.$validationType"]
                        );
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

    protected function getFieldMaxSize($table, $field)
    {
        $columns = DB::select(DB::raw("SHOW COLUMNS FROM `$table`"));

        foreach ($columns as $column) {
            if ($column->Field === $field) {
                $openParPos = strpos($column->Type, '(');
                $closeParPos = strpos($column->Type, ')');
                $size = $closeParPos - $openParPos;
                $max = intval(substr($column->Type, $openParPos + 1, $size - 1));
                return $max;
            }
        }
    }
}
