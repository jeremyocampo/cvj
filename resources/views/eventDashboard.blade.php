<link href="/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
@extends('layouts.app')



@section('content')



<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="col-md-12 {{ $class ?? '' }}">
                        <h1 class="display-2 text-white">Hi Earl Medina!</h1>
                        <p class="text-white mt-0 mb-5">You can see your event details below</p>
                </div>
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="card-title text-uppercase text-muted mb-0">Pending Balance</h3>
                                        <span class="h2 font-weight-bold mb-0">120,500 PHP</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h2 font-weight-bold mb-0">23 Days</span>
                                        <h3 class="card-title text-uppercase text-muted mb-0">Before Event (Debut ni Rose)</h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class="h2 font-weight-bold mb-0">23 Days</span>
                                        <h3 class="card-title text-uppercase text-muted mb-0">Before Event (Debut ni Rose)</h3>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-xl-3">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <span class="h2 font-weight-bold mb-0">23 Days</span>
                                                <h3 class="card-title text-uppercase text-muted mb-0">Before Event (Debut ni Rose)</h3>
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                    <i class="fas fa-calendar"></i>
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
    

        
       
       
        @include('layouts.footers.auth')
    
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush


