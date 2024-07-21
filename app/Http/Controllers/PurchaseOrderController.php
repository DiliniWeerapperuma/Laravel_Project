<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use App\Models\Region;
use App\Models\Territory;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
// use Barryvdh\DomPDF\Facade as PDF;

use PDF;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
// use ZipArchive;
use ZipStream\ZipStream;
use ZipStream\Option\Archive;


class PurchaseOrderController extends Controller
{
    public function export(Request $request)
    {
        $po_ids = $request->ids;

        // Create ArchiveOptions for ZipStream
        $options = new Archive();
        $options->setSendHttpHeaders(true);

        // Create a new ZipStream object
        $zip = new ZipStream('purchase_orders.zip', $options);

        foreach ($po_ids as $po) {
            $purchase_order = PurchaseOrder::where('id', $po)->first();
            $distributor = User::where('id', $purchase_order->distributor)->first();
            $territory = Territory::where('id', $distributor->territory)->first();
            $region = Region::where('id', $territory->region)->first();
            $zone = Zone::where('id', $region->zone)->first();

            $inv_number = 'INV' . str_pad($purchase_order->id, 4, '0', STR_PAD_LEFT);

            $data = PurchaseOrder::join('purchase_order_details as pod', 'pod.po_id', 'purchase_orders.id')
                                ->leftJoin('products as p', 'p.id', 'pod.sku_id')
                                ->where('purchase_orders.id', $po)
                                ->select([
                                    'p.qty as sku_id',
                                    'p.qty as available',
                                    'p.sku_code as sku_code',
                                    'p.sku_name as sku_name',
                                    'p.distributor_price as price',
                                    'pod.qty as qty',
                                    'pod.amount as total_amount'
                                ])
                                ->get();

            $pdf = Pdf::loadView('export_print_po', compact('purchase_order', 'distributor', 'territory', 'region', 'zone', 'inv_number', 'data'));
            $pdfContent = $pdf->output();

            // Add PDF to the zip file
            $zip->addFile("{$inv_number}.pdf", $pdfContent);
        }

        // Finalize the zip file
        $zip->finish();
    }


    public function index(){

        $user = Auth::user();

        $users = User::join('territories as t', 't.id', 'users.torritory')
        ->join('regions as r' ,'r.id', 't.region')
        ->join('zones as z' ,'z.id', 'r.zone')
        ->where('users.id', $user->id)
        ->select([

            'users.id as user_id',
            'users.name as name',
            'users.nic as nic',
            'users.address as address',
            'users.mobile as mobile',
            'users.email as email',
            'users.gender as gender',
            'users.torritory as territory_id',
            'users.username as username',
            'users.password as password',

            't.territory_code as territory_code',
            't.region as region_id' ,
            'r.region_code as region_code',
            'r.zone as zone_id',
            'z.zone_code as zone_code'


            ])
            ->first();

            $products = Product::all();

            $po_number = 'PO' . str_pad(PurchaseOrder::max('id') + 1, 2, '0', STR_PAD_LEFT);

        return view('purchaseorderadd', compact('users', 'products', 'po_number'));



    }

    public function store(Request $request) {

        $products = json_decode($request->input('products'), true);
        $distributor = $request->distributor_id;
        $po_number =$request->po_number;
        $net_amount =$request->net_amount;
        $now = Carbon::now();
        $currentDate = $now->format('Y-m-d');
        $currentTime = $now->format('H:i:s');

        if (!is_array($products)) {
            return response()->json(['error' => 'Products data is not an array'], 400);
        }

        if (count($products)>0) {

            $po = new PurchaseOrder() ;

            $po->distributor = $distributor;
            $po->po_number = $po_number;
            $po->date = $currentDate;
            $po->time = $currentTime;
            $po->total_amount = $net_amount;

            $po->save();

            $po_id = $po->id;

            foreach ($products as $product) {
                if (is_array($product) && isset($product['product_id']) && isset($product['quantity'])) {
                    $productId = $product['product_id'];
                    $quantity = $product['quantity'];


                    $product = Product::find($productId);

                    $price = $product->distributor_price;

                    $amount = $price * $quantity;

                    $po_data = new PurchaseOrderDetails();

                    $po_data->po_id = $po_id;
                    $po_data->sku_id = $productId;
                    $po_data->qty = $quantity;
                    $po_data->amount = $amount;

                    $po_data->save();

                    //Update the product tables available qty
                    $product->qty -= $quantity;
                    $product->save();


                } else {
                    return response()->json(['error' => 'Invalid product data format'], 400);
                }
            }

        }

        return response()->json(['message' => 'Purchase order processed successfully']);

    }


    public function view() {

        $user = Auth::user();

        $zones = Zone::all();
        $regions = Region::all();
        $territories = Territory::all();

        // if($user && $user != ''  && ($user->type != 1)){

        //     $distributor = User::where('id', $user->id)->first();
        //     $territories = Territory::where('id', $distributor->torritory)->first();
        //     $regions = Region::where('id', ($territories->region))->first();
        //     $zones = Zone::where('id', $regions->zone)->first();


        // }
        return(view('poall', compact('zones', 'regions', 'territories' )));
    }


