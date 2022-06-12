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
                            <select name="campaign" class="form-control">
                                <option value="">Select Campaign</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <!-- <h4 class="header-title mt-0">Skill Campaign</h4>  -->
                                    <div class="table-responsive dash-social">
                                        <table id="datatable" class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>User</th>
                                                    <th>Nama Agent</th>
                                                    <th>Total WO</th>                                                    
                                                    <th>FU Nonatero</th>
                                                    <th>FU Nossa</th>
                                                    <th>Closed</th>
                                                    <th>On Progress</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>34343</td>
                                                    <td>Adam Idris</td>
                                                    <td>50</td>
                                                    <td>30</td>
                                                    <td>30</td>
                                                    <td>20</td>
                                                    <td>10</td>
                                                </tr>
                                                <tr>
                                                    <td>20102</td>
                                                    <td>Ilyas Ilyasa</td>
                                                    <td>50</td>
                                                    <td>35</td>
                                                    <td>35</td>
                                                    <td>30</td>
                                                    <td>5</td>
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