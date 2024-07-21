<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminWelcomeController extends Controller
{
    public function index(){

        return view('adminwelcome');
    }
}
