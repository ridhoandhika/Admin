<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;

class DashboardController extends Controller
{

    public function index(){
        $now = new DateTime();
            

        $sql = '
                select DATE_FORMAT(yearmonth, "%Y") dt_lis
                from line_in_service 
                GROUP BY dt_lis
            ';

           

        $year = DB::select($sql);
        // dd($updchannel);
        $yearnow = array();
        foreach($year as $yr ){
            $yearnow[] = $yr->dt_lis;
            arsort( $yearnow );
        }
        return view('others.dashboard_cr', ['year' => $yearnow]);
    }

    public function filter(Request $request){
        $now = new DateTime();
        $dates = date_format($now,"Y-m");
        $getDate = explode("-", $dates);
        if($request->year == null){
            $year = $getDate[0];
        }else{
            $year = $request->year;
        }
      
        $lastchannel = DB::select('select yearmonth
                                    from data_channel
                                    order by yearmonth DESC
                                    limit 1');
        $last = array();
        foreach($lastchannel as $lst){
            $last[] = $lst->yearmonth;
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
        }
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
        $lastmonnt = DB::select($sql1);
       
        foreach($lastmonnt as $datalast ){
            $last_list = $datalast->lis_all_treg;

        }

        if(isset($last_list)){
            $last_list =$last_list;
        }else{
            $last_list = null;
        }

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
                            select dt_all_channel, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as comp_all_channel
                            from (
                                    SELECT DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,
                                                    case when channel="sosmed" then SUM(value)  end as sosmed , 
                                                    case when channel="myih" then SUM(value)  end as myih,
                                                    case when channel="comp147" then SUM(value)  end as com147,
                                                    case when channel="plasa" then SUM(value) end as plasa  
                                    FROM `data_channel`
                                    GROUP BY channel,dt_all_channel
                                    ORDER BY dt_all_channel DESC
                            ) as x
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
                ORDER BY dt_tiket_all';

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
                        select dt_all_channel, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as comp_all_channel
                        from (
                                SELECT DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,
                                                case when channel="sosmed" then SUM(value)  end as sosmed , 
                                                case when channel="myih" then SUM(value)  end as myih,
                                                case when channel="comp147" then SUM(value)  end as com147,
                                                case when channel="plasa" then SUM(value) end as plasa  
                                FROM `data_channel`
                                GROUP BY channel,dt_all_channel
                                ORDER BY dt_all_channel DESC
                        ) as x
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
                LIMIT 12';
                
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
                        select dt_all_channel, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as comp_all_channel
                        from (
                                SELECT DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,
                                                case when channel="sosmed" then SUM(value)  end as sosmed , 
                                                case when channel="myih" then SUM(value)  end as myih,
                                                case when channel="comp147" then SUM(value)  end as com147,
                                                case when channel="plasa" then SUM(value) end as plasa  
                                FROM `data_channel`
                                GROUP BY channel,dt_all_channel
                                ORDER BY dt_all_channel DESC
                        ) as x
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
                LIMIT 12';

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
                        select dt_all_channel, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as comp_all_channel
                        from (
                                SELECT DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,
                                                case when channel="sosmed" then SUM(value)  end as sosmed , 
                                                case when channel="myih" then SUM(value)  end as myih,
                                                case when channel="comp147" then SUM(value)  end as com147,
                                                case when channel="plasa" then SUM(value) end as plasa  
                                FROM `data_channel`
                                GROUP BY channel,dt_all_channel
                                ORDER BY dt_all_channel DESC
                        ) as x
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
                LIMIT 12';

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
                        select dt_all_channel, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as comp_all_channel
                        from (
                                SELECT DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,
                                                case when channel="sosmed" then SUM(value)  end as sosmed , 
                                                case when channel="myih" then SUM(value)  end as myih,
                                                case when channel="comp147" then SUM(value)  end as com147,
                                                case when channel="plasa" then SUM(value) end as plasa  
                                FROM `data_channel`
                                GROUP BY channel,dt_all_channel
                                ORDER BY dt_all_channel DESC
                        ) as x
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
                LIMIT 12';

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
                        select dt_all_channel, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as comp_all_channel
                        from (
                                SELECT DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,
                                                case when channel="sosmed" then SUM(value)  end as sosmed , 
                                                case when channel="myih" then SUM(value)  end as myih,
                                                case when channel="comp147" then SUM(value)  end as com147,
                                                case when channel="plasa" then SUM(value) end as plasa  
                                FROM `data_channel`
                                GROUP BY channel,dt_all_channel
                                ORDER BY dt_all_channel DESC
                        ) as x
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
                LIMIT 12';


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
                        select dt_all_channel, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as comp_all_channel
                        from (
                                SELECT DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,
                                                case when channel="sosmed" then SUM(value)  end as sosmed , 
                                                case when channel="myih" then SUM(value)  end as myih,
                                                case when channel="comp147" then SUM(value)  end as com147,
                                                case when channel="plasa" then SUM(value) end as plasa  
                                FROM `data_channel`
                                GROUP BY channel,dt_all_channel
                                ORDER BY dt_all_channel DESC
                        ) as x
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
                LIMIT 12';


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
                        select dt_all_channel, (SUM(sosmed) + SUM(myih) + SUM(com147) + SUM(plasa)) as comp_all_channel
                        from (
                                SELECT DATE_FORMAT(yearmonth, "%Y-%m") as dt_all_channel,
                                                case when channel="sosmed" then SUM(value)  end as sosmed , 
                                                case when channel="myih" then SUM(value)  end as myih,
                                                case when channel="comp147" then SUM(value)  end as com147,
                                                case when channel="plasa" then SUM(value) end as plasa  
                                FROM `data_channel`
                                GROUP BY channel,dt_all_channel
                                ORDER BY dt_all_channel DESC
                        ) as x
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
                LIMIT 12';

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
        // dd($last);
        
        return view('others.table')->with([
                                            'data' => $data,
                                            'param' => $param,
                                            'komp' => $komp,
                                            'lis' => $lis,
                                            'cr' => $cr,
                                            'max' =>  $max_all_lis,
                                            'lastchannel' => $lastchannel,
                                            'last' => $last,
                                        ]);
                                        
        
    }
}
