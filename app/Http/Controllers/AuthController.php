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
        
        // return response()->json([$request->all()]);
        
        $user = User::create([
            "name"=>$request->input('name'),
            "email"=>$request->input('email'),
            "password"=>Hash::make( $request->input('password')),
            "cpf"=>$request->input('cpf'),
            "phone1"=>$request->input('phone1'),
            "phone2"=>$request->input('phone2'),
            "avatar"=>$avatar[0],
        ]);
            // $userData=(object) [
            //     'user_id'=>$user->id,
            //     'name'=>$user->name,
            //     'email'=>$user->email,
            //     'avatar'=>$user->avatar,
            //     'phone1'=>$user->phone1,
            //     'phone2'=>$user->phone2,
            //     'cpf'=>$user->cpf,
            //     'role'=>$user->role,
            //     // 'trips'=>$user->trips,
            //     // 'vehicles'=>$user->vehicles,
            //  ];
             
            return response("Salvo com sucesso",201);
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
            // var_dump($user);
            return response('Usuário não encontrado',401);
        }
    }
    public function logout(){
        Auth::logout();
        return response('Logout realizado',200);
    }
}
