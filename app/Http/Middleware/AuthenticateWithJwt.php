<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthenticateWithJwt
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //recuperando o token de acesso
        $recoveryToken=$request->cookie("access_token");

        //caso o token não seja recuperado com sucesso
        if (!$recoveryToken)return response()->json(["message"=>"Token não informado"],401);
    
        try {
            //Aqui estou definindo qual token o jwt deve usar como contexto
            JWTAuth::setToken($recoveryToken);

            //Aqui estou validando o token e recuperando o usuário
            $user = JWTAuth::authenticate($recoveryToken);

            //se user está vazio, então o jwt não conseguiu recuperar o usuário
            if(!$user) return response()->json(["message"=>"Usuário não autenticado"],401);
            
            //se user não está vazio, então eu adicione ele a um espaço na própria request
            $request->setUserResolver(fn () => $user);

            //user não está vazio, logo o token é válido e o usuário pode seguir acessando o recurso
            return $next($request);

        } catch (\Exception $e) {

            //token inválido ou expirado
            return response()->json([
                'message' => 'Token inválido ou expirado'
            ], 401);
        }
    }
}
