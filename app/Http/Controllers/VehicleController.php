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
        //pegar todos os carros do usuário
    $vehicles = Vehicle::where('user_id',Auth::user()->id)->get();
    foreach($vehicles as $vehicle){
        $photos = $vehicle->photos_path;
        foreach($photos as $key => $photo){
            $photos[$key]=Storage::url($photo);
            }
    $vehicle->photos_path=$photos;
    }
    return response($vehicles,200);
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
            "model"=>$request->input('model'),
            "color"=>$request->input('color'),
            "aditional"=>$request->input('aditional'),
            "photos_path"=>$array_paths,
            "capacity"=>$request->input('capacity'),
            // "status"=>$request->input('status'),
        ]);
   
        return response()->json(['vehicle'=>$vehicle]);
    }
    public function show(){
        //mostra um carro
    }
    public function edit(){
    // $vehicles = Vehicle::where('user_id',Auth::user()->id);
    //     return response($vehicles,200);
    }
    public function update(Request $request){
        //pegar todos os carros
        return response()->json(['dados'=>$request->all()]);
    }
    
    public function destroy(){
        //deletar carro
    }

    public function destroyPhoto(){
    //deletar foto
    }
}
