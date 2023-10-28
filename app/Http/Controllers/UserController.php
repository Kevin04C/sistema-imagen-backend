<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorResponseHtpp;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers()
    {
        try {
            $users = Usuario::all();
            return response()->json([
                'type' => 'success',
                'message' => [],
                'data' => new UserCollection($users)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'type' => 'error',
                'message' => ['Error interno del servidor'],
                'data' => null
            ], 500);
        }
    }

    public function getUser(Request $request)
    {
        try {

            $user = Usuario::find((int) $request->id);
            if (!$user) {
                return response()->json([
                    'type' => 'error',
                    'message' => ['Usuario no encontrado'],
                    'data' => null
                ], 404);
            }

            return response()->json([
                'type' => 'success',
                'message' => [],
                'data' => new UserResource($user)

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'type' => 'error',
                'message' => ['Error interno del servidor'],
                'data' => null
            ], 500);
        }
    }

    public function updateUser(UpdateUserRequest $request)
    {
        try {
            $user = Usuario::find((int) $request->id);

            if (!$user) {
                return response()->json([
                    'type' => 'error',
                    'message' => ['Usuario no encontrado'],
                    'data' => null
                ], 404);
            }

            $user->correo = $request->correo;
            $user->activo = $request->activo;
            $user->save();

            return response()->json([
                'type' => 'success',
                'message' => ['Actulizar usuario'],
                'data' => new UserResource($user)
            ]);
        } catch (\Throwable $th) {
            throw new ErrorResponseHtpp(500);
        }
    }

    public function deleteUser(Request $request)
    {
        try {
            // verifica si el usuario no tiene ventas registradas   
            $user = Usuario::find((int) $request->id);
            if (!$user) {
                return response()->json([
                    'type' => 'error',
                    'message' => ['Usuario no encontrado'],
                    'data' => null
                ], 404);
            }

            $user->delete();
            


        } catch (\Throwable $th) {
            throw new ErrorResponseHtpp(500);
        }
    }
}
