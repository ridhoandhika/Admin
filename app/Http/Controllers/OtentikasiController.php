<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OtentikasiController extends Controller
{
    public function index(){
        return view('authentication.auth-login');
    }

    public function login(Request $request){
        // dd($request->all());

       /* $data = User::where('email', $request->username)->firstOrFail();
        // dd($data->email);
        if($data){
            if(Hash::check($request->password, $data->password)){
                session(['berhasil_login' => true]);
                return redirect('/monthly');
            }
        }
          */

          if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
                return redirect('/Dashboard');
          }
        return redirect('/')->with('message','email atau password salah');
      
        // return view('authentication.auth-login');
    }

    public function logout(Request $request){
        // $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }

}
