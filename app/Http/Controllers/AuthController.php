<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{

 
    public function register(Request $request)
    {

        $user = User::create([
            "name"=>$request->input('name'),
            "email"=>$request->input('email'),
            "password"=>Hash::make( $request->input('password')),
            "avatar"=>$request->input('avatar'),
            "cpf"=>$request->input('cpf'),
            "phone1"=>$request->input('phone1'),
            "phone2"=>$request->input('phone2'),
            "role"=>$request->input('role')
        ]);
             Auth::login($user);
             $token = JWTAuth::fromUser($user);
            return response(json_encode($user),200)->header('Authorization','Bearer ',$token)->header('user_id',$user->id);

    }

       public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user){
             $user = User::where('cpf', $request->email)->first();
        }
        if($user && Hash::check($request->input('password'), $user->password)) {
            // return response(json_encode($user),200)->header('Authorization:',' Bearer 123');
             Auth::login($user);
             $token = JWTAuth::fromUser($user);

             $userData=(object) [
                'name'=>$user->name,
                'email'=>$user->email,
                'avatar'=>$user->avatar,
                'phone1'=>$user->phone1,
                'phone2'=>$user->phone2,
                'cpf'=>$user->cpf,
                'role'=>$user->role,
                // 'trips'=>$user->trips,
                // 'vehicles'=>$user->vehicles,
             ];

            return response(json_encode($userData),200)->cookie(
                'access_token',
                $token,
                60,
                '/',
                null,
                true,
                true,    //marca como httpOnly
            );
        }else{
            // var_dump($user);
            return response('Usuário não encontrado',401);
        }
    }
    public function logout(){
        Auth::logout();
        return response('Logout realizado',200);
    }
}
