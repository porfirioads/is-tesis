<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\ObjectFactory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = ObjectFactory::getUserService();
    }

    public function login(Request $request)
    {
        $validator = ObjectFactory::getLoginValidator($request);

        if (!$validator->validate()) {
            return JsonResponse::error($validator->getErrors(), 400);
        }

        $username = $request['username'];
        $password = $request['password'];
        $user = $this->userService->getByCredentials($username, $password);

        if (!$user) {
            return JsonResponse::error(['auth' => 'Credenciales inválidas'], 401);
        }

        $token = ObjectFactory::getJwtService()->generate($username);
        return JsonResponse::ok(['token' => $token, 'usuario' => $user]);
    }

//    /**
//     * Autentica al usuario.
//     *
//     * @param Request $request
//     * @return \Illuminate\Http\JsonResponse|object
//     * @throws \ReallySimpleJWT\Exception\ValidateException
//     */
//    public function login(Request $request)
//    {
//        $validator = ObjectFactory::getLoginValidator($request);
//
//        if (!$validator->validate()) {
//            return JsonResponse::error($validator->getErrors(), 400);
//        }
//
//        $username = $request['username'];
//        $password = $request['password'];
//        $user = $this->userService->getByCredentials($username, $password);
//
//        if (!$user) {
//            return JsonResponse::error(['auth' => 'Credenciales inválidas'], 401);
//        }
//
//        $token = ObjectFactory::getJwtService()->generate($username);
//        return JsonResponse::ok([
//            'token' => $token,
//            'usuario' => $user
//        ]);
//    }
}
