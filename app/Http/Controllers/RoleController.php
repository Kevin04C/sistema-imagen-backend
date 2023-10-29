<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorResponseHtpp;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function getRoles(Request $roles)
    {
        try {
            $roles = Role::all();
            return response()->json([
                'type' => 'success',
                'messages' => [],
                'data' => $roles
            ]);
        } catch (\Throwable $th) {
            throw new ErrorResponseHtpp(500);
        }
    }
}
