<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{

    public function register()
    {
        $territories = Territory::all();
        return view('auth.register', compact('territories'));
    }

    public function registerSave(Request $request)
    {
        // dd($request->all() );
        Validator::make($request->all(), [
            'name' => 'required',
            'nic' => 'required',
            'address' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'territory' => 'required',
            'username' => 'required',
            'password' => 'required',
        ])->validate();

        User::create([
            'name' => $request->name,
            'nic' => $request->nic,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'gender' => $request->gender,
            'torritory' => $request->territory,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'type' => "0",
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ])->validate();

        if (!Auth::attempt($request->only('username', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'username' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        if (auth()->user()->type == 'admin') {

            return redirect()->route('adminwelcome');
        } else {

            return redirect()->route('distributor');
        }

        // return redirect()->route('adminwelcome');
    }
}




