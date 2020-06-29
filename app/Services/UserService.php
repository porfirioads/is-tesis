<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

/**
 * Maneja acciones de base de datos de los usuarios.
 *
 * Class UserService
 * @package App\Services
 */
class UserService extends BaseService
{
    private static $instance = null;

    /**
     * Obtiene un usuario por medio de sus credenciales.
     *
     * @param $username
     * @param $password
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getByCredentials($username, $password)
    {
        $usuario = Usuario::where([
            ['username', '=', $username],
        ])->first();

        if (!$usuario || !Hash::check($password, $usuario->password)) {
            return null;
        }

        return $usuario;
    }

    /**
     * Obtiene una instancia única de la clase.
     *
     * @return JwtService
     */
    public static function getInstance(): UserService
    {
        if (!UserService::$instance) {
            UserService::$instance = new UserService();
        }
        return UserService::$instance;
    }
}
