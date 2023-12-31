<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/autos",[AutoController::class,"ListarTodos"]);

Route::get("/autos/{d}",[AutoController::class,"ListarUno"]);

Route::delete("/autos/{d}",[AutoController::class,"EliminarUno"]);

Route::post("/autos",[AutoController::class,"Insertar"]);

Route::post("/autos/{d}",[AutoController::class,"ModificarUno"]);
