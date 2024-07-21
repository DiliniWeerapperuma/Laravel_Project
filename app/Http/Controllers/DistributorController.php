<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    public function index(){

        return view('distributor');
    }
}
