<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
   function update(Request $request){
    $user = Auth::user();
    if($request->input('name')!=null) $user->update(['name'=>$request->input('name')]);
    if($request->input('email')!=null) $user->update(['email'=>$request->input('email')]);
    if($request->input('cpf')!=null)  $user->update(['cpf'=>$request->input('cpf')]);
    if($request->input('phone1')!=null)$user->update(['phone1'=>$request->input('phone1')]);
    if($request->input('phone2')!=null)$user->update(['phone2'=>$request->input('phone2')]);
    
    $password = trim($request->input('password'));
    if($password!=null){
         $hash = Hash::make($request->input('password'));
         $user->update(['password'=>$hash]);
       }
   return response($user,200);

   //  return response()->json(['teste'=>$request->input('password')]);
   //  if($request->input('password')!=null) 
   }
}
