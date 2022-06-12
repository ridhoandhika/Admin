<?php
namespace App\Http\Controllers;
use App\Models\Datatrafik;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateInterval;
use DatePeriod;

class InputformController extends Controller
{
    public function index(Request $request){
        $now = new DateTime();
        $today = $now->modify('-1 day')->format('Y-m-d'); //date('Y-m-d',strtotime('+1 day',$now));

        if($request->date == null){
            $dates = date_format($now,"Y-m");
        }else{
            $dates = $request->date;
        }
        // $dates = date_format($now,"Y-m");
        

        $getDate = explode('-', $dates);
        // dd($getDate);
        // dd($dates);
        // $users = Datatrafik::all();
        $data = DB::table('data_trafik')
                ->select('yearmonth','komplain_147 as komplain_147','sosmed_komplain','plasa_komplain','myih_komplain',
                        DB::raw('SUM(komplain_147) + SUM(sosmed_komplain) +  SUM(plasa_komplain) +  SUM(myih_komplain) as total'))
                ->whereMonth('yearmonth', $getDate[1])
                ->whereYear('yearmonth', $getDate[0])
                ->groupBy('yearmonth')
                ->orderBy('yearmonth', 'DESC')
                ->get();
                

                // dd($data);
        $datasum = DB::table('data_trafik')
                ->select(DB::raw('DATE_FORMAT(yearmonth, "%y-%m") as yearmonth'), 
                        DB::raw('SUM(sosmed_komplain) as sos_komplain'),
                        DB::raw('SUM(komplain_147) as komplain_147'),
                        DB::raw('SUM(plasa_komplain) as plasa_komplain'),
                        DB::raw('SUM(myih_komplain) as myih_komplain'),
                        DB::raw('SUM(myih_komplain) + SUM(sosmed_komplain) + SUM(komplain_147) + SUM(plasa_komplain) as all_channel'))
                ->whereMonth('yearmonth', $getDate[1])
                ->whereYear('yearmonth', $getDate[0])
                ->groupBy(DB::raw("DATE_FORMAT(yearmonth, '%Y-%m')"))
                ->orderBy('yearmonth', 'DESC')
                ->limit(10)
                ->get();

                // dd($datasum);
        return view('others.data_trafik',['data' => $data, 'datasum' => $datasum, 'today' => $today, 'dates' => $dates]);
    }
    public function create(Request $request){
        // dd(Auth::user()->role);
        // if(Auth::user()->role == 'admin'){
            if($request->channel == 'sosmed'){
                $trafik = Datatrafik::updateOrCreate([
                    'yearmonth' => $request->date
                ],[
                'sosmed_komplain' => $request->komplain,
                'user' => Auth::user()->name
                ]);
            }else if($request->channel === 'plasa'){
                $trafik = Datatrafik::updateOrCreate([
                    'yearmonth' => $request->date
                ],[
                    'plasa_komplain' => $request->komplain,
                    'user' => Auth::user()->name
                ]);
            }else if($request->channel == '147'){
                $trafik = Datatrafik::updateOrCreate([
                    'yearmonth' => $request->date
                ],[
                    'komplain_147' => $request->komplain,
                    'user' => Auth::user()->name
                ]);
            }else if($request->channel == 'myih'){
                $trafik = Datatrafik::updateOrCreate([
                    'yearmonth' => $request->date
                ],[
                    'myih_komplain' => $request->komplain,
                    'user' => Auth::user()->name
                ]);
            }
        // }
                
        return redirect()->back();
    }


    public function indexTraffic(){
        $now = new DateTime();
        

        $sql = '
                select DATE_FORMAT(yearmonth, "%Y") dt_lis
                from line_in_service 
                GROUP BY dt_lis
            ';

        $year = DB::select($sql);

        $yearnow = array();
        foreach($year as $yr ){
            $yearnow[] = $yr->dt_lis;
            arsort( $yearnow );
        }
       

        return view('others.dashboard_cr', ['year' => $yearnow]);
     }

