<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboarMTDController extends Controller
{
    public function index(){
        
        return view('others.dashboard_crmtd');
    }
}