    public function po_data(Request $request) {

        $user = Auth::user();

        $zone = $request->zone;
        $region = $request->region;
        $territory = $request->territory;
        $po_number = $request->po_number;
        $from = $request->from;
        $to = $request->to;

        // dd($po_number);



        $data = PurchaseOrder::join('users as u', 'u.id', 'purchase_orders.distributor')
                            ->leftjoin('territories as t', 't.id', 'u.torritory')
                            ->leftjoin('regions as r', 'r.id', 't.region')
                            ->leftjoin('zones as z', 'z.id', 'r.zone')
                            ->select([

                                'purchase_orders.id as po_id',
                                'purchase_orders.po_number as po_number',
                                'purchase_orders.date as date',
                                'purchase_orders.time as time',
                                'purchase_orders.total_amount as amount',
                                'u.id as dis_id',
                                'u.name as dis',
                                't.id as t_id',
                                't.territory_code as territory',
                                'r.id as r_id',
                                'r.region_code as region',
                                'z.id as z_id',
                                'z.zone_code as zone',



                            ]);
                            // ->groupBy([
                            //     'purchase_orders.id',
                            //     'purchase_orders.po_number',
                            //     'purchase_orders.date',
                            //     'purchase_orders.time',
                            //     'purchase_orders.total_amount',
                            //     'u.id',
                            //     'u.name',
                            //     't.id',
                            //     'r.id',
                            //     'z.id',
                            // ])
                            // ->get();
                            if($user && $user != ''  && ($user->type != 1)){
                                $data->where('u.id', $user->id);
                            }
                            if($zone && $zone != ''){
                                $data->where('z.id', $zone);
                            }
                            if($region && $region != ''){
                                $data->where('r.id', $region);
                            }
                            if($territory && $territory != ''){
                                $data->where('t.id', $territory);
                            }
                            if($po_number && $po_number != ''){
                                $data->where('po_number', 'like', '%'.$po_number.'%');
                            }
                            if($from && $from != ''){
                                $data->where('purchase_orders.date','>=' , $from);
                            }
                            if($to && $to != ''){
                                $data->where('purchase_orders.date','=<' , $to);
                            }

                            $data = $data->get();

        return(view('purchase_orders_data', compact('data')));
    }


    public function show($id) {


        $purchase_order = PurchaseOrder::where('id', $id)->first();
        $distributor = User::where('id', $purchase_order->distributor)->first();
        $territory = Territory::where('id', $distributor->torritory)->first();
        $region = Region::where('id', $territory->region)->first();
        $zone = Zone::where('id', $region->zone)->first();

        $data = PurchaseOrder::join('purchase_order_details as pod', 'pod.po_id', 'purchase_orders.id')
                            ->leftjoin('products as p', 'p.id', 'pod.sku_id')
                            // ->leftjoin('users as u', 'u.id', 'pod.sku_id')
                            // ->leftjoin('territories as t', 't.id', 'u.torritory')
                            // ->leftjoin('regions as r', 'r.id', 't.region')
                            // ->leftjoin('zones as z', 'z.id', 'r.zone')
                            ->where('purchase_orders.id', $id)
                            ->select([
                                'p.qty as sku_id',
                                'p.qty as available',
                                'p.sku_code as sku_code',
                                'p.sku_name as sku_name',
                                'p.distributor_price as price',
                                'pod.qty as qty',
                                'pod.amount as total_amount'

                                ])
                            ->get();

        return(view('purchase_orders_show', compact('data', 'purchase_order', 'distributor', 'territory' , 'region', 'zone')));
    }


    public function pdf($id) {

        $purchase_order = PurchaseOrder::where('id', $id)->first();
        $distributor = User::where('id', $purchase_order->distributor)->first();
        $territory = Territory::where('id', $distributor->torritory)->first();
        $region = Region::where('id', $territory->region)->first();
        $zone = Zone::where('id', $region->zone)->first();

        $inv_number = 'INV' . str_pad($purchase_order->id, 4, '0', STR_PAD_LEFT);



        $data = PurchaseOrder::join('purchase_order_details as pod', 'pod.po_id', 'purchase_orders.id')
                            ->leftjoin('products as p', 'p.id', 'pod.sku_id')
                            ->where('purchase_orders.id', $id)
                            ->select([
                                'p.qty as sku_id',
                                'p.qty as available',
                                'p.sku_code as sku_code',
                                'p.sku_name as sku_name',
                                'p.distributor_price as price',
                                'pod.qty as qty',
                                'pod.amount as total_amount'

                                ])
                            ->get();

        $pdf = PDF::loadView('export_print_po', compact('purchase_order','distributor','territory','region', 'zone', 'inv_number', 'data'));

        return $pdf->stream("{$inv_number}.pdf");
    }


    // public function export(Request $request)
    // {
    //     $po_ids = $request->ids;

    //     // Create ArchiveOptions for ZipStream
    //     $options = new ArchiveOptions();
    //     $options->setSendHttpHeaders(true);