     public function datacr(Request $request){
        // $user = Auth::user()->role;
        // dd($request->year);
        $now = new DateTime();
        // $today = date_format($now,"Y-m-d");
        $dates = date_format($now,"Y-m");
        $getDate = explode("-", $dates);
        if($request->year == null){
            $year = $getDate[0];
        }else{
            $year = $request->year;
        }

        
      
        if($request->channel == null || $request->channel == 'All'){
                $sql2 = '
                        select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR1+TR2+TR3+TR4+TR5+TR6+TR7)  as max_Lis_all
                        FROM line_in_service
                        GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                        order BY max_Lis_all desc
                        limit 1
                ';
        }else if($request->channel == 'tr1'){
                $sql2 = '
                        select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR1)  as max_Lis_all 
                        FROM line_in_service
                        where year(yearmonth) = '.$year.'
                        GROUP BY DATE_FORMAT(yearmonth, "%Y-%m")
                        order BY max_Lis_all desc
                        limit 1
                ';
        }else if($request->channel == 'tr2'){
            $sql2 = '
                        select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR2)  as max_Lis_all 
                        FROM line_in_service
                        GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                        order BY max_Lis_all desc
                        limit 1
            ';
        }else if($request->channel == 'tr3'){
            $sql2 = '
                        select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR3)  as max_Lis_all 
                        FROM line_in_service
                        GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                        order BY max_Lis_all desc
                        limit 1
            ';
        }else if($request->channel == 'tr4'){
            $sql2 = '
                        select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR4)  as max_Lis_all 
                        FROM line_in_service
                        GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                        order BY max_Lis_all desc
                        limit 1
            ';
        }else if($request->channel == 'tr5'){
            $sql2 = '
                        select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR5)  as max_Lis_all 
                        FROM line_in_service
                        GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                        order BY max_Lis_all desc
                        limit 1
            ';
        }else if($request->channel == 'tr6'){
            $sql2 = '
                        select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR6)  as max_Lis_all 
                        FROM line_in_service
                        GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                        order BY max_Lis_all desc
                        limit 1
            ';
        }else if($request->channel == 'tr7'){
            $sql2 = '
                        select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR7)  as max_Lis_all 
                        FROM line_in_service
                        GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                        order BY max_Lis_all desc
                        limit 1
            ';
        }

        $max_lis = DB::select($sql2);
        // dd($max_lis);
        foreach($max_lis as $datalis ){
            $max_all_lis = $datalis->max_Lis_all;
            // $min_all_lis = $max_all_lis*0.1;
        }
        // dd($max_all_lis);
        if($request->channel == null || $request->channel == 'all'){
            $sql1 = 'select dt_lis, SUM(lis_treg1+lis_treg2+lis_treg3+lis_treg4+lis_treg5+lis_treg6+lis_treg7) as lis_all_treg FROM (
                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR1) as lis_treg1,SUM(TR2)  as lis_treg2 ,SUM(TR3)  as lis_treg3,SUM(TR4)  as lis_treg4,SUM(TR5)  as lis_treg5,SUM(TR6)  as lis_treg6,SUM(TR7)  as lis_treg7 
                    from line_in_service 
                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                    ) as c
                    GROUP BY dt_lis
                    ORDER BY dt_lis DESC
                    limit 1
                    ';
        }else if($request->channel == 'tr1'){
            $sql1 = '
                select dt_lis, SUM(lis_treg1) as lis_all_treg 
                FROM (
                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR1) as lis_treg1
                    from line_in_service 
                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                    ) as c
                GROUP BY dt_lis
                ORDER BY dt_lis DESC
                limit 1
            ';
        }else if($request->channel == 'tr2'){
            $sql1 = '
                select dt_lis, SUM(lis_treg2) as lis_all_treg 
                FROM (
                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR2) as lis_treg2
                    from line_in_service 
                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                    ) as c
                GROUP BY dt_lis
                ORDER BY dt_lis DESC
                limit 1
            ';
        }else if($request->channel == 'tr3'){
            $sql1 = '
            select dt_lis, SUM(lis_treg3) as lis_all_treg 
            FROM (
                select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR3) as lis_treg3
                from line_in_service 
                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                ) as c
            GROUP BY dt_lis
            ORDER BY dt_lis DESC
            limit 1
            ';
        }else if($request->channel == 'tr4'){
            $sql1 = '
                select dt_lis, SUM(lis_treg4) as lis_all_treg 
                FROM (
                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR4) as lis_treg4
                    from line_in_service 
                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                    ) as c
                GROUP BY dt_lis
                ORDER BY dt_lis DESC
                limit 1
            ';
        }else if($request->channel == 'tr5'){
            $sql1 = '
                select dt_lis, SUM(lis_treg5) as lis_all_treg 
                FROM (
                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR5) as lis_treg5
                    from line_in_service 
                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                    ) as c
                GROUP BY dt_lis
                ORDER BY dt_lis DESC
                limit 1
            ';
        }else if($request->channel == 'tr6'){
            $sql1 = '
                select dt_lis, SUM(lis_treg6) as lis_all_treg 
                FROM (
                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR6) as lis_treg6
                    from line_in_service 
                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                    ) as c
                GROUP BY dt_lis
                ORDER BY dt_lis DESC
                limit 1
            ';
        }else if($request->channel == 'tr7'){
            $sql1 = '
                select dt_lis, SUM(lis_treg7) as lis_all_treg 
                FROM (
                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR7) as lis_treg7
                    from line_in_service 
                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                    ) as c
                GROUP BY dt_lis
                ORDER BY dt_lis DESC
                limit 1
            ';
        }
                // dd(DB::select($sql1));
                // $lastmonnt = array();
        $lastmonnt = DB::select($sql1);
       
        // $lis_lastmonth = $lastmonnt;
        foreach($lastmonnt as $datalast ){
            $last_list = $datalast->lis_all_treg;

        }

        if(isset($last_list)){
            $last_list =$last_list;
        }else{
            $last_list = null;
        }
        // dd($last_list);

        if($request->channel == null || $request->channel == 'All'){
            //all trafik
        $sql = '
            select dt_tiket_all as parameter,tot_tiket_all ,comp_all_channel  as komplain,CASE when lis_all_treg is null then '.$last_list.' else lis_all_treg end as lis, 
            ROUND((comp_all_channel/CASE when lis_all_treg is null then '.$last_list.' else lis_all_treg end)*100) as CR 
            from (
                    select dt_tiket_all, SUM(treg1+treg2+treg3+treg4+treg5+treg6+treg7) as tot_tiket_all 
                    from (
                            select DATE_FORMAT(yearmonth, "%Y-%m") as dt_tiket_all,
                            SUM(TR1) as treg1,SUM(TR2)  as treg2 ,SUM(TR3)  as treg3,SUM(TR4)  as treg4,SUM(TR5)  as treg5,SUM(TR6)  as treg6,SUM(TR7)  as treg7
                            from percent_traffic
                            GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                        )as a
                        GROUP BY dt_tiket_all
                        ORDER BY dt_tiket_all DESC
                        Limit 12
                        ) as tbl_tiket_all
            left join (
                        select dt_all_channel,SUM(sosmed+komp147+plasa+myih) as comp_all_channel
                        from (
                                select DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,SUM(sosmed_komplain) as sosmed, SUM(komplain_147) as komp147 , SUM(plasa_komplain) as plasa, SUM(myih_komplain) as myih 
                                from data_trafik
                                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                        ) as b
                        GROUP BY dt_all_channel
                        ORDER BY dt_all_channel DESC
                        Limit 12
            ) as tbl_all_channel on tbl_all_channel.dt_all_channel = tbl_tiket_all.dt_tiket_all
            left JOIN ( 
                        SELECT dt_lis, SUM(lis_treg1+lis_treg2+lis_treg3+lis_treg4+lis_treg5+lis_treg6+lis_treg7) as lis_all_treg
                        FROM (
                                select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR1) as lis_treg1,SUM(TR2)  as lis_treg2 ,SUM(TR3)  as lis_treg3,SUM(TR4)  as lis_treg4,SUM(TR5)  as lis_treg5,SUM(TR6)  as lis_treg6,SUM(TR7)  as lis_treg7 
                                from line_in_service 
                                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                        ) as c
                        GROUP BY dt_lis
                        ORDER BY dt_lis DESC
                        LIMIT 12
            ) as tbl_lis on tbl_lis.dt_lis = tbl_tiket_all.dt_tiket_all
            ORDER BY dt_tiket_all
            ';

        }else if($request->channel == 'tr1'){
            // trafik treg1
            $sql ='
                select dt_tiket_all as parameter,prop_tiket_treg,treg1,ROUND(comp_all_channel*prop_tiket_treg,0) as komplain, 
                CASE when lis is null then '.$last_list.' else lis end as lis, 
                ROUND(((comp_all_channel*prop_tiket_treg)/CASE when lis is null then '.$last_list.' else lis end)*100) as CR 
                from (
                        select dt_tiket_all, treg1,(treg1 / (treg1+treg2+treg3+treg4+treg5+treg6+treg7)) as prop_tiket_treg,
                         (treg1+treg2+treg3+treg4+treg5+treg6+treg7) as tot_tiket_all 
                        from (
                                select DATE_FORMAT(yearmonth, "%Y-%m") as dt_tiket_all,
                                                SUM(TR1) as treg1,SUM(TR2) as treg2,SUM(TR3) as treg3,SUM(TR4) as treg4,SUM(TR5) as treg5,SUM(TR6) as treg6, SUM(TR7) as treg7
                                from percent_traffic
                                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                            )as a
                        GROUP BY dt_tiket_all
                        ORDER BY dt_tiket_all DESC
                        Limit 12
                ) as tbl_tiket_all
                left join (
                            select dt_all_channel,SUM(sosmed+komp147+plasa+myih) as comp_all_channel
                            from (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,SUM(sosmed_komplain) as sosmed, SUM(komplain_147) as komp147 , SUM(plasa_komplain) as plasa, SUM(myih_komplain) as myih 
                                    from data_trafik
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                                ) as b
                            GROUP BY dt_all_channel
                            ORDER BY dt_all_channel DESC
                            Limit 12
                ) as tbl_all_channel on tbl_all_channel.dt_all_channel = tbl_tiket_all.dt_tiket_all
                left JOIN ( 
                            SELECT dt_lis, SUM(lis_treg1) as lis 
                            FROM (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR1) as lis_treg1 
                                    from line_in_service 
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                                ) as c
                            GROUP BY dt_lis
                            ORDER BY dt_lis DESC
                            LIMIT 12
                )as tbl_lis on tbl_lis.dt_lis = tbl_tiket_all.dt_tiket_all
                ORDER BY dt_tiket_all 
                LIMIT 12
            ';
        }else if($request->channel == 'tr2'){
            $sql ='
                select dt_tiket_all as parameter,prop_tiket_treg,treg2,ROUND(comp_all_channel*prop_tiket_treg,0) as komplain, CASE when lis is null then '.$last_list.' else lis end as lis,
                        ROUND(((comp_all_channel*prop_tiket_treg)/CASE when lis is null then '.$last_list.' else lis end)*100) as CR 
                from (
                        select dt_tiket_all, treg2,(treg2 / (treg1+treg2+treg3+treg4+treg5+treg6+treg7)) as prop_tiket_treg, (treg1+treg2+treg3+treg4+treg5+treg6+treg7) as tot_tiket_all 
                        from (
                                select DATE_FORMAT(yearmonth, "%Y-%m") as dt_tiket_all,
                                                SUM(TR1) as treg1,SUM(TR2) as treg2,SUM(TR3) as treg3,SUM(TR4) as treg4,SUM(TR5) as treg5,SUM(TR6) as treg6, SUM(TR7) as treg7
                                from percent_traffic
                                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                            )as a
                        GROUP BY dt_tiket_all
                        ORDER BY dt_tiket_all DESC
                        Limit 12
                ) as tbl_tiket_all
                left join (
                            select dt_all_channel,SUM(sosmed+komp147+plasa+myih) as comp_all_channel
                            from (
                                select DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,SUM(sosmed_komplain) as sosmed, SUM(komplain_147) as komp147 , SUM(plasa_komplain) as plasa, SUM(myih_komplain) as myih 
                                from data_trafik
                                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                                ) as b
                            GROUP BY dt_all_channel
                            ORDER BY dt_all_channel DESC
                            Limit 12
                ) as tbl_all_channel on tbl_all_channel.dt_all_channel = tbl_tiket_all.dt_tiket_all
                left JOIN ( 
                            SELECT dt_lis, SUM(lis_treg2) as lis 
                            FROM (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR2) as lis_treg2 
                                    from line_in_service 
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                                ) as c
                            GROUP BY dt_lis
                            ORDER BY dt_lis DESC
                            LIMIT 12
                )as tbl_lis on tbl_lis.dt_lis = tbl_tiket_all.dt_tiket_all
                ORDER BY dt_tiket_all 
                LIMIT 12
            ';
        }else if($request->channel == 'tr3'){
            $sql ='
                select dt_tiket_all as parameter,prop_tiket_treg,treg3,ROUND(comp_all_channel*prop_tiket_treg,0) as komplain, CASE when lis is null then '.$last_list.' else lis end as lis, 
                ROUND(((comp_all_channel*prop_tiket_treg)/CASE when lis is null then '.$last_list.' else lis end)*100) as CR 
                from (
                        select dt_tiket_all, treg3,(treg3 / (treg1+treg2+treg3+treg4+treg5+treg6+treg7)) as prop_tiket_treg, 
                        (treg1+treg2+treg3+treg4+treg5+treg6+treg7) as tot_tiket_all 
                        from (
                                select DATE_FORMAT(yearmonth, "%Y-%m") as dt_tiket_all,
                                                SUM(TR1) as treg1,SUM(TR2) as treg2,SUM(TR3) as treg3,SUM(TR4) as treg4,SUM(TR5) as treg5,SUM(TR6) as treg6, SUM(TR7) as treg7
                                from percent_traffic
                                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                            )as a
                        GROUP BY dt_tiket_all
                        ORDER BY dt_tiket_all DESC
                        Limit 12
                ) as tbl_tiket_all
                left join (
                            select dt_all_channel,SUM(sosmed+komp147+plasa+myih) as comp_all_channel
                            from (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,SUM(sosmed_komplain) as sosmed, SUM(komplain_147) as komp147 , SUM(plasa_komplain) as plasa, SUM(myih_komplain) as myih 
                                    from data_trafik
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                                ) as b
                            GROUP BY dt_all_channel
                            ORDER BY dt_all_channel DESC
                            Limit 12
                ) as tbl_all_channel on tbl_all_channel.dt_all_channel = tbl_tiket_all.dt_tiket_all
                left JOIN ( 
                            SELECT dt_lis, SUM(lis_treg3) as lis 
                            FROM (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR3) as lis_treg3
                                    from line_in_service 
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                                ) as c
                            GROUP BY dt_lis
                            ORDER BY dt_lis DESC
                            LIMIT 12
                )as tbl_lis on tbl_lis.dt_lis = tbl_tiket_all.dt_tiket_all
                ORDER BY dt_tiket_all 
                LIMIT 12
            ';
        }else if($request->channel == 'tr4'){
            $sql = '
                select dt_tiket_all as parameter,prop_tiket_treg,treg4,ROUND(comp_all_channel*prop_tiket_treg,0) as komplain, CASE when lis is null then '.$last_list.' else lis end as lis,
                 ROUND(((comp_all_channel*prop_tiket_treg)/CASE when lis is null then '.$last_list.' else lis end)*100) as CR 
                from (
                        select dt_tiket_all, treg4,(treg4 / (treg1+treg2+treg3+treg4+treg5+treg6+treg7)) as prop_tiket_treg,
                         (treg1+treg2+treg3+treg4+treg5+treg6+treg7) as tot_tiket_all 
                        from (
                                select DATE_FORMAT(yearmonth, "%Y-%m") as dt_tiket_all,
                                                SUM(TR1) as treg1,SUM(TR2) as treg2,SUM(TR3) as treg3,SUM(TR4) as treg4,SUM(TR5) as treg5,SUM(TR6) as treg6, SUM(TR7) as treg7
                                from percent_traffic
                                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                                )as a
                        GROUP BY dt_tiket_all
                        ORDER BY dt_tiket_all DESC
                        Limit 12
                ) as tbl_tiket_all
                left join (
                            select dt_all_channel,SUM(sosmed+komp147+plasa+myih) as comp_all_channel
                            from (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,SUM(sosmed_komplain) as sosmed, SUM(komplain_147) as komp147 , SUM(plasa_komplain) as plasa, SUM(myih_komplain) as myih 
                                    from data_trafik
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                                ) as b
                            GROUP BY dt_all_channel
                            ORDER BY dt_all_channel DESC
                            Limit 12
                ) as tbl_all_channel on tbl_all_channel.dt_all_channel = tbl_tiket_all.dt_tiket_all
                left JOIN ( 
                            SELECT dt_lis, SUM(lis_treg4) as lis 
                            FROM (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR4) as lis_treg4
                                    from line_in_service 
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                                ) as c
                            GROUP BY dt_lis
                            ORDER BY dt_lis DESC
                            LIMIT 12
                )as tbl_lis on tbl_lis.dt_lis = tbl_tiket_all.dt_tiket_all
                ORDER BY dt_tiket_all 
                LIMIT 12
                ';
        }else if($request->channel == 'tr5'){
            $sql ='
                select dt_tiket_all as parameter,prop_tiket_treg,treg5,ROUND(comp_all_channel*prop_tiket_treg,0) as komplain, CASE when lis is null then '.$last_list.' else lis end as lis, 
                ROUND(((comp_all_channel*prop_tiket_treg)/CASE when lis is null then '.$last_list.' else lis end)*100) as CR 
                from (
                        select dt_tiket_all, treg5,(treg5 / (treg1+treg2+treg3+treg4+treg5+treg6+treg7)) as prop_tiket_treg, (treg1+treg2+treg3+treg4+treg5+treg6+treg7) as tot_tiket_all 
                        from (
                                select DATE_FORMAT(yearmonth, "%Y-%m") as dt_tiket_all,
                                                SUM(TR1) as treg1,SUM(TR2) as treg2,SUM(TR3) as treg3,SUM(TR4) as treg4,SUM(TR5) as treg5,SUM(TR6) as treg6, SUM(TR7) as treg7
                                from percent_traffic
                                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                            )as a
                        GROUP BY dt_tiket_all
                        ORDER BY dt_tiket_all DESC
                        Limit 12
                ) as tbl_tiket_all
                left join (
                            select dt_all_channel,SUM(sosmed+komp147+plasa+myih) as comp_all_channel
                            from (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,SUM(sosmed_komplain) as sosmed, SUM(komplain_147) as komp147 , SUM(plasa_komplain) as plasa, SUM(myih_komplain) as myih 
                                    from data_trafik
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                                ) as b
                            GROUP BY dt_all_channel
                            ORDER BY dt_all_channel DESC
                            Limit 12
                ) as tbl_all_channel on tbl_all_channel.dt_all_channel = tbl_tiket_all.dt_tiket_all
                left JOIN ( 
                            SELECT dt_lis, SUM(lis_treg5) as lis 
                            FROM (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR5) as lis_treg5
                                    from line_in_service 
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                                ) as c
                            GROUP BY dt_lis
                            ORDER BY dt_lis DESC
                            LIMIT 12
                )as tbl_lis on tbl_lis.dt_lis = tbl_tiket_all.dt_tiket_all
                ORDER BY dt_tiket_all 
                LIMIT 12
                ';
        }else if($request->channel == 'tr6'){
            $sql ='
                select dt_tiket_all as parameter,prop_tiket_treg,treg6,ROUND(comp_all_channel*prop_tiket_treg,0) as komplain, CASE when lis is null then '.$last_list.' else lis end as lis,
                 ROUND(((comp_all_channel*prop_tiket_treg)/CASE when lis is null then '.$last_list.' else lis end)*100) as CR 
                from (
                        select dt_tiket_all, treg6,(treg6 / (treg1+treg2+treg3+treg4+treg5+treg6+treg7)) as prop_tiket_treg, 
                        (treg1+treg2+treg3+treg4+treg5+treg6+treg7) as tot_tiket_all 
                        from (
                                select DATE_FORMAT(yearmonth, "%Y-%m") as dt_tiket_all,
                                                SUM(TR1) as treg1,SUM(TR2) as treg2,SUM(TR3) as treg3,SUM(TR4) as treg4,SUM(TR5) as treg5,SUM(TR6) as treg6, SUM(TR7) as treg7
                                from percent_traffic
                                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                            )as a
                        GROUP BY dt_tiket_all
                        ORDER BY dt_tiket_all DESC
                        Limit 12
                ) as tbl_tiket_all
                left join (
                            select dt_all_channel,SUM(sosmed+komp147+plasa+myih) as comp_all_channel
                            from (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,SUM(sosmed_komplain) as sosmed, SUM(komplain_147) as komp147 , 
                                            SUM(plasa_komplain) as plasa, SUM(myih_komplain) as myih 
                                    from data_trafik
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                                ) as b
                            GROUP BY dt_all_channel
                            ORDER BY dt_all_channel DESC
                            Limit 12
                ) as tbl_all_channel on tbl_all_channel.dt_all_channel = tbl_tiket_all.dt_tiket_all
                left JOIN ( 
                            SELECT dt_lis, SUM(lis_treg6) as lis 
                            FROM (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR6) as lis_treg6
                                    from line_in_service 
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                                ) as c
                            GROUP BY dt_lis
                            ORDER BY dt_lis DESC
                            LIMIT 12
                )as tbl_lis on tbl_lis.dt_lis = tbl_tiket_all.dt_tiket_all
                ORDER BY dt_tiket_all 
                LIMIT 12
                ';
        }else if($request->channel == 'tr7'){
            $sql ='
                select dt_tiket_all as parameter,prop_tiket_treg,treg7,ROUND(comp_all_channel*prop_tiket_treg,0) as komplain, CASE when lis is null then '.$last_list.' else lis end as lis,
                 ROUND(((comp_all_channel*prop_tiket_treg)/CASE when lis is null then '.$last_list.' else lis end)*100) as CR 
                from (
                        select dt_tiket_all, treg7,(treg7 / (treg1+treg2+treg3+treg4+treg5+treg6+treg7)) as prop_tiket_treg, (treg1+treg2+treg3+treg4+treg5+treg6+treg7) as tot_tiket_all 
                        from (
                                select DATE_FORMAT(yearmonth, "%Y-%m") as dt_tiket_all,
                                                SUM(TR1) as treg1,SUM(TR2) as treg2,SUM(TR3) as treg3,SUM(TR4) as treg4,SUM(TR5) as treg5,SUM(TR6) as treg6, SUM(TR7) as treg7
                                from percent_traffic
                                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                            )as a
                            GROUP BY dt_tiket_all
                            ORDER BY dt_tiket_all DESC
                            Limit 12
                ) as tbl_tiket_all
                left join (
                            select dt_all_channel,SUM(sosmed+komp147+plasa+myih) as comp_all_channel
                            from (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,SUM(sosmed_komplain) as sosmed, SUM(komplain_147) as komp147 ,
                                            SUM(plasa_komplain) as plasa, SUM(myih_komplain) as myih 
                                    from data_trafik
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                                ) as b
                            GROUP BY dt_all_channel
                            ORDER BY dt_all_channel DESC
                            Limit 12
                ) as tbl_all_channel on tbl_all_channel.dt_all_channel = tbl_tiket_all.dt_tiket_all
                left JOIN ( 
                            SELECT dt_lis, SUM(lis_treg7) as lis 
                            FROM (
                                    select DATE_FORMAT(yearmonth, "%Y-%m") dt_lis, SUM(TR7) as lis_treg7
                                    from line_in_service 
                                    GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                                ) as c
                            GROUP BY dt_lis
                            ORDER BY dt_lis DESC
                            LIMIT 12
                )as tbl_lis on tbl_lis.dt_lis = tbl_tiket_all.dt_tiket_all
                ORDER BY dt_tiket_all 
                LIMIT 12
                ';
        }

        //load query
        $data = DB::select($sql);

