<div>
      @section('class')

    <div class="bg-primary">

        @endsection

        @section('content')

        <div class="page-single">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-8 col-xs-10 card-sigin-main mx-auto my-auto py-45 justify-content-center">
                        <div class="card-sigin mt-5 mt-md-0">
                            <!-- Demo content-->
                            <div class="main-card-signin d-md-flex">
                                <div class="wd-100p">
                                    <div style="display: block;
                                                margin-left: auto; margin-right: auto;">
                                        <a href="{{url('index')}}">
                                            <img src="{{asset('assets/img/brand/favicon.png')}}" class="sign-favicon ht-40" style="display: block;
                                                margin-left: auto; margin-right: auto;" alt="logo"></a>
                                    </div>
                                    <div class="main-signup-header">
                                        <h2 class=" text-center">Welcome back!</h2>
                                        <h6 class="font-weight-semibold mb-4  text-center">Please sign in to continue.</h6>
                                        <div class="panel panel-primary">


                                            <div class="panel-body tabs-menu-body border-0 p-3">
                                                <livewire:login />


                                                <div class="tab-content">

                                                    <div class="tab-pane active" id="tab5">

                                                        <form action="#">

                                                            <a href="{{ route('login.google') }}" class="btn btn-primary btn-block">Login with Gmail</a>

                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="main-signin-footer text-center mt-3">
                                            <div class="container-fluid pd-t-0-f ht-100p">
                                                Copyright © {{date('Y')}} <a href="javascript:void(0);" class="text-primary">Rasoi Software</a>. All rights reserved
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

        @endsection

        @section('scripts')

        <!-- generate-otp js -->
        <script src="{{asset('assets/js/generate-otp.js')}}"></script>

        @endsection
    </div>