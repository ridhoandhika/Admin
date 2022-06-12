
        <!-- Top Bar Start -->
        <div class="topbar">           
            <!-- Navbar -->
            <nav class="navbar-custom">    
                <ul class="list-unstyled topbar-nav float-right mb-0">
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light nav-user mr-2" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            {{-- <img src="{{ URL::asset('assets/images/icon-telkom.png')}}" alt="profile-user" class="rounded-circle" />  --}}
                            <span class="ml-1 nav-user-name hidden-sm">{{ Auth::user()->name}} </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('logout') }}"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                        </div>
                    </li>
                </ul><!--end topbar-nav-->
    
                <ul class="list-unstyled topbar-nav mb-0">  
                    <li>
                        <a href="/crm/crm-index">
                            <span class="responsive-logo">
                                <img src="{{ URL::asset('assets/images/logo-sm.png')}}" alt="logo-small" class="logo-sm align-self-center" height="34">
                            </span>
                        </a>                        
                    </li>                      
                    <li class="mt-4">
                        <button class="button-menu-mobile nav-link">
                            <i data-feather="menu" class="align-self-center"></i>
                        </button>
                    </li>
                </ul>
            </nav>
            <!-- end navbar-->
        </div>
        <!-- Top Bar End -->
