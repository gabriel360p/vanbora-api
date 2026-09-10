<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
 public function index(){
        //pegar todos os carros
    }

    public function store(Request $request){
        //pegar todos os carros
        // var_dump($request->input('vehicle_photo'));
        // Vehicle::create($request->all());
        return response()->json(["data"=>$request->all()],200);
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
}
