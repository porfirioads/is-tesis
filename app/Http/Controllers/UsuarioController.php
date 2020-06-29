<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Models\Usuario;
use App\Services\JwtService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

/**
 * Maneja las requests relacionadas con los usuarios.
 */
class UsuarioController extends Controller
{
    /**
     * Obtiene la lista de usuarios.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function getUsers(Request $request)
    {
        $usuarios = Usuario::all();
        return JsonResponse::ok($usuarios);
    }

    /**
     * Autentica al usuario.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     * @throws \ReallySimpleJWT\Exception\ValidateException
     */
    public function login(Request $request)
    {
        // TODO: Validar request.
        $username = $request['username'];
        $password = $request['password'];
        $user = UserService::getInstance()->getByCredentials($username, $password);

        if (!$user) {
            return JsonResponse::error(['auth' => 'Credenciales inválidas'], 401);
        }

        $token = JwtService::getInstance()->generate($username);
        return JsonResponse::ok(['token' => $token]);
    }

    /**
     * Prueba la validación de un token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|object
     */
    public function validateToken(Request $request)
    {
        return JsonResponse::ok(['result' => 'PRUEBA DE TOKEN EXISTOSA']);
    }
}
