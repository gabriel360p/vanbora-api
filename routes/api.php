<?php

use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//rotas de autenticação
Route::post('/cadastro',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);


//Vou usar essa rota para servir como uma base de verdade para o meu front-end saber que
//possui alguém autenticado no sistema
Route::get('/me',function(Request $request) {

    if(!$request->user())return response()->json(['message'=>"Usuário não está autenticado"],401);
    
    //no middleware eu adicione os dados do usuário em um espaço chamado user,
    //portando agora eu posso recuperar essas informações da seguinte forma
    return response()->json(["user_authenticate"=> $request->user()],200);
})->middleware('jwt');


Route::post('/vehicle/store',[VehicleController::class,'store'])->middleware('jwt');

