<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Distributors;
use App\Models\Offer_petanis;
use App\Models\Petanis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Images;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login',[
            'title' => 'Login'
        ]);
    }

    public function loginprocess(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );
        $credential =  $request->only('email', 'password');
        if (Auth::attempt($credential)) {
            return redirect()->intended('dashboard')->with('success', 'wellcome back ' . Auth::user()->name);
        }
        return redirect()->route('login')->with('errors', 'login gagal tolong periksa credential anda !!');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->intended('login')->with('success', 'logout success');
    }

    public function register()
    {
        return view('auth.register');
    }
    public function registrationprocess(Request $request,$formcode)
    {
        if($formcode == 1){
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'no_hp' => 'required',
                'email' => 'required|unique:users,email|unique:distributors,email',
                'password' => 'required|min:8|confirmed',
            ]);
            $input = $request->all();
            $name = $input['first_name'] .' '.$input['last_name'];
            $input["name"] = $name;
            $this->distributorRegister($input);
            return redirect()->route('login')->with('success','account distributor created !!');
        }

        if($formcode == 2){
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'no_hp' => 'required',
                'email' => 'required|unique:users,email|unique:distributors,email',
                'password' => 'required|min:8|confirmed',
            ]);
            $input = $request->all();
            $name = $input['first_name'] .' '.$input['last_name'];
            $input["name"] = $name;
            $this->farmerRegister($input);
            return redirect()->route('login')->with('success','account farmer created !!');
        }
    }

    public function farmerRegister($data){
        Petanis::create([
            'name' => $data["name"],
            'email' => $data['email'],
            'no_hp' => $data['no_hp']
        ]);
        $user = User::create([
            'name' => $data["name"],
            'email' => $data["email"],
            'password' => $data["password"]
        ]);
        $user->assignRole('petani');
    }

    public function distributorRegister($data){
        Distributors::create([
            'name' => $data["name"],
            'email' => $data['email'],
            'no_hp' => $data['no_hp']
        ]);

        $user = User::create([
            'name' => $data["name"],
            'email' => $data["email"],
            'password' => $data["password"]
        ]);

        $user->assignRole('distributor');
    }

    public function dashboard(){
        if(Auth::user()->hasRole('distributor')){
            $products = Images::all();
            return view('distributor.dashboard',[
                'title' => 'Dashboard Distributor',
                'products' => $products
            ]);
        }
        if(Auth::user()->hasRole('petani')){
            return view('petanis.dashboard',[
                'title' => 'Dashboard Petani'
            ]);
        }

        if(Auth::user()->hasRole('admin')){
            return view('auth.dashboard',[
                'title' => 'Dashboard Petani'
            ]);
        }
    }
}
