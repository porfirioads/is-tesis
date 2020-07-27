<?php

namespace App\Services;

/**
 * Template para la creación de servicios en la aplicación.
 */
class BaseService
{
    private $errors;

    public function __construct()
    {
        $this->resetErrors();
    }

    public function withoutErrors()
    {
        return count($this->errors) === 0;
    }

    public function resetErrors()
    {
        return $this->errors = [];
    }

    public function addError($key, $message)
    {
        $this->errors[$key] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
