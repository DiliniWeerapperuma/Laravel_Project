<?php

namespace App\Http\Controllers;
use App\Models\Territory;
use App\Models\Region;
use App\Models\Zone;
use Illuminate\Http\Request;

class TerritoryController extends Controller
{
    // public function index(){

        // $regions = Region::all();
        // return view('region.index', compact('regions'));

        // return view('territory.index');
    // }
public function index(){

    $territories = Territory::join('regions as r', 'r.id', 'territories.region')
    -> join('zones as z' ,'z.id', 'r.zone')
    -> select([

        'territories.id as territory_id',
        'territories.territory_code as territory_code' ,
        'territories.territory_name as territory_name' ,
        'territories.region as region_id' ,

         'r.region_code as region_code' ,
         'r.zone as zone_id' ,
         'z.zone_code as zone_code'

    ])
    ->get();

    return view('territory.index', compact('territories'));
}



public function add(){

    $territory = 'T' . str_pad(Territory::max('id') + 1, 2, '0', STR_PAD_LEFT);

    $zones = Zone::all(); // Retrieve all zones
    $regions = Region::all();
    return view('territory.add', compact('territory', 'zones', 'regions')); // Pass $zones to the view

    }

    public function store(Request $request){

    $territory = new Territory() ;

    $territory-> zone = $request-> zone ;
    $territory-> region = $request-> region ;
    $territory-> territory_code = $request-> territory_code ;
    $territory-> territory_name = $request-> territory_name ;


    $territory-> save();
    return redirect()->route('territory.index');

    }


    public function edit($id){
        $territory = Territory::where('id',$id)->first();

        $zones = Zone::all();
        $regions = Region::all();
      return view('territory.edit', compact('territory' , 'zones' , 'regions'));


    }

    public function update(Request $request,$territory_id){
      $territory = Territory::where('id', $territory_id) ->first();
      $territory-> zone = $request->zone;
      $territory-> region = $request->region;
      $territory-> territory_code = $request-> territory_code ;
      $territory-> territory_name = $request-> territory_name ;

      $territory->save();

      return redirect() ->route('territory.index');
    }

    public function delete($territory_id){
        // return delete();
        Territory::where('id', $territory_id)->delete();
        return redirect() ->route('territory.index');

    }

    public function show( $id)
        {

            $territories = Territory::join('regions as r', 'r.id', 'territories.region')
            -> join('zones as z' ,'z.id', 'r.zone')
            -> select([
                'territories.id as territory_id',
                'territories.territory_code as territory_code' ,
                'territories.territory_name as territory_name' ,
                'territories.region as region_id' ,

                 'r.region_code as region_code' ,
                 'r.zone as zone_id' ,
                 'z.zone_code as zone_code'
            ])
            ->first();



            return view('territory.show', compact('territories'));

     }

}
