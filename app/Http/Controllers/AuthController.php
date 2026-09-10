<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Route;
class AuthController extends Controller
{

    public function register(Request $request)
    {

        $avatar = $request->avatar? $request->avatar : 'foto-perfil';
                
        $user = User::create([
            "name"=>$request->input('name'),
            "email"=>$request->input('email'),
            "password"=>Hash::make( $request->input('password')),
            "cpf"=>$request->input('cpf'),
            "phone1"=>$request->input('phone1'),
            "phone2"=>$request->input('phone2'),
            "avatar"=>$avatar[0],
        ]);

        //criando e ja logando o usuário
        Auth::login($user);
        $token = JWTAuth::fromUser($user);
        return response(json_encode(Auth::user()),200)
                    ->cookie(
                        'access_token',
                        $token,
                        60,
                        '/',
                        null,
                        false, // Secure
                        true,  // HttpOnly
                        false,
                        'Lax'
                    );
    }

       public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user){
             $user = User::where('cpf', $request->email)->first();
             //A gente recuperou o usuário para validar as informações
        }
        if($user && Hash::check($request->input('password'), $user->password)) {
             Auth::login($user);
             
             //Quando vamos criar o token, a gente insere o id do usuário no token
             //dessa forma podemos usar o token pra validar se ele é válido e depois
             //recuperar o usuário usando a informação do id que está armazenado no token

             $token = JWTAuth::fromUser($user);
             
            return response(json_encode(Auth::user()),200)
            ->cookie(
                'access_token',
                $token,
                60,
                '/',
                null,
                false, // Secure
                true,  // HttpOnly
                false,
                'Lax'
            );
        }
        else{
            return response('Usuário não encontrado',401);
        }
    }
    public function logout(Request $request){

        //Deslogando o usuário dos serviços do laravel
        Auth::logout();

        //recuperando o token
        $token=$request->cookie('access_token');
        
        if ($token) {
                try {
                    JWTAuth::setToken($token);
                    //invalidando o token colocado em referência 
                    JWTAuth::invalidate();
                } catch (\Exception $e) {
                    // Token já inválido/expirado
                }
            }

        return response('Logout realizado',200)
        //mandando um comando para o navegador "apagar o token"
        ->withoutCookie('access_token');
    }
    public function update(Request $request){

    }
}
