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
                                    <h4 class="mt-0 header-title">Form Input Traffic</h4>
                                    <form action = "/create" method = "POST">
                                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                        <div class="form-row">
                                            
                                            <div class="col-md-2">
                                                <label for="validationTooltip01">Date</label>
                                                @if(Auth::user()->role == "admin")
                                                    <input type="text" name="date" class="form-control" value="{{$today}}" id="date-input" required>
                                                @else
                                                    <input type="text" name="date" class="form-control" value="{{$today}}" id="date-input" readonly required>
                                                @endif
                                            </div>
                                           
                                            <div class="col-md-2">
                                                <label>Channel</label>
                                                <select class="select2 form-control custom-select select2-hidden-accessible" name="channel" tabindex="-1" aria-hidden="true" required>
                                                    <option value="">Pilih Channel</option>
                                                        <option value="myih">My Indihome</option>
                                                        <option value="sosmed">Sosmed</option>
                                                        <option value="plasa">Plasa</option>
                                                        <option value="147">147</option>
                                                       
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="validationTooltip01">Trafik Komplain</label>
                                                <input type="text" name="komplain" class="form-control" id="validationTooltip01" required>
                                            </div>
                                            @if(Auth::user()->role == "admin")
                                                <div class="col-md-2" style="padding-top: 5px;">
                                                    <button class="btn btn-gradient-primary mt-4" type="submit">Submit</button>
                                                    {{-- <button class="btn btn-gradient-primary mt-4" type="submit">Update</button> --}}
                                                </div>
                                            @else
                                                <div class="col-md-2" style="padding-top: 5px;">
                                                    <button class="btn btn-gradient-primary mt-4" id="simpan" type="submit">Submit</button>
                                                </div>
                                            @endif
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

                            <div class="row ">
                                <div class="col-lg-12">
                                    <div class="row justify-content-end">
                                        <form action ="{{ route('index') }}" method="GET">
                                        <div class="form-group row mr-5">
                                            <div class="col-sm-10">
                                                <input class="form-control" type="month" name="date" value="{{$dates}}">
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-gradient-primary " type="submit">Submit</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                    <!-- <div class="table-responsive"> id="datatable-buttons" -->
                                        <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr style="background-color: #F0F8FF; vertical-align: middle; font-weight: bold; text-align: center; font-size: 12px;">
                                                    <th style="font-weight: bold;">Tanggal</th>
                                                    <th style="font-weight: bold;">147</th>
                                                    <th style="font-weight: bold;">SOSMED</th>
                                                    <th style="font-weight: bold;">PLASA</th>
                                                    <th style="font-weight: bold;">My IndiHome</th>
                                                    <th style="font-weight: bold;">All Channel</th>
                                                    {{-- @foreach($users as $u)
                                                    <th>{{ $u->yearmonth}}</th>
                                                    @endforeach --}}
                                            </thead>
                                            <tbody style="background-color: #FFFFFF; color: #000000; font-size: 12px; border-style: solid; border-color: #C0C0C0; border-width: 1px;">
                                                @foreach($data as $d)
                                                <tr>
                                                    <td><a href=""> {{ $d->yearmonth }}</a></td> 
                                                    <td>{{ number_format($d->komplain_147) }}</td>
                                                    <td>{{ number_format($d->sosmed_komplain) }}</td>
                                                    <td>{{ number_format($d->plasa_komplain) }}</td>
                                                    <td>{{ number_format($d->myih_komplain) }}</td>
                                                    <td>{{ number_format($d->total) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot style="background-color: #F0F8FF; vertical-align: middle; font-weight: bold; text-align: center; font-size: 12px;">
                                                <td>Total </td>
                                                @foreach($datasum as $ds)
                                                <td>{{ number_format($ds->komplain_147) }}</td>
                                                <td>{{ number_format($ds->sos_komplain) }}</td>
                                                <td>{{ number_format($ds->plasa_komplain) }}</td>
                                                <td>{{ number_format($ds->myih_komplain) }}</td>
                                                <td>{{ number_format($ds->all_channel) }}</td>
                                                
                                                @endforeach
                                            </tfoot>
                                        </table>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ URL::asset('assets/js/jquery-3.5.1.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.validate.min.js')}}"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script> --}}
        <script>
                $(function() {
                    // var date = new Date();
                    
                    $('#simpan').click(function(e) {
                        if($('select').val()==''){
                            alert('Please, choose an option');
                            return false;
                        }
                    })

                });


        </script>

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