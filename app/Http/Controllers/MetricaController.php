<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetricaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function indexWithOneFolder($folderName,$fileName)
    { 	
        // Render perticular view file by foldername and filename
        if(view()->exists($folderName.".".$fileName)){
            return view($folderName.".".$fileName); 
        }
        return abort('404');
    }
    public function indexWithTwoFolder($folderName1,$folderName2,$fileName)
    {   
        // Render perticular view file by foldername and filename
        if(view()->exists($folderName1.".".$folderName2.".".$fileName)){
            return view($folderName1.".".$folderName2.".".$fileName); 
        }
        return abort('404');
    }
    public function root()
    {
    	// Render perticular view file by foldername and filename
        return view('others/dashboard_cr'); 
    }
    public function logout()
    {
        Auth::logout(); 
        return redirect()->route('login');
    }
    // $select = DB::select('select * from student');
    // return view ('index')->with('name',$select);
}