// dd($max_all_lis);
        $output = array();
        $param =array();
        $komp = array();
        $lis = array();
        $cr = array();
        foreach($data as $object){
            $param[] = $object->parameter;
            $komp[] =  $object->komplain;
            $lis[] = $object->lis;
            $cr[] = $object->CR.' %';
        }
        // dd(json_encode($cr));
        
        return view('others.table')->with([
                                            'data' => $data,
                                            'param' => $param,
                                            'komp' => $komp,
                                            'lis' => $lis,
                                            'cr' => $cr,
                                            'max' =>  $max_all_lis
                                        ]);
                                        
        
     }

     public function paramterView(){
        $member = $this->datacr($request->all());
         dd($member);
        $sql2 = '
        select  SUM(TR1+TR2+TR3+TR4+TR5+TR6+TR7)  as max_Lis_all FROM line_in_service
        where year(yearmonth) = "2022"
        GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
        order BY max_Lis_all desc
        limit 1
        ';

        $data_lis = DB::select($sql2);

        $maxlis = json_encode($data_lis[0]->max_Lis_all);
        echo $maxlis;
        // dd($data_lis[0]->max_Lis_all);
     }

    public function targetCR(){
        $now = new DateTime();
        // $today = date_format($now,"Y-m-d");
        $dates = date_format($now,"Y-m");
      

        return view('others.target',['dates' => $dates]);
    }


    public function Create_targetCR(){
        $now = new DateTime();
        $today = date_format($now,"d");
        // $dates = date_format($now,"Y-m");

        $today = $now->modify('-1 day')->format('Y-m-d'); //date('Y-m-d',strtotime('+1 day',$now));

        if($request->date == null){
            $dates = date_format($now,"Y-m");
        }else{
            $dates = $request->date.'-'.$today;
        }
        $getMonth = explode('-', $request->date);
        DB::table('target')->select('yearmonth')->whereMonth('yearmonth', $getMonth[1])->whereYear('yearmonth', $getMonth[0])->first();
        DB::table('target')->insertOrIgnore([
            ['yearmonth' => $dates, 'value' => $request->target]
        ]);

        return view('others.target',['dates' => $dates]);
    }
}

