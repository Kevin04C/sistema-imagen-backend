<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorResponseHtpp;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        try {
            $password_hash = Hash::make($request->contrasena);
            $user = Usuario::create([
                'nombre' => $request->nombre,
                'apellidos' => $request->apellidos,
                'dni' => $request->dni,
                'correo' => $request->correo,
                'contrasena' => $password_hash,
            ]);

            $user->roles()->attach($request->roles_id);
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'type' => 'success',
                'messages' => ['Usuario registrado correctamente'],
                'data' => new UserResource($user),
                'token' => $token
            ]);
        } catch (\Throwable $th) {
            throw new ErrorResponseHtpp(500);
        }
    }

    public function login()
    {
        try {
            $crendentials = request(['correo', 'contrasena']);
            $user = Usuario::where('correo', $crendentials['correo'])->first();

            if (!$user) {
                return response()->json([
                    'type' => 'error',
                    'messages' => ['Correo o contraseña incorrectas'],
                    'data' => null
                ], 401);
            }

            $match_password = Hash::check($crendentials['contrasena'], $user->contrasena);
            if (!$match_password) {
                return response()->json([
                    'type' => 'error',
                    'message' => ['Correo o contraseña incorrectas'],
                    'data' => null
                ], 401);
            }
            $token = auth()->login($user);
            return response()->json([
                'type' => 'success',
                'messages' => [],
                'data' => new UserResource($user),
                'token' => $token
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'type' => 'error',
                'message' => ['Error interno del servidor'],
                'data' => null
            ], 500);
        }
    }
    public function renewToken(Request $request)
    {
        try {
            $header_token = $request->header('Authorization');
            if (!$header_token || is_null($header_token)) {
                return response()->json([
                    'type' => 'error',
                    'messages' => ['No existe token en la petición'],
                    'data' => []
                ], 401);
            }

            if (!str_starts_with($header_token, 'Bearer ')) {
                return response()->json([
                    'type' => 'error',
                    'message' => ['Token no valido'],
                    'data' => []
                ], 401);
            }

            $user = auth()->user();
            $renew_token = JWTAuth::parseToken()->refresh();
            return response()->json([
                'type' => 'success',
                'messages' => [],
                'data' => new UserResource($user),
                'token' => $renew_token,
            ]);
        } catch (\Throwable $th) {
            throw new ErrorResponseHtpp(500);
        }
    }
}
