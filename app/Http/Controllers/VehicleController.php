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
        Vehicle::create($request->all());
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
