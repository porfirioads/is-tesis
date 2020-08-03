<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Http\Validators\LoginValidator;
use App\Models\Usuario;
use App\ObjectFactory;
use App\Services\JwtService;
use App\Services\UserService;
use Illuminate\Http\Request;

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
        $usuarios = UserService::getInstance()->getAll();
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
        $validator = new LoginValidator($request);

        if (!$validator->validate()) {
            return JsonResponse::error($validator->getErrors(), 400);
        }

        $username = $request['username'];
        $password = $request['password'];
        $user = UserService::getInstance()->getByCredentials($username, $password);

        if (!$user) {
            return JsonResponse::error(['auth' => 'Credenciales inválidas'], 401);
        }

        $token = ObjectFactory::getJwtService()->generate($username);
        return JsonResponse::ok([
            'token' => $token,
            'usuario' => $user
        ]);
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
