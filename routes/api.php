<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//rotas de autenticação
Route::post('/cadastro',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);

Route::get('/me',function(Request $request) {
    //no middleware eu adicione os dados do usuário em um espaço chamado user,
    //portando agora eu posso recuperar essas informações da seguinte forma
    return response()->json(["dados do usuário"=>$request->user()]);

    
})->middleware('jwt');


