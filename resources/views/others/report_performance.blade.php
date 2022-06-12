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
<link href="{{ URL::asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('content')
        <div class="container-fluid">
            <div class="card mt-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <select name="teamleader" class="form-control">
                                <option value="">Select Team Leader</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" placeholder="Select Start Date" id="mdate">
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control" placeholder="Select End Date" id="mdate2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title mt-0">Data Table</h4> 
                                    <div class="table-responsive dash-social">
                                        <table id="datatable" class="table table-bordered">
                                            <thead class="thead-light" style="text-align: center;">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Perner Id</th>
                                                    <th>Agent Name</th>                                                    
                                                    <th>Consume</th>
                                                    <th>Closed</th>
                                                    <th>On Progress</th>
                                                    <th>AHT</th>
                                                    <th>% Productivity</th>
                                                    <th>Start Online</th>
                                                    <th>Total AUX</th>
                                                    <th>Logout</th>
                                                    <th>Staff Time</th>
                                                </tr>
                                            </thead>
        
                                            <tbody>
                                                <tr>
                                                    <td>123</td>
                                                    <td>Ayu</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>08:00:00</td>
                                                    <td>01:15:00</td>
                                                    <td>17:00:00</td>
                                                    <td>07:45:00</td>
                                                </tr>
                                                <tr>
                                                    <td>456</td>
                                                    <td>Widia</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>0</td>
                                                    <td>07:58:43</td>
                                                    <td>01:29:00</td>
                                                    <td>17:58:00</td>
                                                    <td>08:31:00</td>
                                                </tr>
                                            </tbody>
                                        </table>                    
                                    </div>                                         
                                </div><!--end card-body--> 
                            </div><!--end card--> 
                        </div> <!--end col-->                               
                    </div>
                </div>
            </div>
        </div>

@stop

@section('footerScript')

        <script src="{{ URL::asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{ URL::asset('plugins/select2/select2.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')}}"></script>
        <script src="{{ URL::asset('assets/pages/jquery.forms-advanced.js')}}"></script>

        <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
@stop