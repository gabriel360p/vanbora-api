<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//rotas de autenticação
Route::post('/cadastro',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);



// "name":"",
// "email":"",
// "password":"",
// "avatar":"",
// "cpf":"",
// "phone1":"",
// "phone2":"",
// "role":""