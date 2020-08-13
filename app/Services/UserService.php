<?php

namespace App\Services;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
     * Consulta la lista de usuarios de acuerdo a un conjunto de condiciones.
     *
     * @param array $wheres
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    private function get($wheres = [])
    {
        $usuarios = Usuario::with('roles.secretaria');

        if (count($wheres) > 0) {
            $usuarios = $usuarios->where($wheres);
        }

        return $usuarios->get();
    }

    /**
     * Obtiene la lista de usuarios.
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getAll()
    {
        return $this->mapUser($this->get());
    }

    /**
     * Obtiene un usuario por medio de sus credenciales.
     *
     * @param $username
     * @param $password
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getByCredentials($username, $password)
    {
        $usuarios = $this->get([['username', '=', $username]]);

        Log::debug($usuarios);

        if (!count($usuarios) || !Hash::check($password, $usuarios->first()->password)) {
            return null;
        }

        return $this->mapUser($usuarios)->first();
    }

    /**
     * Mapea la información de los usuarios de acuerdo a la información final
     * que se devolverá.
     *
     * @param $usuarios
     * @return mixed
     */
    private function mapUser($usuarios)
    {
        return $usuarios->map(function ($u) {
            return [
                'id' => $u['id'],
                'username' => $u['username'],
                'nombre' => $u['nombre'],
                'primer_apellido' => $u['primer_apellido'],
                'segundo_apellido' => $u['segundo_apellido'],
                'email' => $u['email'],
                'roles' => $u['roles']->map(function ($r) {
                    return [
                        'rol' => $r['rol'],
                        'secretaria' => $r['secretaria']['nombre']
                    ];
                })
            ];
        });
    }

    // @codeCoverageIgnoreStart
    /**
     * Obtiene una instancia única de la clase.
     *
     * @return UserService
     */
    public static function getInstance(): UserService
    {
        if (!UserService::$instance) {
            UserService::$instance = new UserService();
        }

        return UserService::$instance;
    }
    // @codeCoverageIgnoreEnd
}
