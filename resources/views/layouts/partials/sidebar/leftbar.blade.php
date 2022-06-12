 <!-- leftbar-tab-menu -->
        <div class="leftbar-tab-menu">
            <div class="main-icon-menu">
                <a href="Dashboard" class="logo logo-metrica d-block text-center">  
                    <span>
                        <img src="{{ URL::asset('assets/images/icon-telkom.png')}}" alt="logo-small" class="logo-sm">
                    </span>
                </a>
                <nav class="nav">
                    <a href="#MetricaDashboard" class="nav-link" data-toggle="tooltip-custom" data-placement="right"  data-trigger="hover" title="" data-original-title="Dashboard">
                        <i data-feather="monitor" class="align-self-center menu-icon icon-dual"></i>
                    </a>
                    @if(Auth::user()->role == "admin" ||Auth::user()->role == "user" || Auth::user()->role == "channel")  
                    <a href="#MetricaPages" class="nav-link" data-toggle="tooltip-custom" data-placement="right"  data-trigger="hover" title="" data-original-title="Pages">
                        <i data-feather="copy" class="align-self-center menu-icon icon-dual"></i>             
                    </a>
                    @endif
                </nav><!--end nav-->
            </div><!--end main-icon-menu-->

            <div class="main-menu-inner">
                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="/Dashboard" class="logo logo-metrica d-block text-left" style="padding-top: 15px;">
                        <span>
                            <img src="{{ URL::asset('assets/images/telkom-indonesia.png')}}" width="150" height="50">
                        </span>
                    </a>
                </div>
                <!--end logo-->
                <div class="menu-body slimscroll">     
                       {{-- @if(Auth::user()->role == "admin" ||Auth::user()->role == "user" || Auth::user()->role == "regional" )                --}}
                     <div id="MetricaDashboard" class="main-icon-menu-pane">
                        <div class="title-box">
                            <h6 class="menu-title">Dashboard</h6>       
                        </div>
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link" href="{{ route('dashboard.index') }}">Complain Rate</a></li>
                            {{-- <li class="nav-item"><a class="nav-link" href="{{ route('mtd.index') }}">Traffic MTD</a></li> --}}
                        </ul>
                    </div>
                    {{-- @endif --}}
                    @if(Auth::user()->role != "regional")             
                        <div id="MetricaPages" class="main-icon-menu-pane">
                            <div class="title-box">
                                <h6 class="menu-title">Data Management</h6>       
                            </div>
                            @if(Auth::user()->role == "admin" ||Auth::user()->role == "user" || Auth::user()->role == "channel")             
                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="{{ route('index.channel') }}">Trafik Komplain</a></li>
                            </ul>
                            @endif
                            {{-- <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Trafik Komplain</a></li>
                            </ul> --}}
                            @if(Auth::user()->role == "admin" ||Auth::user()->role == "user" )    
                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="{{ route('percent.index') }}">Tiket ALL</a></li>
                            </ul>
                            <ul class="nav">
                                <li class="nav-item"><a class="nav-link" href="{{ route('line.service') }}">Line in Service</a></li>
                            </ul>
                            @endif
                        </div>
                    @endif
                </div><!--end menu-body-->
            </div><!-- end main-menu-inner-->
        </div>
        <!-- end leftbar-tab-menu-->