@extends('layouts.master')

@section('title', 'KPI C4')

@section('headerStyle')
<link href="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('status') }}
    </div>
    @elseif(session('failed'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ session('failed') }}
    </div>
@endif

        <div class="container-fluid">
            <div class="row" style="padding-top: 10px;">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="mt-0 header-title">Form Input Line in Service</h4>
                                    <form action = "" method = "POST">
                                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                        <div class="form-row">
                                            <div class="col-md-2">
                                                <label for="validationTooltip01">Date</label>
                                                @if(Auth::user()->role == "admin")
                                                    <input type="text" name="month" class="form-control" value="{{$dates}}" id="date-input" required>
                                                @endif
                                                {{-- <input type="date" name="date" class="form-control" value="{{$today}}" id="validationTooltip01"> --}}
                                            </div>
                                            <div class="col-md-1">
                                                <label for="validationTooltip01">Target</label>
                                                <input type="number" name="target" class="form-control" id="validationTooltip01" required>
                                            </div>
                                            <div class="col-md-1" style="padding-top: 5px;">
                                                <button class="btn btn-gradient-primary mt-4" type="submit">Submit</button>
                                            </div>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row justify-content-end">
                                        <form action ="" method="GET">
                                        <div class="form-group row mr-5">
                                        
                                            <div class="col-md-10">
                                                <input class="form-control" type="year" name='date' value="{{$dates}}" id="example-month-input">
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-gradient-primary " type="submit">Submit</button>
                                            </div>
                                        
                                    </div>
                                </form>
                                    </div>
                                    <!-- <div class="table-responsive"> id="datatable-buttons"-->
                                        <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                               
                                                <tr style="background-color: #F0F8FF; vertical-align: middle; font-weight: bold; text-align: center; font-size: 12px;">
                                                    <th style="font-weight: bold;">PARAMETER</th>
                                                    <th style="font-weight: bold;">T-Reg 1</th>
                                            </thead>
                                            <tbody style="background-color: #FFFFFF; color: #000000; font-size: 12px; border-style: solid; border-color: #C0C0C0; border-width: 1px;">
                                                {{-- @foreach($data as $u) --}}
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                {{-- @endforeach --}}
                                               
                                            </tbody>
                                            
                                        </table>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script> --}}
         <script>
                $(function() {

                    });
        </script> -

@stop

@section('footerScript')
    <script src="{{ URL::asset('assets/pages/jquery.forms-advanced.js')}}"></script>
    <script src="{{ URL::asset('plugins/parsleyjs/parsley.min.js')}}"></script>
    <script src="{{ URL::asset('assets/pages/jquery.validation.init.js')}}"></script>
    <script src="../assets/js/jquery.core.js"></script>
    <script src="{{ URL::asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/buttons.colVis.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{ URL::asset('plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ URL::asset('assets/pages/jquery.datatable.init.js')}}"></script> 
@stop