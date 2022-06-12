@extends('layouts.authLayout')
@section('headerStyle')
        <link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content')
  <!-- Log In page -->
        <div class="container">
            <div class="row vh-100 ">
                <div class="col-12 align-self-center">
                    <div class="auth-page">
                        <div class="card auth-card shadow-lg">
                            <div class="card-body">
                                <div class="px-3">
                                    <div class="auth-logo-box">
                                        <a href="{{ URL::asset('dashboard/analytics-index')}}" class="logo logo-admin"><img src="{{ URL::asset('assets/images/logo-sm.png')}}" height="55" alt="logo" class="auth-logo"></a>
                                    </div><!--end auth-logo-box-->
                                    
                                    <div class="text-center auth-logo-text">
                                        <h4 class="mt-0 mb-3 mt-5">Let's Get Started Metrica</h4>
                                        <p class="text-muted mb-0">Sign in to continue to Metrica.</p>  
                                    </div> <!--end auth-logo-text-->  
                                    <form action = "{{ route('login')}}" method = "POST">
                                       
                                    {{-- <form class="form-horizontal auth-form my-4" action="{{ route('login')}}" method="POST">   --}}
                                        {{-- <input type = "hidden" name = "_token" value = "">       --}}
                                        @csrf
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <div class="input-group mb-3">
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-user"></i> 
                                                </span>                                                                                                              
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                                            </div>                                    
                                        </div><!--end form-group--> 
            
                                        <div class="form-group">
                                            <label for="userpassword">Password</label>                                            
                                            <div class="input-group mb-3"> 
                                                <span class="auth-form-icon">
                                                    <i class="dripicons-lock"></i> 
                                                </span>                                                       
                                                <input type="password" class="form-control" name="password"  id="userpassword" placeholder="Enter password">
                                            </div>                               
                                        </div><!--end form-group--> 
                                         @if(session('message'))
                                            <div class="alert alert-danger border-0" role="alert">
                                            <strong>{{ session('message') }} </strong> Change a few things up and try submitting again.
                                            </div>
                                        @endif 
                                        
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                            </div><!--end col--> 
                                        </div> <!--end form-group-->                           
                                    </form><!--end form-->
                                </div><!--end /div-->
                            </div><!--end card-body-->
                        </div><!--end card-->
                    </div><!--end auth-page-->
                </div><!--end col-->           
            </div><!--end row-->
        </div><!--end container-->
@endsection

@section('footerScript')
        <script type="text/javascript">
            //  $( document ).ready() block.
            $(document).ready(function() {
                document.body.classList.add('bg-card');
            });
        </script>
@stop

