<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

/**
 * Maneja las requests relacionadas con los usuarios.
 */
class UsuarioController extends Controller
{
    /**
     * Autentica al usuario por medio de sus credenciales.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return JsonResponse::error([
                'login_data' => 'InvalidCredentials'
            ], 400);
        }

        return JsonResponse::ok(compact('token'));
    }

    /**
     * Obtiene los datos del usuario autenticado por medio de su token.
     */
    public function getAuthenticatedUser()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }

        return response()->json(compact('user'));
    }

    /**
     * Registra un nuevo usuario.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }
}
