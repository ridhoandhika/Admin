
<div class="chart-demo" id="chart">
    <div id="complain_rate" class="apex-charts"></div>
</div>
<table class="table table-bordered mb-0" id="mytable">
    <thead>
        <tr style="background-color: #F0F8FF; vertical-align: middle; font-weight: bold; text-align: center; font-size: 14px;">
            <th style="font-weight: bold;">PARAMETER</th>
            
            @foreach($data as $d)
                <th id="parameter" style="font-weight: bold;">{{ $d->parameter }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody style="background-color: #ffffff; vertical-align: middle; font-weight: bold; text-align: center; font-size: 12px;">
        <tr>
            <tr>
            <th style="font-weight: bold;">TRAFIK COMP</th>
            @foreach($data as $d)
                <th style="font-weight: bold;">{{ number_format($d->komplain) }}</th>
            @endforeach
            </tr>
            <tr>
            <th style="font-weight: bold;">LIS</th>
            @foreach($data as $d)
                <th style="font-weight: bold;">{{ number_format($d->lis) }}</th>
            @endforeach
            </tr>
            <tr>
            <th style="font-weight: bold;">CR</th>
            @foreach($data as $d)
           <th style="font-weight: bold;"> {{ number_format($d->CR) }} %</th>
            @endforeach
        </tr>
    </tbody>
</table>
{{-- <script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js')}}"></script> --}}
<script type="text/javascript"> 
    var par = <?php echo json_encode($param) ?>;
    var komp = <?php echo json_encode($komp) ?>;
    var lis = <?php echo json_encode($lis) ?>;
    var cr = <?php echo json_encode($cr) ?>;
    var max_lis = <?php echo json_encode($max) ?>;
    var last = <?php echo json_encode($last) ?>;


    $(function(){
        chart.render();
    });

    var chart;
    var options;
    if (document.querySelector("#complain_rate") != undefined) {
    options = {
        chart: {
        height: 370,
        type: 'line',
        color: ['#ed7e0a'],
        stacked: false,
        toolbar: {
            show: false
        },
        },
        dataLabels: {
        enabled: true,
        enabledOnSeries: [2],
        borderColor: 'red',
        borderWidth: 2,
        padding: 5,
        shadow: true,
        style: {
            fontWeight: 'bold',
            fontSize: 20,
            colors: ['#000000', '#000000', '#000000', '#000000']
        }
        },

        stroke: {
        show: true,
        width: [0,0,2,2],
        colors: ['#000000','#000000','#000000','#000000'],
        curve: 'straight'
        },
        plotOptions: {
        bar: {
            horizontal: false,
            endingShape: 'rounded',
            columnWidth: '20%',
            dataLabels: {
            position: 'top',
            },
        },
        series: {
            dataLabels: {
            enabled: false,
            borderRadius: 5,
            backgroundColor: 'rgba(252, 255, 197, 0.7)',
            borderWidth: 1,
            borderColor: '#AAA',
            y: -5
            }
        },
        },

        colors: ["#1ecab8", "#f93b7a", "#f6d365","#e86a10"],
        series: [ {
        name: 'Traffic Complain',
        type: 'column',
        data: komp,
        },{
        name: 'Line in Service',
        type: 'column',
        data: lis,
        }, {
        name: "Complain Rate",
        type: 'line',
        data: cr,
        },
        {
        name: "Target",
        type: 'line',
        data: [12, 12, 12, 12, 12, 12, 12, 12, 12, 12,12,12.1],
        style:{
            color: "#fff"
        }
        } ],

        title: {
        text: 'last update Channel: '+last,
        align: 'left',
        style: {
            fontSize: "12px",
            color:  '#000000'
            }
        },

        fill: {
        type: 'gradient',
        gradient: {
            shade: 'dark',
            shadeIntensity: 1,
            type: 'horizontal',
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100, 100, 100]
        },
        },

        markers: {
        size: 1,
        opacity: 0.9,
        colors: ["#000000"],
        strokeColor: "#ffffff",
        strokeWidth: 2,
        style: 'inverted', 
        hover: {
            size: 7,
        }
        },

        legend: {
        position: 'top',
        horizontalAlign: 'right',
        floating: true,
        offsetY: -25,
        offsetX: 5
        },

        xaxis: {
        categories: par 
        },

        yaxis: [
            {
            seriesName: 'All Traffic',
            max: max_lis/1.1,
            show: false,
            axisTicks: {
            show: true
            },
            axisBorder: {
            show: true,
            },
            title: {
            text: "Parameter"
            }
        },
       {
            seriesName: 'All Traffic',
            show: true,
            max: max_lis,
            axisTicks: {
            show: true
            },
            axisBorder: {
            show: true,
            },
            title: {
            text: "LIS & Trafik Complaint"
            }
        },
        {
            seriesName: 'All Traffic',
            show: false,
            opposite: true,
            max: 30,
            text: "Complain Rate & Target"

        },
        
        {
            seriesName: 'All Traffic',
            show: true,
            opposite: true,
            max: 30,
            title: {
            text: "Complain Rate & Target"
            }
        },
         /*{
            opposite: true,
            
            forceNiceScale: true,
            axisTicks: {
            show: false
            },
            axisBorder: {
            show: false,
            },
            title: {
            text: "Complain Rate"
            }
            title: {
            text: "Target"
            }
        }*/
        ],

        tooltip: {
        shared: false,
        intersect: false,
        y: {
            formatter: function (y) {
            if (typeof y !== "undefined") {
                return y.toFixed(2) + " Data";
            }
            return y;
            }
        }
        },

        grid: {
        borderColor: '#f1f3fa'
        },

        responsive: [{
        breakpoint: 600,
        options: {
            yaxis: {
            show: true
            },
            legend: {
            show: true
            }
        }
        }]
    }
    
    chart = new ApexCharts(document.querySelector("#complain_rate"), options);
    }
  
</script>