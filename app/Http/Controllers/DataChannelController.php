<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataChannel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;
use Session;

class DataChannelController extends Controller
{

    public function index(Request $request){
        $now = new DateTime();
        $today = $now->modify('-1 day')->format('Y-m-d'); //date('Y-m-d',strtotime('+1 day',$now));

        if($request->date == null){
            $dates = date_format($now,"Y-m");
        }else{
            $dates = $request->date;
        }

        $getDate = explode('-', $dates);

        $sql ='select yearmonth,SUM(sosmed) as sosmed,SUM(myih) as myih,SUM(com147) as comp147 ,SUM(plasa) as plasa, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as all_channel
                from (
                    SELECT yearmonth, case when channel="sosmed" then SUM(value) else 0 end as sosmed , 
                        case when channel="myih" then SUM(value) else 0 end as myih,
                        case when channel="comp147" then SUM(value) else 0 end as com147,
                        case when channel="plasa" then SUM(value) else 0 end as plasa  
                    FROM data_channel
                    where MONTH(yearmonth) = '.$getDate[1] .'
                    AND YEAR(yearmonth) = '.$getDate[0] .'
                    GROUP BY channel,yearmonth
                    ORDER BY yearmonth
                ) as x
                GROUP BY yearmonth
                ORDER BY yearmonth DESC';
        $data = DB::select($sql);
       
        $datasum = DB::select('select dt_channel_comp,SUM(sosmed) as sosmed ,SUM(myih) as myih,SUM(com147) as com147,SUM(plasa) as plasa, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as total_nas
                                FROM (
                                select Date_format(yearmonth, "%y-%m") as dt_channel_comp,SUM(sosmed) as sosmed,SUM(myih) as myih,SUM(com147) as com147 ,SUM(plasa) as plasa, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as all_channel
                                from (
                                        SELECT yearmonth, case when channel="sosmed" then SUM(value) else 0 end as sosmed , 
                                                case when channel="myih" then SUM(value) else 0 end as myih,
                                                case when channel="comp147" then SUM(value) else 0 end as com147,
                                                case when channel="plasa" then SUM(value) else 0 end as plasa  
                                        FROM data_channel
                                        where MONTH(yearmonth) = '.$getDate[1] .'
                                        AND YEAR(yearmonth) = '.$getDate[0] .'
                                        GROUP BY channel,yearmonth
                                        ORDER BY yearmonth
                                ) as x
                                GROUP BY yearmonth
                                ORDER BY yearmonth DESC
                                ) as y
                                GROUP BY dt_channel_comp');
                        
        return view('others.data_channel',['data'=> $data,'datasum' => $datasum, 'today' => $today , 'dates' => $dates]);
    }

    public function create(Request $request){
        $komplain = preg_replace("/[^0-9]/", "", $request->komplain);

        if(Auth::user()->role != 'admin'){
            $data = DB::table('data_channel')
            ->where('channel',$request->channel)
            ->where( 'yearmonth', $request->date)->first();
            if($data){
                Session::flash('message', "data yang sudah di input tidak dapat di ubah");
                return redirect()->back(); 
            }else{
                $trafik = DataChannel::create([
                    'yearmonth' => $request->date,
                    'channel' => $request->channel,
                    'value' => $komplain,
                    'user' => Auth::user()->name
                ]);
                return redirect()->back(); 
            }
        }else{
            $trafik = DataChannel::updateOrCreate([
                'yearmonth' => $request->date,
                'channel' => $request->channel
            ],[
                // 'channel' => $request->channel,
                'value' => $komplain,
                'user' => Auth::user()->name
            ]);

            return redirect()->back();
        }
    
        // return redirect()->back();
    }
}
