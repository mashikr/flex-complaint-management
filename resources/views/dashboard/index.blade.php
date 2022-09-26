@extends('layouts.master')

@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card overflow-hidden">
                        <div class="iq-card-body">
                            <div class="text-center mb-2">
                                <div class="rounded-circle iq-card-icon iq-bg-primary"><i class="ri-user-line"></i></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="text-center">
                                <h2 class="mb-0"><span class="counter">74.5</span><span>K</span></h2>
                                <h6 class="mb-2">Users</h6>
                                <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">10%</span> Increased</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card overflow-hidden">
                        <div class="iq-card-body">
                            <div class="text-center mb-2">
                                <div class="rounded-circle iq-card-icon iq-bg-danger"><i class="ri-search-2-line"></i></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="text-center">
                                <h2 class="mb-0"><span class="counter">95.5</span><span>K</span></h2>
                                <h6 class="mb-2">Sessions</h6>
                                <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">22%</span> Increased</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card overflow-hidden">
                        <div class="iq-card-body">
                            <div class="text-center mb-2">
                                <div class="rounded-circle iq-card-icon iq-bg-success"><i class="ri-drizzle-line"></i></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="text-center">
                                <h2 class="mb-0"><span class="counter">5.2</span><span>K</span></h2>
                                <h6 class="mb-2">Bounce Rate</h6>
                                <p class="mb-0 text-secondary line-height"><i class="ri-arrow-up-line text-success mr-1"></i><span class="text-success">8%</span> Increased</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="iq-card overflow-hidden">
                        <div class="iq-card-body p-0" style="background: url( {{ asset('assets/images/page-img/01.png') }}) no-repeat scroll center center; background-size: contain; min-height: 202px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
