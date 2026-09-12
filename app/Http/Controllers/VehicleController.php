<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class VehicleController extends Controller
{
 public function index(){
        //pegar todos os carros
    }

    public function store(Request $request){
        
        if($request->hasFile('vehicle_photo')){
        
            foreach($request->file('vehicle_photo') as $file){
            if($file->isValid()){
                $photoPATH = Storage::disk('public')->putFile('vehicles', new File($file));
                $photoURL= Storage::url($photoPATH);
                }
            }
        }
                return response()->json(['path'=>$photoPATH,'url'=>$photoURL]);
    }
    public function show(){
        //pegar todos os carros
    }
    public function update(){
        //pegar todos os carros
    }

    public function destroy(){
        //deletar carro
    }

        public function destroyPhoto(){
        //deletar carro
    }
}
