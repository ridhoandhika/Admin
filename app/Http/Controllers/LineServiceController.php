<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Line_in_Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;

class LineServiceController extends Controller
{
    
    public function indexService(Request $request){
        $now = new DateTime();
        $today = date_format($now,"Y-m");

        if($request->date == null){
            $dates = date_format($now,"Y");
        }else{
            $dates = $request->date;
        }
        
        // $result_nd = preg_replace("/[^0-9]/", "", $nd_number);
        $data = DB::table('line_in_service')
                ->select(DB::raw('DATE_FORMAT(yearmonth, "%Y-%m") as yearmonth'), 'TR1','TR2','TR3','TR4','TR5','TR6','TR7',
                        DB::raw('TR1 + TR2 +  TR3 + TR4 + TR5 + TR6 + TR7 as total'))
                // ->whereMonth('yearmonth', $getDate[1])
                ->whereYear('yearmonth', $dates)
                ->groupBy(DB::raw('DATE_FORMAT(yearmonth, "%Y-%m")'))
                ->orderBy('yearmonth', 'DESC')
                ->get();
        // dd($data);
        $datasum = DB::table('line_in_service')
            ->select(DB::raw('DATE_FORMAT(yearmonth, "%Y-%m") as yearmonth'),  //'TR1','TR2','TR3','TR4','TR5','TR6','TR7')
                        DB::raw('SUM(TR1) as TR1'),
                        DB::raw('SUM(TR2) as TR2'),
                        DB::raw('SUM(TR3) as TR3'),
                        DB::raw('SUM(TR4) as TR4'),
                        DB::raw('SUM(TR5) as TR5'),
                        DB::raw('SUM(TR6) as TR6'),
                        DB::raw('SUM(TR7) as TR7'),
                        DB::raw('SUM(TR1) + SUM(TR2) + SUM(TR3) + SUM(TR4) + SUM(TR5) + SUM(TR6) + SUM(TR7) as total_nas'))
            // ->whereMonth('yearmonth', $getDate[1])
            ->whereYear('yearmonth', $dates)
            ->groupBy(DB::raw("DATE_FORMAT(yearmonth, '%Y')"))
            ->orderBy('yearmonth', 'DESC')
            ->limit(10)
            ->get();

            // dd($data->yearmonth);

        // return redirect()->route('indexTraffic');
        return view('others.line_service',['data' => $data, 'datasum' => $datasum, 'dates' => $dates, 'today' => $today]);
    }

    public function create(Request $request){
            // dd($request->all());
            $tr1 = preg_replace("/[^0-9]/", "", $request->tr1);
            $tr2 = preg_replace("/[^0-9]/", "", $request->tr2);
            $tr3 = preg_replace("/[^0-9]/", "", $request->tr3);
            $tr4 = preg_replace("/[^0-9]/", "", $request->tr4);
            $tr5 = preg_replace("/[^0-9]/", "", $request->tr5);
            $tr6 = preg_replace("/[^0-9]/", "", $request->tr6);
            $tr7 = preg_replace("/[^0-9]/", "", $request->tr7);

            // dd($tr1);
            $now = new DateTime();
            $today = Date_Format($now,"d"); 
            $date = $request->month.'-'.$today;
            
            $parameters = explode('-', $request->month);
            $data = DB::table('line_in_service')
            ->select('yearmonth')
            ->whereMonth('yearmonth', $parameters[1])
            ->whereYear('yearmonth', $parameters[0])
            ->first();
           
            if($data === null){
                Line_in_Service::create([
                'yearmonth' => $date,
                'tr1' =>  $tr1,
                'tr2' => $tr2,
                'tr3' => $tr3,
                'tr4' => $tr4,
                'tr5' => $tr5,
                'tr6' => $tr6,
                'tr7' => $tr7,
                'user' => Auth::user()->name
                ]);
               
            }else{
                // if(Auth::user()->role == 'admin'){
                Line_in_Service::where('yearmonth',$data->yearmonth)
                                ->update([
                                'tr1' => $tr1,
                                'tr2' => $tr2,
                                'tr3' => $tr3,
                                'tr4' => $tr4,
                                'tr5' => $tr5,
                                'tr6' => $tr6,
                                'tr7' => $tr7,
                                'user' => Auth::user()->name
                            ]);
             
            }
           
        return redirect()->back();
    }
}
