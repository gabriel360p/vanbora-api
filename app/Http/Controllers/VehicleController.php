<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class VehicleController extends Controller
{
 public function index(){
        //pegar todos os carros
    }

    public function store(Request $request){
        $array_paths=[];
        if($request->hasFile('vehicle_photo')){
        
            foreach($request->file('vehicle_photo') as $file){
                if($file->isValid()){
                    $photoPATH = Storage::disk('public')->putFile('vehicles', new File($file));
                    $photoURL= Storage::url($photoPATH);

                    array_push($array_paths,$photoPATH);
        
                    }
                }
        }

        $vehicle = Vehicle::create([
            "user_id"=>Auth::user()->id,
            "plate"=>$request->input('plate'),
            "photos_path"=>$array_paths,
            "capacity"=>$request->input('capacity'),
            // "status"=>$request->input('status'),
        ]);

        
        return response()->json(['vehicle'=>$vehicle]);
    }
    public function show(){
        //pegar todos os carros
    }
    public function update(){
        //pegar todos os carros
    }

    public function updatePhoto(){
    //add novas fotos
    }
    
    public function destroy(){
        //deletar carro
    }

    public function destroyPhoto(){
    //deletar foto
    }
}
