<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Exceptions\ErrorResponseHtpp;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Producto;

class ProductController extends Controller
{
    public function createProduct(CreateProductRequest $request)
    {
        $imagen = $request->file('imagen');

        try {
            return response()->json([
                'type' => 'success',
                'messages' => ['Producto creado correctamente'],
                'data' => $imagen,
            ], 201);

        } catch (\Throwable $th) {
            throw new ErrorResponseHtpp(500);
        }
    }

    public function getProducts()
    {
        try {
            $products = Producto::all();
            return response()->json([
                'type' => 'success',
                'messages' => [],
                'data' => new ProductCollection($products),
            ], 200);

        } catch (\Throwable $th) {
            throw new ErrorResponseHtpp(500);
        }
    }

    public function getProductById($id)
    {
        try {
            $product = Producto::find($id);

            if (!$product) {
                throw new ErrorResponseHtpp(400, ['Producto no encontrado']);
            }

            return response()->json([
                'type' => 'success',
                'messages' => [''],
                'data' => new ProductResource($product),
            ], 200);

        } catch (\Throwable $th) {
            throw new ErrorResponseHtpp(500);
        }
    }


}
