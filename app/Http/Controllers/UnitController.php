<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\Polygon;

class UnitController
{

    public function index()
    {
        return Unit::all();
    }

    public function allPolygons()
    {
        $polygon = Polygon::all();
        return $polygon;
    }

    public function create(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string|unique:units,title',
            'unit' => 'required|string',
            'type' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);

        $unit = Unit::create([
            'title' => $fields['title'],
            'unit' => $fields['unit'],
            'type' => $fields['type'],
            'lat' => $fields['lat'],
            'lng' => $fields['lng']
        ]);

        return $unit;
    }

    public function postPolygon(Request $request)
    {
        $fields = $request->validate([
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'unit' => 'required|string',
        ]);

        $coord = Polygon::create([
            'lat' => $fields['lat'],
            'lng' => $fields['lng'],
            'unit' => $fields['unit'],
        ]);

        // return [$coord['unit']=>[$coord]];
        return redirect()->route('juris')->with('success', 'Jurisictional boundary vertice' . ' created successfully');
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string|unique:units,title',
            'unit' => 'required|string',
            'type' => 'required|string',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric'
        ]);

        $unit = Unit::create([
            'title' => $fields['title'],
            'unit' => $fields['unit'],
            'type' => $fields['type'],
            'lat' => $fields['lat'],
            'lng' => $fields['lng']
        ]);

        if ($unit) {
            return redirect()->route('unit')->with('success', $unit->title . ' created successfully');
        } else {
            return redirect()->route('unit')->with('error', 'Unit creation failed');
        }
    }

    public function deleteCoord(Request $request)
    {
        $coords = Polygon::where('unit', $request->unit)->get();

        if(!$coords){
            return response([
                'message' => 'No polygons found',
                'response' => 'error',
                'code' => '404'
            ], 404);
            
         }
        
        foreach($coords as $polygon){
        $polygon->delete();
        }

     if($coords){
        return response([
            'message' => $request['unit'] . ' deleted successfully',
            'response' => 'success',
            
        ], 200);
        
     }

    }

    public function getLatLng($id)
    {
        $unit = Unit::find($id);
        return [(float)$unit->lat, (float)$unit->lng];
    }

    public function deleteUnitPolygon($id)
    {
       $polygons = Polygon::where('unit', $id)->get();
      $polygons->delete();
        return ([
            'message' => 'Polygons deleted successfully',

            'response' => 'success'

        ]);
    }



    public function getUnit($id)
    {
        $unit = Unit::find($id);
        return $unit;
    }
}
