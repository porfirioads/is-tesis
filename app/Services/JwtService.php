<?php

namespace App\Services;

use App\Http\Responses\JsonResponse;
use ReallySimpleJWT\Token;

/**
 * Lleva a cabo el manejo de los Json Web Tokens en la aplicación.
 */
class JwtService extends BaseService
{
    private const SECRET = '$This.is.the.53CR3T.TESIS.TDD$';
    private static $instance = null;

    protected function __construct()
    {
        parent::__construct();
    }

    /**
     * Realiza la validación de un token.
     *
     * @param $token
     * @return bool
     */
    public function validate($token)
    {
        $this->resetErrors();

        if (!$token) {
            $this->addError('auth', 'El token de autenticación es requerido');
            return $this->withoutErrors();
        }

        $result = Token::validate($token, self::SECRET);

        if (!$result) {
            $this->addError('auth', 'El token de autenticación es inválido');
        }

        return $this->withoutErrors();
    }

    /**
     * Descifra un JWT y devuelve su contenido.
     *
     * @param $token
     * @return array|null
     */
    public function decrypt($token)
    {
        $valid = Token::validate($token, self::SECRET);

        if ($valid) {
            return Token::getPayload($token, self::SECRET);
        }

        return null;
    }

    /**
     * Genera un token.
     *
     * @param $username
     * @return string
     * @throws \ReallySimpleJWT\Exception\ValidateException
     */
    public function generate($username)
    {
        $timestamp = time();

        $payload = [
            'iat' => $timestamp,
            'uid' => $timestamp,
            // 'exp' => $timestamp + 3600,
            'iss' => 'localhost',
            'username' => $username
        ];

        return Token::customPayload($payload, self::SECRET);
    }

    /**
     * Obtiene una instancia única de la clase.
     *
     * @return JwtService
     */
    public static function getInstance(): JwtService
    {
        if (!JwtService::$instance) {
            JwtService::$instance = new JwtService();
        }
        return JwtService::$instance;
    }
}
