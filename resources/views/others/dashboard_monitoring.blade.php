@extends('layouts.master')

@section('title', 'KPI C4')

@section('headerStyle')
        <!-- Plugins css -->
<link href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" />
<link href="{{ URL::asset('plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('plugins/timepicker/bootstrap-material-datetimepicker.css')}}" rel="stylesheet">
<link href="{{ URL::asset('plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet" />

<link href="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="{{ URL::asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" /> 
        <link href="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet">
@stop

@section('content')
        <div class="container-fluid">
            <div class="row" style="padding-top: 10px;">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-9">
                            <div class="card" style="background-color: #F8F8FF;">
                                <div class="card-body">
                                    <h4 class="header-title" style="font-weight: bold; font-size: 20px;">Staff Monitoring</h4>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col-8">
                                                            <p class="text-dark font-weight-semibold font-14">Agent Staff</p>
                                                            <h3 class="my-3">99</h3>
                                                        </div>
                                                        <div class="col-4 align-self-center">
                                                            <div class="report-main-icon bg-light-alt">
                                                                <i data-feather="user" class="align-self-center icon-dual-pink icon-lg"></i>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col-8">
                                                            <p class="text-dark font-weight-semibold font-14">Online</p>
                                                            <h3 class="my-3">90</h3>
                                                        </div>
                                                        <div class="col-4 align-self-center">
                                                            <div class="report-main-icon bg-light-alt">
                                                                <i data-feather="phone-call" class="align-self-center icon-dual-pink icon-lg"></i>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col-8">
                                                            <p class="text-dark font-weight-semibold font-14">Toilet</p>
                                                            <h3 class="my-3">5</h3>
                                                        </div>
                                                        <div class="col-4 align-self-center">
                                                            <div class="report-main-icon bg-light-alt">
                                                                <i data-feather="users" class="align-self-center icon-dual-pink icon-lg"></i>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col-8">
                                                            <p class="text-dark font-weight-semibold font-14">Brief</p>
                                                            <h3 class="my-3">0</h3>
                                                        </div>
                                                        <div class="col-4 align-self-center">
                                                            <div class="report-main-icon bg-light-alt">
                                                                <i data-feather="briefcase" class="align-self-center icon-dual-pink icon-lg"></i>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col-8">
                                                            <p class="text-dark font-weight-semibold font-14">Break</p>
                                                            <h3 class="my-3">3</h3>
                                                        </div>
                                                        <div class="col-4 align-self-center">
                                                            <div class="report-main-icon bg-light-alt">
                                                                <i data-feather="coffee" class="align-self-center icon-dual-pink icon-lg"></i>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row d-flex justify-content-center">
                                                        <div class="col-8">
                                                            <p class="text-dark font-weight-semibold font-14">Sholat</p>
                                                            <h3 class="my-3">1</h3>
                                                        </div>
                                                        <div class="col-4 align-self-center">
                                                            <div class="report-main-icon bg-light-alt">
                                                                <i data-feather="users" class="align-self-center icon-dual-pink icon-lg"></i>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h4 class="header-title mt-0">Realtime Staff</h4> 
                                                    <div class="table-responsive dash-social">
                                                        <table id="datatable" class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>Nama Agent</th>
                                                                    <th>Status</th>
                                                                    <th>Total Aux</th>                                                    
                                                                    <th>Consume</th>
                                                                    <th>Close</th>
                                                                    <th>On Progress</th>
                                                                    <th>AHT</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Ayu Puspitasari</td>
                                                                    <td><h4 class="badge btn-success">Online</h4></td>
                                                                    <td>00:13:00</td>
                                                                    <td>100</td>
                                                                    <td>80</td>
                                                                    <td>20</td>
                                                                    <td>15 Menit</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Riani Imran</td>
                                                                    <td><h4 class="badge btn-danger">Break</h4></td>
                                                                    <td>00:12:13</td>
                                                                    <td>100</td>
                                                                    <td>80</td>
                                                                    <td>20</td>
                                                                    <td>15 Menit</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nella Kharisma</td>
                                                                    <td><h4 class="badge btn-warning">Toilet</h4></td>
                                                                    <td>00:10:13</td>
                                                                    <td>100</td>
                                                                    <td>80</td>
                                                                    <td>20</td>
                                                                    <td>15 Menit</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="row">
                                <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <label>Top 3 Agent</label>
                                                <span style="float: right;"><i data-feather="thumbs-up" class="icon-dual-primary"></i></span>
                                                <table class="table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>% Produktifitas</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align: center;">
                                                        <tr>
                                                            <td>Apriyana</td>
                                                            <td>69%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nosta</td>
                                                            <td>70%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Wira</td>
                                                            <td>72%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" style="width: 100%;">
                                    <div class="card-body">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <label>Bottom 3 Agent</label>
                                                <span style="float: right;"><i data-feather="thumbs-down" class="icon-dual-primary"></i></span>
                                                <table class="table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th>% Produktifitas</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align: center;">
                                                        <tr>
                                                            <td>Ahmad</td>
                                                            <td>99%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nidzom</td>
                                                            <td>99%</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hilmi</td>
                                                            <td>98%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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

        <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script src="{{ URL::asset('assets/pages/jquery.analytics_report.init.js')}}"></script>
@stop