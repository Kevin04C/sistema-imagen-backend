<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'getUsers']);
Route::get('/users/{id}', [UserController::class, 'getUser']);
Route::put("users/{id}", [UserController::class, "updateUser"]);
Route::put("users/update-password/{id}", [UserController::class, "updatePassword"]);

Route::get('/roles', [RoleController::class, 'getRoles']);

Route::post("/auth/register", [AuthController::class, 'register']);
Route::post("/auth/login", [AuthController::class, 'login']);
Route::get("/auth/renew", [AuthController::class, 'renewToken']);


Route::get('/products', [ProductController::class, 'getProducts']);
Route::post('/products', [ProductController::class, 'createProduct']);
Route::get('/products/{id}', [ProductController::class, 'getProductById']);

Route::get('/categories', [CategoryController::class, 'getCategories']);
