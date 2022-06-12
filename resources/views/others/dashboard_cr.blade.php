@extends('layouts.master')

@section('title', 'KPI C4')

@section('headerStyle')
        <!-- Plugins css -->
<link href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
<link href="{{ URL::asset('plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('plugins/timepicker/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
<link href="{{ URL::asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />
@stop

@section('content')
        <div class="container-fluid">
            <div class="row" style="padding-top: 10px;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group row ml-3 mt-2">
                                        <h3>Trend Complain Rate (MyIH, Socmed, 147, Plasa)</h3>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row justify-content-end"> 
                                        {{-- <form action ="{{ route('indexTraffic') }}" method="GET"> --}}
                                        <div class="form-group row mr-2">
                                            <div class="col-lg-12">
                                            <label>Regional</label>
                                                <select class="select form-control custom-select bg-primary text-light" id="channel" name="channel" aria-hidden="true">
                                                        <option value="">All Regional</option>
                                                        <option value="tr1">Regional 1</option>
                                                        <option value="tr2">Regional 2</option>
                                                        <option value="tr3">Regional 3</option>
                                                        <option value="tr4">Regional 4</option>
                                                        <option value="tr5">Regional 5</option>
                                                        <option value="tr6">Regional 6</option>
                                                        <option value="tr7">Regional 7</option>
                                                </select>
                                            </div> 
                                            {{-- <div class="col-lg-4">
                                                <label>Tahun</label>
                                                    <select class="select form-control custom-select bg-primary text-light" id="year" name="channel" aria-hidden="true">
                                                        @foreach($year as $yr)    
                                                            <option value="{{$yr}}">{{$yr}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>  --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="read" id="read">
                                        {{-- <table class="table table-bordered mb-0" id="mytable">
                                            <thead>
                                                <tr style="background-color: #F0F8FF; vertical-align: middle; font-weight: bold; text-align: center; font-size: 12px;">
                                                    <th style="font-weight: bold;">PARAMETER</th>
                                                    
                                                    @foreach($data as $d)
                                                        <td id="parameter">{{ $d->parameter }}</td>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody style="background-color: #FFFFFF; color: #000000; font-size: 12px; border-style: solid; border-color: #C0C0C0; border-width: 1px;">
                                                <tr>
                                                    <tr>
                                                    <td style="font-weight: bold;">TRAFIK COMP</td>
                                                    @foreach($data as $d)
                                                        <td id="parameter">{{ $d->komplain }}</td>
                                                    @endforeach
                                                    </tr>
                                                    <tr>
                                                    <td style="font-weight: bold;">LIS</td>
                                                    @foreach($data as $d)
                                                        <td id="parameter">{{ $d->lis }}</td>
                                                    @endforeach
                                                    </tr>
                                                    <tr>
                                                    <td style="font-weight: bold;">CR</td>
                                                    @foreach($data as $d)
                                                   <td> {{ $d->CR }} %</td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table> --}}
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js')}}"></script>
        <script type="text/javascript"> 
            $(function(){
                filter();
                $('#channel').on('change', function(e){
                   filter();
                });
                $('#year').on('change', function(e){
                   filter();
                });
                setInterval(() => {
                    filter();
                }, 120000);
               
                function filter(){
                    $.ajax({
                    type: 'GET',
                    url: '/filter?channel='+$('#channel option:selected').val(),
                    datatype: 'json',
                    success: function(data){
                        $('#read').html(data);
                        // $('#chart').html();
                    },  
                    error: function(){
                        console.log('AJAX load did not work');
                    }
                });
                }

            });
        </script>
@endsection

@section('footerScript')
        <script src="{{ URL::asset('plugins/moment/moment.js')}}"></script>
        <script src="{{ URL::asset('plugins/apexcharts/irregular-data-series.js')}}"></script>
        <script src="{{ URL::asset('plugins/apexcharts/ohlc.js')}}"></script>
        {{-- <script src="{{ URL::asset('assets/pages/jquery.apexcharts.init.js')}}"></script> --}}

        <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{ URL::asset('plugins/select2/select2.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{ URL::asset('assets/pages/jquery.forms-advanced.js')}}"></script>
@stop