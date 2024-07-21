<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Territory;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){

        $users = User::join('territories as t', 't.id', 'users.territory')
        -> select([
            'users.id as user_id' ,
            'users.name as name' ,
            'users.nic  as nic ' ,
            'users.address  as address ' ,
            'users.mobile as mobile ' ,
            'users.email  as email' ,
            'users.gender  as gender ' ,
            'users.username   as username  ' ,
            'users.password  as password ' ,
            'users.territory as territory_id' ,
            't.territory_code as territory_code'
        ])
        ->get();

        return view('user.index', compact('users'));
}


public function add(){

    $user = User::max('id') + 1;
    $territories = Territory::all();
    return view('user.add', compact('user', 'territories'));
    // return view('user.add', compact('territories'));
    }

    public function store(Request $request){

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'nic' => 'required|string|max:255',
        //     'address' => 'required|string|max:255',
        //     'mobile' => 'required|string|max:20',
        //     'email' => 'required|email|max:255',
        //     'gender' => 'required|string|max:10',
        //     'territory' => 'required|integer',
        //     'username' => 'required|string|max:255',
        //     'password' => 'required|string|min:8',
        // ]);

    $user = new User() ;

    $user-> name = $request-> name ;
    $user-> nic = $request-> nic ;
    $user-> address = $request-> address ;
    $user-> mobile = $request-> mobile ;
    $user-> email = $request-> email ;
    $user-> gender = $request-> gender ;
    $user-> territory = $request-> territory ;
    $user-> username = $request-> username ;
    $user-> password = ($request-> password) ;
    // $user-> password = bcrypt($request-> password) ;

    $user-> save();
    return redirect()->route('user.index');

    }


}




