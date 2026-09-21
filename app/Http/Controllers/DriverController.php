<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class DriverController extends Controller
{
   function update(Request $request){
      
    $user = Auth::user();
    if($request->input('name')!=null) $user->update(['name'=>trim($request->input('name'))]);
    if($request->input('email')!=null) $user->update(['email'=>trim($request->input('email'))]);
    if($request->input('cpf')!=null)  $user->update(['cpf'=>trim($request->input('cpf'))]);
    if($request->input('phone1')!=null)$user->update(['phone1'=>trim($request->input('phone1'))]);
    if($request->input('phone2')!=null)$user->update(['phone2'=>trim($request->input('phone2'))]);

    //se tiver um arquivo
    if($request->hasFile('avatar')){
      //pega o arquivo
      $newPhoto = $request->file('avatar');
      //verifica se um arquivo válido
      if($newPhoto->isValid()){
         //apaga a foto antiga se existir uma foto antiga, se não tiver uma foto antiga então ele "adiciona a foto"
         if(Storage::url($user->avatar)) {Storage::disk('public')->delete($user->avatar);}
         //salva e captura o caminho para a nova foto
         $photoPATH = Storage::disk('public')->putFile('avatars', new File($newPhoto));
         //atualizando no banco de dados o caminho para a nova foto de perfil
         $user->update(['avatar'=>$photoPATH]);
      }
    }
    
    $password = trim($request->input('password'));
    if($password!=null){
         $hash = Hash::make($request->input('password'));
         $user->update(['password'=>$hash]);
       }
      $user->photoUrl=Storage::url($user->avatar);
   return response($user,200);

   }
}
