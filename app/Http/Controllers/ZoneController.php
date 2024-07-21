<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index(){

        $zones = Zone::all();
        return view('zone.index', compact('zones'));
}

public function add(){

    $zone = 'Z' . str_pad(Zone::max('id') + 1, 2, '0', STR_PAD_LEFT);
    // dd($zone);
    return view('zone.add', compact('zone'));
}

public function store(Request $request){

   $zone = new Zone() ;

   $zone-> zone_code = $request-> zone_code ;
   $zone-> zone_long_description = $request-> zone_long_description ;
   $zone-> short_description = $request-> short_description ;

   $zone-> save();

   return redirect()->route('zone.index');

}


public function edit($id){
    $zone = Zone::where('id',$id)->first();
  return view('zone.edit', compact('zone'));

}

public function update(Request $request,$zone_id){
  $zone = Zone::where('id', $zone_id) ->first();
  $zone-> zone_code = $request->zone_code;
  $zone-> zone_long_description = $request-> zone_long_description ;
  $zone-> short_description = $request-> short_description ;

  $zone->save();

  return redirect() ->route('zone.index');
}

public function delete($zone_id){
    // return delete();
    Zone::where('id', $zone_id)->delete();
    return redirect() ->route('zone.index');

}

public function show( $id)
    {
        $zone = Zone::findOrFail($id);
        return view('zone.show', compact('zone'));


        return redirect() ->route('zone.index');
 }

}

