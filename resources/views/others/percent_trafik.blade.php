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
                                    <h4 class="mt-0 header-title">Form ALL Ticket</h4>
                                    <form action = "{{ route('percent.create')}}" method = "POST">
                                        <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
                                        <div class="form-row">
                                            <div class="col-md-2">
                                                <label for="validationTooltip01">Date</label>
                                                @if(Auth::user()->role == 'admin') 
                                                    <input type="text" name="date" class="form-control" value="{{$today}}" id="validationTooltip01" required>
                                                @else
                                                    <input type="text" name="date" class="form-control" value="{{$today}}" id="validationTooltip01" readonly required>
                                                @endif
                                            </div>
                                            <div class="col-md-1">
                                                <label for="validationTooltip01">TR1</label>
                                                <input type="number" id="mask" name="tr1" class="form-control" id="validationTooltip01" required>
                                            </div>
                                            <div class="col-md-1">
                                                <label for="validationTooltip01">TR2</label>
                                                <input type="number" id="mask1"  name="tr2" class="form-control" id="validationTooltip01" required>
                                            </div>
                                            <div class="col-md-1">
                                                <label for="validationTooltip01">TR3</label>
                                                <input type="number" id="mask2"  name="tr3" class="form-control" id="validationTooltip01" required>
                                            </div>
                                            <div class="col-md-1">
                                                <label for="validationTooltip01">TR4</label>
                                                <input type="number" id="mask3"  name="tr4" class="form-control" id="validationTooltip01" required>
                                            </div>
                                            <div class="col-md-1">
                                                <label for="validationTooltip01">TR5</label>
                                                <input type="number" id="mask4" name="tr5" class="form-control" id="validationTooltip01" required>
                                            </div>
                                            <div class="col-md-1">
                                                <label for="validationTooltip01">TR6</label>
                                                <input type="number" id="mask5" name="tr6" class="form-control" id="validationTooltip01" required>
                                            </div>
                                            <div class="col-md-1">
                                                <label for="validationTooltip01">TR7</label>
                                                <input type="number" id="mask6"  name="tr7" class="form-control" id="validationTooltip01" required>
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
                                    @if (Session::has('message'))
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true"><i class="mdi mdi-close"></i></span>
                                            </button>
                                            <strong>{{ Session::get('message') }}</strong> 
                                        </div>
                                    @endif
                                    <div class="row justify-content-end">
                                    <form action ="{{ route('percent.index') }}" method="GET">
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
                                    {{-- id="datatable-buttons" --}}
                                        <table  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr style="background-color: #F0F8FF; vertical-align: middle; font-weight: bold; text-align: center; font-size: 12px;">
                                                    <th style="font-weight: bold;">PARAMETER</th>
                                                    <th style="font-weight: bold;">T-Reg 1</th>
                                                    <th style="font-weight: bold;">T-Reg 2</th>
                                                    <th style="font-weight: bold;">T-Reg 3</th>
                                                    <th style="font-weight: bold;">T-Reg 4</th>
                                                    <th style="font-weight: bold;">T-Reg 5</th>
                                                    <th style="font-weight: bold;">T-Reg 6</th>
                                                    <th style="font-weight: bold;">T-Reg 7</th>
                                                    <th style="font-weight: bold;">Nasional</th>
                                            </thead>
                                            <tbody style="background-color: #FFFFFF; color: #000000; font-size: 12px; border-style: solid; border-color: #C0C0C0; border-width: 1px;">
                                                
                                                @foreach($users as $u)
                                                <tr>
                                                    <td>{{ $u->yearmonth}}</td>
                                                    <td>{{ number_format($u->tr1) }}</td>
                                                    <td>{{ number_format($u->tr2) }}</td>
                                                    <td>{{ number_format($u->tr3) }}</td>
                                                    <td>{{ number_format($u->tr4) }}</td>
                                                    <td>{{ number_format($u->tr5) }}</td>
                                                    <td>{{ number_format($u->tr6) }}</td>
                                                    <td>{{ number_format($u->tr7) }}</td>
                                                    <td>{{ number_format($u->nasional) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot style="background-color: #F0F8FF; vertical-align: middle; font-weight: bold; text-align: center; font-size: 12px;">
                                            <th>Nasional</th>
                                                @foreach($datasum as $ds)
                                                {{-- <tr> --}}
                                                    <th>{{ $ds->tr1}}</th>
                                                    <th>{{ $ds->tr2}}</th>
                                                    <th>{{ $ds->tr3}}</th>
                                                    <th>{{ $ds->tr4}}</th>
                                                    <th>{{ $ds->tr5}}</th>
                                                    <th>{{ $ds->tr6}}</th>
                                                    <th>{{ $ds->tr7}}</th>
                                                    <td>{{ $ds->total_nasional}}</td>
                                                    
                                                {{-- </tr> --}}
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
        <script>
            $(function() {
                $("input#mask").each((i,ele)=>{
                    let clone=$(ele).clone(false)
                    clone.attr("type","text")
                    let ele1=$(ele)
                    clone.val(Number(ele1.val()).toLocaleString("en"))
                    $(ele).after(clone)
                    $(ele).hide()
                    clone.mouseenter(()=>{

                        ele1.show()
                        clone.hide()
                    })
                    setInterval(()=>{
                        let newv=Number(ele1.val()).toLocaleString("en")
                        if(clone.val()!=newv){
                            clone.val(newv)
                        }
                    },10)

                    $(ele).mouseleave(()=>{
                        $(clone).show()
                        $(ele1).hide()
                    })
                })
                $("input#mask1").each((i,ele)=>{
                    let clone=$(ele).clone(false)
                    clone.attr("type","text")
                    let ele1=$(ele)
                    clone.val(Number(ele1.val()).toLocaleString("en"))
                    $(ele).after(clone)
                    $(ele).hide()
                    clone.mouseenter(()=>{

                        ele1.show()
                        clone.hide()
                    })
                    setInterval(()=>{
                        let newv=Number(ele1.val()).toLocaleString("en")
                        if(clone.val()!=newv){
                            clone.val(newv)
                        }
                    },10)

                    $(ele).mouseleave(()=>{
                        $(clone).show()
                        $(ele1).hide()
                    })
                })
                $("input#mask2").each((i,ele)=>{
                    let clone=$(ele).clone(false)
                    clone.attr("type","text")
                    let ele1=$(ele)
                    clone.val(Number(ele1.val()).toLocaleString("en"))
                    $(ele).after(clone)
                    $(ele).hide()
                    clone.mouseenter(()=>{

                        ele1.show()
                        clone.hide()
                    })
                    setInterval(()=>{
                        let newv=Number(ele1.val()).toLocaleString("en")
                        if(clone.val()!=newv){
                            clone.val(newv)
                        }
                    },10)

                    $(ele).mouseleave(()=>{
                        $(clone).show()
                        $(ele1).hide()
                    })
                })
                $("input#mask3").each((i,ele)=>{
                    let clone=$(ele).clone(false)
                    clone.attr("type","text")
                    let ele1=$(ele)
                    clone.val(Number(ele1.val()).toLocaleString("en"))
                    $(ele).after(clone)
                    $(ele).hide()
                    clone.mouseenter(()=>{

                        ele1.show()
                        clone.hide()
                    })
                    setInterval(()=>{
                        let newv=Number(ele1.val()).toLocaleString("en")
                        if(clone.val()!=newv){
                            clone.val(newv)
                        }
                    },10)

                    $(ele).mouseleave(()=>{
                        $(clone).show()
                        $(ele1).hide()
                    })
                })
                $("input#mask4").each((i,ele)=>{
                    let clone=$(ele).clone(false)
                    clone.attr("type","text")
                    let ele1=$(ele)
                    clone.val(Number(ele1.val()).toLocaleString("en"))
                    $(ele).after(clone)
                    $(ele).hide()
                    clone.mouseenter(()=>{

                        ele1.show()
                        clone.hide()
                    })
                    setInterval(()=>{
                        let newv=Number(ele1.val()).toLocaleString("en")
                        if(clone.val()!=newv){
                            clone.val(newv)
                        }
                    },10)

                    $(ele).mouseleave(()=>{
                        $(clone).show()
                        $(ele1).hide()
                    })
                })
                $("input#mask5").each((i,ele)=>{
                    let clone=$(ele).clone(false)
                    clone.attr("type","text")
                    let ele1=$(ele)
                    clone.val(Number(ele1.val()).toLocaleString("en"))
                    $(ele).after(clone)
                    $(ele).hide()
                    clone.mouseenter(()=>{

                        ele1.show()
                        clone.hide()
                    })
                    setInterval(()=>{
                        let newv=Number(ele1.val()).toLocaleString("en")
                        if(clone.val()!=newv){
                            clone.val(newv)
                        }
                    },10)

                    $(ele).mouseleave(()=>{
                        $(clone).show()
                        $(ele1).hide()
                    })
                })
            });

        </script>
@stop

@section('footerScript')
    {{-- <script src="{{ URL::asset('assets/pages/jquery.forms-advanced.js')}}"></script> --}}
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