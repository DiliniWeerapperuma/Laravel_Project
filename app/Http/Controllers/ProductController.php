<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('product.index', compact('products'));

}


public function add(){

    $product = Product::max('id') + 1;


    return view('product.add', compact('product'));
}

public function store(Request $request){

    $product = new Product() ;

    $product-> sku_code = $request-> sku_code ;
    $product-> sku_name = $request-> sku_name ;
    $product-> mrp = $request-> mrp ;
    $product-> distributor_price = $request-> distributor_price ;
    $product-> weight= $request-> weight ;

    $product-> save();

    return redirect()->route('product.index');

 }

//  public function edit($id){
//     $product = Product::where('id',$id)->first();
//   return view('product.edit', compact('product'));

// }


// public function update(Request $request,$sku_id){
//     $product = Product::where('id', $sku_id) ->first();
//     $product-> sku_id = $request->sku_id;
//     $product-> sku_code = $request->sku_code;
//     $product-> sku_name = $request-> sku_name ;
//     $product-> mrp = $request-> mrp ;
//     $product-> distributor_price = $request-> distributor_price ;
//     $product-> weight = $request-> weight ;


//     $product->save();

//     return redirect() ->route('product.index');
//   }


//   public function delete($sku_id){
//     // return delete();
//     Product::where('id', $sku_id)->delete();
//     return redirect() ->route('product.index');

// }



}










