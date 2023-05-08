<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Unit;
use App\Models\Response;
use App\Models\Responder;
use App\Models\RequestsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\UserController;

class UnitController{

    public function store(Request $request){
        $fields = $request->validate([
            'name' => 'required|string|unique:units,name',
            'type' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);

        $unit = Unit::create([
            'name' => $fields['name'],
            'type' => $fields['type'],
            'lat' => $fields['lat'],
            'lng' => $fields['lng']
        ]);
       
        if($unit){
           
        //  return response()->with('success', 'Unit created successfully');
        if($unit){
            return redirect()->route('unit')->with('success', $unit->name .' created successfully');
        }
        else{
            return redirect()->route('unit')->with('error', 'Unit creation failed');
        }
        
        
        }
    }

    public function getLatLng($id){
        $unit = Unit::find($id);
        return [(float)$unit->lat, (float)$unit->lng];
    }

    public function getUnit($id){
        $unit = Unit::find($id);
        return $unit;
    }





}