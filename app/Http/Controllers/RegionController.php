<?php


namespace App\Http\Controllers;
use App\Models\Region;
use App\Models\Zone;
use Illuminate\Http\Request;

class RegionController extends Controller
{

public function index(){

    $regions = Region::join('zones as z', 'z.id', 'regions.zone')
    -> select([
        'regions.id as region_id' ,
        'regions.region_code as region_code' ,
        'regions.region_name as region_name' ,
        'regions.zone as zone_id' ,
        'z.zone_code as zone_code'
    ])
    ->get();

    return view('region.index', compact('regions'));
}


public function add(){

$region = 'R' . str_pad(Region::max('id') + 1, 2, '0', STR_PAD_LEFT);
// dd($region);
$zones = Zone::all(); // Retrieve all zones
// return view('region.add', compact('region'));
return view('region.add', compact('region', 'zones')); // Pass $zones to the view
}

public function store(Request $request){

$region = new Region() ;

$region-> zone = $request-> zone ;
$region-> region_code = $request-> region_code ;
$region-> region_name = $request-> region_name ;


$region-> save();
return redirect()->route('region.index');

}


public function edit($id){
    $region = Region::where('id',$id)->first();
    // dd($region);
    $zones = Zone::all();
  return view('region.edit', compact('region' , 'zones'));

}

public function update(Request $request,$region_id){
  $region = Region::where('id', $region_id) ->first();
  $region-> zone = $request->zone;
  $region-> region_code = $request-> region_code ;
  $region-> region_name = $request-> region_name ;

  $region->save();

  return redirect() ->route('region.index');
}

public function delete($region_id){
    // return delete();
    Region::where('id', $region_id)->delete();
    return redirect() ->route('region.index');

}

public function show( $id)
    {
        // $region = Region::findOrFail($id);

        $regions = Region::join('zones as z', 'z.id', 'regions.zone')
        -> select([
            'regions.id as region_id' ,
            'regions.region_code as region_code' ,
            'regions.region_name as region_name' ,
            'regions.zone as zone_id' ,
            'z.zone_code as zone_code'
        ])
        ->first();


    //   dd($regions->region_id);

        return view('region.show', compact('regions'));


        // return redirect() ->route('region.index');
 }

}
