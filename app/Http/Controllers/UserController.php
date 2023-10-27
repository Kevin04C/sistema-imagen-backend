<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Usuario;

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

    public function getUser()
    {
        try {
            $user = Usuario::find(4);
            return response()->json([
                'type' => 'success',
                'message' => [],
                'data' => new UserResource($user),

            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'type' => 'error',
                'message' => ['Error interno del servidor'],
                'data' => null
            ], 500);
        }
    }
}
