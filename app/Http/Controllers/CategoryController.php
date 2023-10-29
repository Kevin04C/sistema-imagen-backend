<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorResponseHtpp;
use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        try {
            $categories = Categoria::all();
            return response()->json([
                'type' => 'success',
                'messages' => [],
                'data' => $categories
            ]);

        } catch (\Throwable $th) {
            throw new ErrorResponseHtpp(500);
        }
    }
}