    //     // Create a new ZipStream object
    //     $zip = new ZipStream('purchase_orders.zip', $options);

    //     foreach ($po_ids as $po) {
    //         $purchase_order = PurchaseOrder::where('id', $po)->first();
    //         $distributor = User::where('id', $purchase_order->distributor)->first();
    //         $territory = Territory::where('id', $distributor->territory)->first();
    //         $region = Region::where('id', $territory->region)->first();
    //         $zone = Zone::where('id', $region->zone)->first();

    //         $inv_number = 'INV' . str_pad($purchase_order->id, 4, '0', STR_PAD_LEFT);

    //         $data = PurchaseOrder::join('purchase_order_details as pod', 'pod.po_id', 'purchase_orders.id')
    //                             ->leftJoin('products as p', 'p.id', 'pod.sku_id')
    //                             ->where('purchase_orders.id', $po)
    //                             ->select([
    //                                 'p.qty as sku_id',
    //                                 'p.qty as available',
    //                                 'p.sku_code as sku_code',
    //                                 'p.sku_name as sku_name',
    //                                 'p.distributor_price as price',
    //                                 'pod.qty as qty',
    //                                 'pod.amount as total_amount'
    //                             ])
    //                             ->get();

    //         $pdf = Pdf::loadView('export_print_po', compact('purchase_order', 'distributor', 'territory', 'region', 'zone', 'inv_number', 'data'));
    //         $pdfContent = $pdf->output();

    //         // Add PDF to the zip file
    //         $zip->addFile("{$inv_number}.pdf", $pdfContent);
    //     }

    //     // Finalize the zip file
    //     $zip->finish();
    // }


    // public function export(Request $request) {

    //     $po_ids = $request->ids;

    //     // dd($po_ids);

    //     foreach($po_ids as $po) {

    //         $purchase_order = PurchaseOrder::where('id', $po)->first();
    //         $distributor = User::where('id', $purchase_order->distributor)->first();
    //         $territory = Territory::where('id', $distributor->torritory)->first();
    //         $region = Region::where('id', $territory->region)->first();
    //         $zone = Zone::where('id', $region->zone)->first();

    //         $inv_number = 'INV' . str_pad($purchase_order->id, 4, '0', STR_PAD_LEFT);



    //         $data = PurchaseOrder::join('purchase_order_details as pod', 'pod.po_id', 'purchase_orders.id')
    //                             ->leftjoin('products as p', 'p.id', 'pod.sku_id')
    //                             ->where('purchase_orders.id', $po)
    //                             ->select([
    //                                 'p.qty as sku_id',
    //                                 'p.qty as available',
    //                                 'p.sku_code as sku_code',
    //                                 'p.sku_name as sku_name',
    //                                 'p.distributor_price as price',
    //                                 'pod.qty as qty',
    //                                 'pod.amount as total_amount'

    //                                 ])
    //                             ->get();

    //         $pdf = PDF::loadView('export_print_po', compact('purchase_order','distributor','territory','region', 'zone', 'inv_number', 'data'));

    //     return $pdf->stream("{$inv_number}.pdf");

    //     }
    // }


    // public function export(Request $request)
    // {
    //     $po_ids = $request->ids;
    //     $pdf = new Fpdi;

    //     foreach ($po_ids as $po) {
    //         $purchase_order = PurchaseOrder::find($po);
    //         if (!$purchase_order) continue;

    //         $distributor = User::find($purchase_order->distributor);
    //         $territory = Territory::find($distributor->territory);
    //         $region = Region::find($territory->region);
    //         $zone = Zone::find($region->zone);

    //         $inv_number = 'INV' . str_pad($purchase_order->id, 4, '0', STR_PAD_LEFT);

    //         $data = PurchaseOrder::join('purchase_order_details as pod', 'pod.po_id', 'purchase_orders.id')
    //                             ->leftjoin('products as p', 'p.id', 'pod.sku_id')
    //                             ->where('purchase_orders.id', $po)
    //                             ->select([
    //                                 'p.qty as sku_id',
    //                                 'p.qty as available',
    //                                 'p.sku_code as sku_code',
    //                                 'p.sku_name as sku_name',
    //                                 'p.distributor_price as price',
    //                                 'pod.qty as qty',
    //                                 'pod.amount as total_amount'
    //                             ])
    //                             ->get();

    //         $pdfContent = PDF::loadView('export_print_po', compact('purchase_order', 'distributor', 'territory', 'region', 'zone', 'inv_number', 'data'))->output();

    //         $pdf->AddPage();
    //         $pdf->setSourceFile(StreamReader::createByString($pdfContent));
    //         $templateId = $pdf->importPage(1);
    //         $pdf->useTemplate($templateId);
    //     }

    //     return response()->stream(
    //         function () use ($pdf) {
    //             $pdf->Output('I', 'merged_pdfs.pdf');
    //         },
    //         200,
    //         ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'attachment; filename="merged_pdfs.pdf"']
    //     );
    // }








    }








