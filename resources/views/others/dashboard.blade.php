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
                                <div class="col-3">
                                    <h4 class="header-title" style="font-weight: bold; font-size: 20px; text-align: center;">Achievement</h4>
                                    <div id="apex_radialbar3" class="apex-charts"></div>
                                </div>
                                <div class="col-3">
                                    <h4 class="header-title" style="font-weight: bold; font-size: 20px;">Parameter KPI</h4>
                                    <div class="btn badge-primary mb-2" style="width: 100%; text-align: left; border-radius: 10px;">Service Level WO 
                                        <span style="float: right;">
                                            <span class="badge btn-light" style="font-weight: bold;">95,2 %</span>
                                        </span>
                                    </div><br>

                                    <div class="btn badge-info mb-2" style="width: 100%; text-align: left; border-radius: 10px;">One Day Service (ODS)
                                        <span style="float: right;">
                                            <span class="badge btn-light" style="font-weight: bold;">81,7 %</span>
                                        </span>
                                    </div><br>
                                    <div class="btn badge-info mb-2" style="width: 100%; text-align: left; border-radius: 10px;">Treshold Saldo Tiket
                                        <span style="float: right;">
                                            <span class="badge btn-light" style="font-weight: bold;">20 %</span>
                                        </span>
                                    </div><br>
                                    <div class="btn badge-info mb-2" style="width: 100%; text-align: left; border-radius: 10px;">Quality Of Handling (Lapul)
                                        <span style="float: right;">
                                            <span class="badge btn-light" style="font-weight: bold;">10 %</span>
                                        </span>
                                    </div><br>
                                    <div class="btn badge-info mb-2" style="width: 100%; text-align: left; border-radius: 10px;">Quality Of Service
                                        <span style="float: right;">
                                            <span class="badge btn-light" style="font-weight: bold;">10 %</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <h4 class="header-title" style="font-weight: bold; font-size: 10px; text-align: center;">Target</h4>
                                        </div>
                                        <div class="col-4">
                                            <h4 class="header-title" style="font-weight: bold; font-size: 10px; text-align: center;">Bobot</h4>
                                        </div>
                                        <div class="col-4">
                                            <h4 class="header-title" style="font-weight: bold; font-size: 10px; text-align: center;">Realisasi</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                        </div>
                                        <div class="col-4">
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                        </div>
                                        <div class="col-4">
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                            <div class="btn badge-light mb-2" style="width: 100%; text-align: center; font-weight: bold;">10 %
                                            </div><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                </div>
                                <div class="col-2">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="my-3">Start Date</h5>
                                            <input type="text" class="form-control" placeholder="Select Start Date" id="mdate">
                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="my-3">End Date</h5>
                                            <input type="text" class="form-control" placeholder="Select End Date" id="mdate2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1">
                                </div>
                            </div>
                            <div class="table-responsive" style="padding-top: 20px;">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Deskripsi</th>
                                            <th>Reguler</th>
                                            <th>Non Numbering</th>
                                            <th>Permintaan</th>
                                            <th>Konten Add On</th>
                                            <th>Elite C4</th>
                                            <th>All</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Total WO C4</td>
                                            <td>10.000</td>
                                            <td>10.000</td>
                                            <td>10.000</td>
                                            <td>10.000</td>
                                            <td>10.000</td>
                                            <td>50.000</td>
                                        </tr>
                                        <tr>
                                            <td>Total Consume C4</td>
                                            <td>9.900</td>
                                            <td>9.900</td>
                                            <td>9.900</td>
                                            <td>9.900</td>
                                            <td>9.900</td>
                                            <td>49.500</td>
                                        </tr>
                                        <tr>
                                            <td>Closed Intervensi C4</td>
                                            <td>8.000</td>
                                            <td>8.000</td>
                                            <td>8.000</td>
                                            <td>8.000</td>
                                            <td>8.000</td>
                                            <td>40.000</td>
                                        </tr>
                                        <tr>
                                            <td>Closed ODS C4</td>
                                            <td>7.500</td>
                                            <td>7.500</td>
                                            <td>7.500</td>
                                            <td>7.500</td>
                                            <td>7.500</td>
                                            <td>37.500</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-2 mb-4" style="font-weight: bold; font-size: 20px; text-align: center;">Daily KPI Performance</h4>
                            <div class="row">
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="chart-demo" style="height: 200px;">
                                                <div id="slwo" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="chart-demo" style="height: 200px;">
                                                <div id="ods" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="chart-demo" style="height: 200px;">
                                                <div id="tst" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="chart-demo" style="height: 200px;">
                                                <div id="qoh" class="apex-charts"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@stop

@section('footerScript')
        <script src="{{ URL::asset('plugins/moment/moment.js')}}"></script>
        <script src="{{ URL::asset('plugins/apexcharts/irregular-data-series.js')}}"></script>
        <script src="{{ URL::asset('plugins/apexcharts/ohlc.js')}}"></script>
        <script src="{{ URL::asset('assets/pages/jquery.apexcharts.init.js')}}"></script>

        <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{ URL::asset('plugins/select2/select2.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{ URL::asset('assets/pages/jquery.forms-advanced.js')}}"></script>
@stop