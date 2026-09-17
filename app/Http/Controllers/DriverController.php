<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DriverController extends Controller
{
   function update(Request $request){
    $user = Auth::user();
    if($request->input('name')!=null) $user->name = $user->update(['name'=>$request->input('name')]);
    if($request->input('email')!=null) $user->email = $user->update(['email'=>$request->input('email')]);
    if($request->input('cpf')!=null) $user->cpf = $user->update(['cpf'=>$request->input('cpf')]);
    if($request->input('phone1')!=null) $user->phone1 = $user->update(['phone1'=>$request->input('phone1')]);
    if($request->input('phone2')!=null) $user->phone2 = $user->update(['phone2'=>$request->input('phone2')]);
    if($request->input('password')!=null) $user->password = Hash::make($user->update(['password'=>$request->input('password')]));
    return response()->json(['userUpdated'=>$user]);
   }
}