// dd($request->channel);
       /* if($request->channel == null || $request->channel == 'All'){
            $data = DB::table('data_trafik')
            ->Join('line_in_service',function ($join){ 
                 $join->on(DB::raw('MONTH(data_trafik.yearmonth)'), '=', DB::raw('MONTH(line_in_service.yearmonth)'));
                 $join->on(DB::raw('YEAR(data_trafik.yearmonth)'), '=', DB::raw('YEAR(line_in_service.yearmonth)'));
                })
            ->join('percent_traffic', function ($join1){
                $join1->on(DB::raw('MONTH(data_trafik.yearmonth)'), '=', DB::raw('MONTH(percent_traffic.yearmonth)'));
                $join1->on(DB::raw('YEAR(data_trafik.yearmonth)'), '=', DB::raw('YEAR(percent_traffic.yearmonth)'));
            })
            ->select(DB::raw("DATE_FORMAT(data_trafik.yearmonth, '%Y-%m')  as parameter"), 
                    DB::raw('SUM(komplain_147) + SUM(plasa_komplain) + SUM(myih_komplain) + SUM(sosmed_komplain)  as komplain'),
                    DB::raw('SUM(line_in_service.tr1) + SUM(line_in_service.tr2) + SUM(line_in_service.tr3) + SUM(line_in_service.tr4) + SUM(line_in_service.tr5) + SUM(line_in_service.tr6) + SUM(line_in_service.tr7) as lis'),
                    DB::raw('ROUND((SUM(komplain_147) + SUM(plasa_komplain) + SUM(myih_komplain) + SUM(sosmed_komplain)) /
                            (SUM(line_in_service.tr1) + SUM(line_in_service.tr2) + SUM(line_in_service.tr3) + SUM(line_in_service.tr4) + SUM(line_in_service.tr5) + SUM(line_in_service.tr6) + SUM(line_in_service.tr7))*100,0) as CR'))
            ->whereYear('data_trafik.yearmonth', $getDate[0])
            ->groupBy(DB::raw("DATE_FORMAT(data_trafik.yearmonth, '%Y-%m')"))
            ->orderBy('data_trafik.yearmonth')
            ->get();
        }else if($request->channel == 'tr1'){
            $subQuery = DB::table('percent_traffic')->select(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m") as month_trafik'), 
            DB::raw('SUM(TR1) as treg1'), DB::raw('SUM(TR2) as treg2'), DB::raw('SUM(TR3) as treg3'), DB::raw('SUM(TR4) as treg4') , 
            DB::raw('SUM(TR5) as treg5'), DB::raw('SUM(TR6) as treg6'), DB::raw('SUM(TR7) as treg7'))
                ->whereYear('yearmonth',  $getDate[0])
                ->groupBy(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m")'));
                
            $data = DB::table(DB::raw('('.$subQuery->toSql().') as x'))
                ->select('month_trafik as parameter',
                DB::raw('Round(treg1/(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7)*100,0) as proposi_per_treg'),
                DB::raw('Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg1 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0)  as komplain'),
                DB::raw('SUM(line_in_service.TR1) as lis'),
                DB::raw('ROUND(Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg1 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0) / SUM(line_in_service.TR1)*100) as CR'))
                ->join('data_trafik', function ($join){ 
                    $join->on(DB::raw('LEFT(x.month_trafik,4)'), '=', DB::raw('YEAR(data_trafik.yearmonth)'));
                    $join->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(data_trafik.yearmonth)'));
                })
                ->join('line_in_service', function ($join1){
                    $join1->on(DB::raw('LEFT(x.month_trafik,4)'),'=',DB::raw('YEAR(line_in_service.yearmonth)'));
                    $join1->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(line_in_service.yearmonth)'));
                    })
                ->whereYear('data_trafik.yearmonth',$getDate[0])
                ->whereYear('line_in_service.yearmonth',$getDate[0])
                ->groupBy('x.month_trafik')
                ->mergeBindings($subQuery)
                ->get();
        }else if($request->channel == 'tr2'){
            $subQuery = DB::table('percent_traffic')->select(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m") as month_trafik'), 
            DB::raw('SUM(TR1) as treg1'), DB::raw('SUM(TR2) as treg2'), DB::raw('SUM(TR3) as treg3'), DB::raw('SUM(TR4) as treg4') , 
            DB::raw('SUM(TR5) as treg5'), DB::raw('SUM(TR6) as treg6'), DB::raw('SUM(TR7) as treg7'))
                ->whereYear('yearmonth',  $getDate[0])
                ->groupBy(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m")'));
                
            $data = DB::table(DB::raw('('.$subQuery->toSql().') as x'))
                ->select('month_trafik as parameter',
                DB::raw('Round(treg2/(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7)*100,0) as proposi_per_treg'),
                DB::raw('Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg2 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0)  as komplain'),
                DB::raw('SUM(line_in_service.TR2) as lis'),
                DB::raw('ROUND(Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg2 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0) / SUM(line_in_service.TR2)*100) as CR'))
                ->join('data_trafik', function ($join){ 
                    $join->on(DB::raw('LEFT(x.month_trafik,4)'), '=', DB::raw('YEAR(data_trafik.yearmonth)'));
                    $join->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(data_trafik.yearmonth)'));
                })
                ->join('line_in_service', function ($join1){
                    $join1->on(DB::raw('LEFT(x.month_trafik,4)'),'=',DB::raw('YEAR(line_in_service.yearmonth)'));
                    $join1->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(line_in_service.yearmonth)'));
                    })
                ->whereYear('data_trafik.yearmonth',$getDate[0])
                ->whereYear('line_in_service.yearmonth',$getDate[0])
                ->groupBy('x.month_trafik')
                ->mergeBindings($subQuery)
                ->get();
        }else if($request->channel == 'tr3'){
            $subQuery = DB::table('percent_traffic')->select(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m") as month_trafik'), 
            DB::raw('SUM(TR1) as treg1'), DB::raw('SUM(TR2) as treg2'), DB::raw('SUM(TR3) as treg3'), DB::raw('SUM(TR4) as treg4') , 
            DB::raw('SUM(TR5) as treg5'), DB::raw('SUM(TR6) as treg6'), DB::raw('SUM(TR7) as treg7'))
                ->whereYear('yearmonth',  $getDate[0])
                ->groupBy(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m")'));
                
            $data = DB::table(DB::raw('('.$subQuery->toSql().') as x'))
                ->select('month_trafik as parameter',
                DB::raw('Round(treg3/(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7)*100,0) as proposi_per_treg'),
                DB::raw('Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg3 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0)  as komplain'),
                DB::raw('SUM(line_in_service.TR3) as lis'),
                DB::raw('ROUND(Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg3 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0) / SUM(line_in_service.TR3)*100) as CR'))
                ->join('data_trafik', function ($join){ 
                    $join->on(DB::raw('LEFT(x.month_trafik,4)'), '=', DB::raw('YEAR(data_trafik.yearmonth)'));
                    $join->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(data_trafik.yearmonth)'));
                })
                ->join('line_in_service', function ($join1){
                    $join1->on(DB::raw('LEFT(x.month_trafik,4)'),'=',DB::raw('YEAR(line_in_service.yearmonth)'));
                    $join1->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(line_in_service.yearmonth)'));
                    })
                ->whereYear('data_trafik.yearmonth',$getDate[0])
                ->whereYear('line_in_service.yearmonth',$getDate[0])
                ->groupBy('x.month_trafik')
                ->mergeBindings($subQuery)
                ->get();
        }else if($request->channel == 'tr4'){
            $subQuery = DB::table('percent_traffic')->select(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m") as month_trafik'), 
            DB::raw('SUM(TR1) as treg1'), DB::raw('SUM(TR2) as treg2'), DB::raw('SUM(TR3) as treg3'), DB::raw('SUM(TR4) as treg4') , 
            DB::raw('SUM(TR5) as treg5'), DB::raw('SUM(TR6) as treg6'), DB::raw('SUM(TR7) as treg7'))
                ->whereYear('yearmonth',  $getDate[0])
                ->groupBy(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m")'));
                
            $data = DB::table(DB::raw('('.$subQuery->toSql().') as x'))
                ->select('month_trafik as parameter',
                DB::raw('Round(treg4/(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7)*100,0) as proposi_per_treg'),
                DB::raw('Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg4 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0)  as komplain'),
                DB::raw('SUM(line_in_service.TR4) as lis'),
                DB::raw('ROUND(Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg4 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0) / SUM(line_in_service.TR4)*100) as CR'))
                ->join('data_trafik', function ($join){ 
                    $join->on(DB::raw('LEFT(x.month_trafik,4)'), '=', DB::raw('YEAR(data_trafik.yearmonth)'));
                    $join->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(data_trafik.yearmonth)'));
                })
                ->join('line_in_service', function ($join1){
                    $join1->on(DB::raw('LEFT(x.month_trafik,4)'),'=',DB::raw('YEAR(line_in_service.yearmonth)'));
                    $join1->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(line_in_service.yearmonth)'));
                    })
                ->whereYear('data_trafik.yearmonth',$getDate[0])
                ->whereYear('line_in_service.yearmonth',$getDate[0])
                ->groupBy('x.month_trafik')
                ->mergeBindings($subQuery)
                ->get();
        }else if($request->channel == 'tr5'){
            $subQuery = DB::table('percent_traffic')->select(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m") as month_trafik'), 
            DB::raw('SUM(TR1) as treg1'), DB::raw('SUM(TR2) as treg2'), DB::raw('SUM(TR3) as treg3'), DB::raw('SUM(TR4) as treg4') , 
            DB::raw('SUM(TR5) as treg5'), DB::raw('SUM(TR6) as treg6'), DB::raw('SUM(TR7) as treg7'))
                ->whereYear('yearmonth',  $getDate[0])
                ->groupBy(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m")'));
                
            $data = DB::table(DB::raw('('.$subQuery->toSql().') as x'))
                ->select('month_trafik as parameter',
                DB::raw('Round(treg5/(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7)*100,0) as proposi_per_treg'),
                DB::raw('Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg5 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0)  as komplain'),
                DB::raw('SUM(line_in_service.TR5) as lis'),
                DB::raw('ROUND(Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg5 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0) / SUM(line_in_service.TR5)*100) as CR'))
                ->join('data_trafik', function ($join){ 
                    $join->on(DB::raw('LEFT(x.month_trafik,4)'), '=', DB::raw('YEAR(data_trafik.yearmonth)'));
                    $join->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(data_trafik.yearmonth)'));
                })
                ->join('line_in_service', function ($join1){
                    $join1->on(DB::raw('LEFT(x.month_trafik,4)'),'=',DB::raw('YEAR(line_in_service.yearmonth)'));
                    $join1->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(line_in_service.yearmonth)'));
                    })
                ->whereYear('data_trafik.yearmonth',$getDate[0])
                ->whereYear('line_in_service.yearmonth',$getDate[0])
                ->groupBy('x.month_trafik')
                ->mergeBindings($subQuery)
                ->get();
        }else if($request->channel == 'tr6'){
            $subQuery = DB::table('percent_traffic')->select(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m") as month_trafik'), 
            DB::raw('SUM(TR1) as treg1'), DB::raw('SUM(TR2) as treg2'), DB::raw('SUM(TR3) as treg3'), DB::raw('SUM(TR4) as treg4') , 
            DB::raw('SUM(TR5) as treg5'), DB::raw('SUM(TR6) as treg6'), DB::raw('SUM(TR7) as treg7'))
                ->whereYear('yearmonth',  $getDate[0])
                ->groupBy(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m")'));
                
            $data = DB::table(DB::raw('('.$subQuery->toSql().') as x'))
                ->select('month_trafik as parameter',
                DB::raw('Round(treg6/(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7)*100,0) as proposi_per_treg'),
                DB::raw('Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg6 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0)  as komplain'),
                DB::raw('SUM(line_in_service.TR6) as lis'),
                DB::raw('ROUND(Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg6 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0) / SUM(line_in_service.TR6)*100) as CR'))
                ->join('data_trafik', function ($join){ 
                    $join->on(DB::raw('LEFT(x.month_trafik,4)'), '=', DB::raw('YEAR(data_trafik.yearmonth)'));
                    $join->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(data_trafik.yearmonth)'));
                })
                ->join('line_in_service', function ($join1){
                    $join1->on(DB::raw('LEFT(x.month_trafik,4)'),'=',DB::raw('YEAR(line_in_service.yearmonth)'));
                    $join1->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(line_in_service.yearmonth)'));
                    })
                ->whereYear('data_trafik.yearmonth',$getDate[0])
                ->whereYear('line_in_service.yearmonth',$getDate[0])
                ->groupBy('x.month_trafik')
                ->mergeBindings($subQuery)
                ->get();
        }else if($request->channel == 'tr7'){
            $subQuery = DB::table('percent_traffic')->select(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m") as month_trafik'), 
            DB::raw('SUM(TR1) as treg1'), DB::raw('SUM(TR2) as treg2'), DB::raw('SUM(TR3) as treg3'), DB::raw('SUM(TR4) as treg4') , 
            DB::raw('SUM(TR5) as treg5'), DB::raw('SUM(TR6) as treg6'), DB::raw('SUM(TR7) as treg7'))
                ->whereYear('yearmonth',  $getDate[0])
                ->groupBy(DB::raw('DATE_FORMAT(yearmonth,"%Y-%m")'));
                
            $data = DB::table(DB::raw('('.$subQuery->toSql().') as x'))
                ->select('month_trafik as parameter',
                DB::raw('Round(treg7/(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7)*100,0) as proposi_per_treg'),
                DB::raw('Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg7 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0)  as komplain'),
                DB::raw('SUM(line_in_service.TR7) as lis'),
                DB::raw('ROUND(Round((SUM(data_trafik.sosmed_komplain) + SUM(data_trafik.komplain_147) + SUM(data_trafik.plasa_komplain) + SUM(data_trafik.myih_komplain)) * (SUM(treg7 /(treg1 + treg2 + treg3 + treg4 + treg5 + treg6 + treg7))),0) / SUM(line_in_service.TR7)*100) as CR'))
                ->join('data_trafik', function ($join){ 
                    $join->on(DB::raw('LEFT(x.month_trafik,4)'), '=', DB::raw('YEAR(data_trafik.yearmonth)'));
                    $join->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(data_trafik.yearmonth)'));
                })
                ->join('line_in_service', function ($join1){
                    $join1->on(DB::raw('LEFT(x.month_trafik,4)'),'=',DB::raw('YEAR(line_in_service.yearmonth)'));
                    $join1->on(DB::raw('RIGHT(x.month_trafik,2)'),'=', DB::raw('MONTH(line_in_service.yearmonth)'));
                    })
                ->whereYear('data_trafik.yearmonth',$getDate[0])
                ->whereYear('line_in_service.yearmonth',$getDate[0])
                ->groupBy('x.month_trafik')
                ->mergeBindings($subQuery)
                ->get();

                
                    //all trafik
                'select comp_traf as parameter,tot_all ,comp_channel  as komplain, lis, ROUND((comp_channel/lis)*100) as CR from (
                select comp_traf, SUM(treg1+treg2+treg3+treg4+treg5+treg6+treg7) as tot_all from (select DATE_FORMAT(yearmonth, "%Y-%m") as comp_traf,
                SUM(TR1) as treg1,SUM(TR2)  as treg2 ,SUM(TR3)  as treg3,SUM(TR4)  as treg4,SUM(TR5)  as treg5,SUM(TR6)  as treg6,SUM(TR7)  as treg7
                from percent_traffic
                where year(yearmonth)='.$getDate[0].'
                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                )as y
                GROUP BY comp_traf
                ) as g
                left join (
                select all_channel,SUM(sosmed+komp147+plasa+myih) as comp_channel
                from (
                select DATE_FORMAT(yearmonth, "%Y-%m") as all_channel,SUM(sosmed_komplain) as sosmed, SUM(komplain_147) as komp147 , SUM(plasa_komplain) as plasa, SUM(myih_komplain) as myih 
                from data_trafik
                where year(yearmonth)='.$getDate[0].'
                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                ) as x
                GROUP BY all_channel) as t on t.all_channel = g.comp_traf
                left JOIN ( 
                SELECT all_lis, SUM(lis_treg1+lis_treg2+lis_treg3+lis_treg4+lis_treg5+lis_treg6+lis_treg7) as lis 
                FROM (
                        select DATE_FORMAT(yearmonth, "%Y-%m") all_lis, SUM(TR1) as lis_treg1,SUM(TR2)  as lis_treg2 ,SUM(TR3)  as lis_treg3,SUM(TR4)  as lis_treg4,SUM(TR5)  as lis_treg5,SUM(TR6)  as lis_treg6,SUM(TR7)  as lis_treg7 from line_in_service 
                where year(yearmonth) ='.$getDate[0].'
                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                ) as u
                GROUP BY all_lis
                )as i on i.all_lis = g.comp_traf
            ';

                    //trafik treg1
                'select comp_traf as parameter,treg1,ROUND(comp_channel*tot_all,0) as komplain, lis, ROUND(((comp_channel*tot_all)/lis)*100) as CR from (
                select comp_traf, treg1,round((treg1 / (treg1+treg2+treg3+treg4+treg5+treg6+treg7)),2) as tot_all, (treg1+treg2+treg3+treg4+treg5+treg6+treg7) as tot_tiket_all  from (
                select DATE_FORMAT(yearmonth, "%Y-%m") as comp_traf,
                SUM(TR1) as treg1,SUM(TR2) as treg2,SUM(TR3) as treg3,SUM(TR4) as treg4,SUM(TR5) as treg5,SUM(TR6) as treg6, SUM(TR7) as treg7
                from percent_traffic
                where year(yearmonth)='.$getDate[0].'
                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                )as y
                GROUP BY comp_traf
                ) as g
                left join (
                select all_channel,SUM(sosmed+komp147+plasa+myih) as comp_channel
                from (
                select DATE_FORMAT(yearmonth, "%Y-%m") as all_channel,SUM(sosmed_komplain) as sosmed, SUM(komplain_147) as komp147 , SUM(plasa_komplain) as plasa, SUM(myih_komplain) as myih 
                from data_trafik
                where year(yearmonth)='.$getDate[0].'
                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m")
                ) as x
                GROUP BY all_channel) as t on t.all_channel = g.comp_traf
                left JOIN ( 
                SELECT all_lis, SUM(lis_treg1) as lis 
                FROM (
                        select DATE_FORMAT(yearmonth, "%Y-%m") all_lis, SUM(TR1) as lis_treg1 from line_in_service 
                where year(yearmonth) ='.$getDate[0].'
                GROUP BY  DATE_FORMAT(yearmonth, "%Y-%m") 
                ) as u
                GROUP BY all_lis
                )as i on i.all_lis = g.comp_traf
            ';
        }*/
