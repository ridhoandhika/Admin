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
                                <div class="col-lg-12">
                                    <div class="chart-demo">
                                        <div id="complain_rate_mtd" class="apex-charts"></div>
                                    </div><!--end card-->
                                </div> 
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                                <tr style="background-color: #F0F8FF; vertical-align: middle; font-weight: bold; text-align: center; font-size: 12px;">
                                                    <th style="font-weight: bold;">PARAMETER</th>
                                                    <th>1</th>
                                                    <th>2</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>5</th>
                                                    <th>6</th>
                                                    <th>7</th>
                                                    <th>8</th>
                                                    <th>9</th>
                                                    <th>10</th>
                                                    <th>11</th>
                                                    <th>12</th>
                                                    <th>13</th>
                                                    <th>14</th>
                                                    <th>15</th>
                                                    <th>16</th>
                                                    <th>17</th>
                                                    <th>18</th>
                                                    <th>19</th>
                                                    <th>20</th>
                                                    <th>21</th>
                                                    <th>22</th>
                                                    <th>23</th>
                                                    <th>24</th>
                                                    <th>25</th>
                                                    <th>26</th>
                                                    <th>27</th>
                                                    <th>28</th>
                                                    <th>29</th>
                                                    <th>30</th>
                                                    <th>31</th>
                                                </tr>
                                            </thead>
                                            <tbody style="background-color: #FFFFFF; color: #000000; font-size: 9px; border-style: solid; border-color: #C0C0C0; border-width: 1px;">
                                                <tr style="background-color: #FFFFFF; color: #2d343d; border-style: solid; border-color: #C0C0C0; border-width: 1px;">
                                                    <td style="font-size: 10px; font-weight: bold;">Registrasi</td>
                                                    <td>586974</td>
                                                    <td>656328</td>
                                                    <td>502734</td>
                                                    <td>596927</td>
                                                    <td>434928</td>
                                                    <td>430844</td>
                                                    <td>272268</td>
                                                    <td>212925</td>
                                                    <td>309545</td>
                                                    <td>327746</td>
                                                    <td>358697</td>
                                                    <td>230519</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr style="background-color: #FFFFFF; color: #2d343d; border-style: solid; border-color: #C0C0C0; border-width: 1px;">
                                                    <td style="font-size: 10px; font-weight: bold;">Informasi</td>
                                                    <td>1013893</td>
                                                    <td>987945</td>
                                                    <td>1143843</td>
                                                    <td>1212201</td>
                                                    <td>1181527</td>
                                                    <td>1341630</td>
                                                    <td>1418303</td>
                                                    <td>1296065</td>
                                                    <td>1418298</td>
                                                    <td>1723847</td>
                                                    <td>1508457</td>
                                                    <td>1650259</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr style="background-color: #FFFFFF; color: #2d343d; border-style: solid; border-color: #C0C0C0; border-width: 1px;">
                                                    <td style="font-size: 10px; font-weight: bold;">Complain</td>
                                                    <td>1565263</td>
                                                    <td>1569481</td>
                                                    <td>1597126</td>
                                                    <td>1576605</td>
                                                    <td>1316809</td>
                                                    <td>1410038</td>
                                                    <td>1275643</td>
                                                    <td>1042097</td>
                                                    <td>1147443</td>
                                                    <td>1325531</td>
                                                    <td>1458103</td>
                                                    <td>1542220</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr style="background-color: #FFFFFF; color: #2d343d; border-style: solid; border-color: #C0C0C0; border-width: 1px;">
                                                    <td style="font-size: 10px; font-weight: bold;">All Traffic</td>
                                                    <td>3166130</td>
                                                    <td>3213754</td>
                                                    <td>3243703</td>
                                                    <td>3385733</td>
                                                    <td>2933264</td>
                                                    <td>3182512</td>
                                                    <td>2966214</td>
                                                    <td>2551087</td>
                                                    <td>2875286</td>
                                                    <td>3377124</td>
                                                    <td>3325257</td>
                                                    <td>3422998</td>
                                                    <td>0</td>
                                                </tr>
                                                <tr style="background-color: #F0F8FF; color: #FF0000; border-style: solid; border-color: #C0C0C0; border-width: 1px; font-weight: bold; font-size: 12px;">
                                                    <td style="font-size: 10px; font-weight: bold;">Complain Rate</td>
                                                    <td>49%</td>
                                                    <td>49%</td>
                                                    <td>49%</td>
                                                    <td>47%</td>
                                                    <td>45%</td>
                                                    <td>44%</td>
                                                    <td>43%</td>
                                                    <td>41%</td>
                                                    <td>40%</td>
                                                    <td>39%</td>
                                                    <td>44%</td>
                                                    <td>45%</td>
                                                    <td>0%</td>
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