<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\PercentTraffic;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Session;

class PercentTrafficController extends Controller
{
    public function All_ticket(Request $request){
        $now = new DateTime();
        $today = $now->modify('-1 day')->format('Y-m-d');

        if($request->date == null){
            $dates = date_format($now,"Y-m");
        }else{
            $dates = $request->date;
        }
        
        $getDate = explode('-', $dates);

        $users = DB::table('percent_traffic')
                ->select('yearmonth','tr1','tr2','tr3','tr4','tr5','tr6','tr7',
                        DB::raw('tr1 + tr2 + tr3 + tr4 + tr5 + tr6 + tr7 as nasional'))
                ->whereMonth('yearmonth', $getDate[1])
                ->whereYear('yearmonth', $getDate[0])
                ->orderBy('yearmonth', 'DESC')
                // ->limit(10)
                ->get();
// dd($users);
        $datasum = DB::table('percent_traffic')
                ->select(DB::raw('DATE_FORMAT(yearmonth, "%Y-%m") as yearmonth'),  //'TR1','TR2','TR3','TR4','TR5','TR6','TR7')
                        DB::raw('SUM(TR1) as tr1'),
                        DB::raw('SUM(TR2) as tr2'),
                        DB::raw('SUM(TR3) as tr3'),
                        DB::raw('SUM(TR4) as tr4'),
                        DB::raw('SUM(TR5) as tr5'),
                        DB::raw('SUM(TR6) as tr6'),
                        DB::raw('SUM(TR7) as tr7'),
                        DB::raw('SUM(TR1) + SUM(TR2) + SUM(TR3) + SUM(TR4) + SUM(TR5) + SUM(TR6) + SUM(TR7) as total_nasional'))
                ->whereMonth('yearmonth', $getDate[1])
                ->whereYear('yearmonth', $getDate[0])
                ->groupBy(DB::raw('DATE_FORMAT(yearmonth, "%y-%m")'))
                ->orderBy('yearmonth', 'DESC')
                ->get();

        return view('others.percent_trafik',['users' => $users, 'datasum' => $datasum, 'today'=> $today, 'dates' => $dates]);
    }

    public function create(Request $request){
        // dd($request->all());
        $now = null; //new DateTime();
        if($request->date == null){
            $now = new DateTime();
        }else {
            $now = $request->date;
        }
        $tr1 = preg_replace("/[^0-9]/", "", $request->tr1);
        $tr2 = preg_replace("/[^0-9]/", "", $request->tr2);
        $tr3 = preg_replace("/[^0-9]/", "", $request->tr3);
        $tr4 = preg_replace("/[^0-9]/", "", $request->tr4);
        $tr5 = preg_replace("/[^0-9]/", "", $request->tr5);
        $tr6 = preg_replace("/[^0-9]/", "", $request->tr6);
        $tr7 = preg_replace("/[^0-9]/", "", $request->tr7); 

        // dd($tr1);
        
        if(Auth::user()->role == 'admin'){
            $trafik = PercentTraffic::updateOrCreate([ 'yearmonth' => $now
                    ],[
                        'tr1' => $tr1,
                        'tr2' => $tr2,
                        'tr3' => $tr3,
                        'tr4' => $tr4,
                        'tr5' => $tr5,
                        'tr6' => $tr6,
                        'tr7' => $tr7,
                        'user' => Auth::user()->name
                        ]);
                    return redirect()->back(); 
        }else{
            $data = DB::table('percent_traffic') 
                    ->select('yearmonth')
                    ->where('yearmonth',$now)
                    ->first();
                    // dd($data);
            if($data){
                $msg = 'halo data sudah ada';
                Session::flash('message', "data yang sudah di input tidak bisa di ubah");
                // dd($data);
                return redirect()->back(); 
            }else{
                $trafik = PercentTraffic::create([
                    'yearmonth' => $now,
                    'tr1' => $tr1,
                    'tr2' => $tr2,
                    'tr3' => $tr3,
                    'tr4' => $tr4,
                    'tr5' => $tr5,
                    'tr6' => $tr6,
                    'tr7' => $tr7,
                    'user' => Auth::user()->name
                ]);
                Session::flash('message', "data berhasil di tambahkan");
                return redirect()->back();
            }        // dd($data);
            }
        // return redirect()->back();
    }
}
