<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Exceptions\ErrorResponseHtpp;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;

class ProductController extends Controller
{
    public function createProduct(CreateProductRequest $request)
    {
        $imagen = $request->file('imagen');

        try {
            return response()->json([
                'type' => 'success',
                'message' => 'Producto creado correctamente',
                'data' => $imagen,
            ], 201);

        } catch (\Throwable $th) {
            throw new ErrorResponseHtpp(500);
        }
    }

}
