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
                    <div class="col-xl-6 col-lg-6">
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
                    <div class="col-xl-6 col-lg-6">
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
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="mb-0 ">List of Events</h1>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                        <div class="table-active">
                        <!-- Projects table -->
                            <table class="table table-light align-items-center table-flush ">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" width="30%">Event name</th>
                                        <th scope="col" width="14%"></th>
                                        <th scope="col" width="14%"></th>
                                        <th scope="col" width="14%" class="text-center">Status</th>
                                        <th scope="col" width="14%"></th>
                                        <th scope="col" width="14%"></th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th><h2>Lanz Celebration</h2></th>
                                        <th class="text-center"> 
                                            <div class="icon icon-shape bg-success text-white rounded-circle">
                                                <i class="ni ni-check-bold"></i>
                                            </div>      
                                            <div class="icon icon-shape bg-danger text-white rounded-circle" hidden>
                                                <i class="fas fa-times"></i>
                                            </div>                         
                                        </th>
                                        <th class="text-center"> 
                                            <div class="icon icon-shape bg-success text-white rounded-circle shadow" hidden>
                                                <i class="ni ni-check-bold"></i>
                                            </div>                      
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow" >
                                                <i class="fas fa-times"></i>
                                            </div>              
                                        </th>
                                        <th class="text-center"> 
                                            <div class="icon icon-shape bg-success text-white rounded-circle" hidden>
                                                <i class="ni ni-check-bold"></i>
                                            </div>  
                                            <div class="icon icon-shape bg-danger text-white rounded-circle">
                                                <i class="fas fa-times"></i>
                                            </div>                           
                                        </th>
                                        <th class="text-center"> 
                                            <div class="icon icon-shape bg-success text-white rounded-circle" hidden >
                                                <i class="ni ni-check-bold"></i>
                                            </div> 
                                            <div class="icon icon-shape bg-danger text-white rounded-circle" >
                                                <i class="fas fa-times"></i>
                                            </div>                         
                                        </th>
                                        <th class="text-center"> 
                                            <div class="icon icon-shape bg-success text-white rounded-circle" hidden >
                                                <i class="ni ni-check-bold"></i>
                                            </div> 
                                            <div class="icon icon-shape bg-danger text-white rounded-circle" >
                                                <i class="fas fa-times"></i>
                                            </div>                              
                                        </th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Event booking request has been sent and is <br> being reviewed by the event manager</th>
                                        <th class="text-center">Event booking request has been <br> approved</th>
                                        <th class="text-center">You have confirmed your booking <br> request</th>
                                        <th class="text-center">Event is now in progress</th>
                                        <th class="text-center">Event finished</th>
                                    </tr>
                                    <tr>
                                        <th><h2>Debut ni Rose</h2></th>
                                        <th class="text-center"> 
                                                <div class="icon icon-shape bg-success text-white rounded-circle">
                                                    <i class="ni ni-check-bold"></i>
                                                </div>      
                                                <div class="icon icon-shape bg-danger text-white rounded-circle" hidden>
                                                    <i class="fas fa-times"></i>
                                                </div>                         
                                            </th>
                                            <th class="text-center"> 
                                                <div class="icon icon-shape bg-success text-white rounded-circle shadow" >
                                                    <i class="ni ni-check-bold"></i>
                                                </div>                      
                                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow" hidden>
                                                    <i class="fas fa-times"></i>
                                                </div>              
                                            </th>
                                            <th class="text-center"> 
                                                <div class="icon icon-shape bg-success text-white rounded-circle" >
                                                    <i class="ni ni-check-bold"></i>
                                                </div>  
                                                <div class="icon icon-shape bg-danger text-white rounded-circle" hidden>
                                                    <i class="fas fa-times"></i>
                                                </div>                           
                                            </th>
                                            <th class="text-center"> 
                                                <div class="icon icon-shape bg-success text-white rounded-circle" hidden >
                                                    <i class="ni ni-check-bold"></i>
                                                </div> 
                                                <div class="icon icon-shape bg-danger text-white rounded-circle" >
                                                    <i class="fas fa-times"></i>
                                                </div>                         
                                            </th>
                                            <th class="text-center"> 
                                                <div class="icon icon-shape bg-success text-white rounded-circle" hidden >
                                                    <i class="ni ni-check-bold"></i>
                                                </div> 
                                                <div class="icon icon-shape bg-danger text-white rounded-circle" >
                                                    <i class="fas fa-times"></i>
                                                </div>                              
                                            </th>
                                    </tr>
                                    <tr>
                                            <th></th>
                                            <th class="text-center">Event booking request has been sent and is <br> being reviewed by the event manager</th>
                                            <th class="text-center">Event booking request has been <br> approved</th>
                                            <th class="text-center">You have confirmed your booking <br> request</th>
                                            <th class="text-center">Event is now in progress</th>
                                            <th class="text-center">Event finished</th>
                                    </tr>
                                    <tr>
                                        <th><h2>Jeremy Despidida</h2></th>
                                        <th class="text-center"> 
                                                <div class="icon icon-shape bg-success text-white rounded-circle">
                                                    <i class="ni ni-check-bold"></i>
                                                </div>      
                                                <div class="icon icon-shape bg-danger text-white rounded-circle" hidden>
                                                    <i class="fas fa-times"></i>
                                                </div>                         
                                            </th>
                                            <th class="text-center"> 
                                                <div class="icon icon-shape bg-success text-white rounded-circle shadow" hidden>
                                                    <i class="ni ni-check-bold"></i>
                                                </div>                      
                                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow" >
                                                    <i class="fas fa-times"></i>
                                                </div>              
                                            </th>
                                            <th class="text-center"> 
                                                <div class="icon icon-shape bg-success text-white rounded-circle" hidden>
                                                    <i class="ni ni-check-bold"></i>
                                                </div>  
                                                <div class="icon icon-shape bg-danger text-white rounded-circle">
                                                    <i class="fas fa-times"></i>
                                                </div>                           
                                            </th>
                                            <th class="text-center"> 
                                                <div class="icon icon-shape bg-success text-white rounded-circle" hidden >
                                                    <i class="ni ni-check-bold"></i>
                                                </div> 
                                                <div class="icon icon-shape bg-danger text-white rounded-circle" >
                                                    <i class="fas fa-times"></i>
                                                </div>                         
                                            </th>
                                            <th class="text-center"> 
                                                <div class="icon icon-shape bg-success text-white rounded-circle" hidden >
                                                    <i class="ni ni-check-bold"></i>
                                                </div> 
                                                <div class="icon icon-shape bg-danger text-white rounded-circle" >
                                                    <i class="fas fa-times"></i>
                                                </div>                              
                                            </th>   
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">Event booking request has been sent and is <br> being reviewed by the event manager</th>
                                        <th class="text-center">Event booking request has been <br> rejected</th>
                                        <th class="text-center">You have confirmed your booking <br> request</th>
                                        <th class="text-center">Event is now in progress</th>
                                        <th class="text-center">Event finished</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                                    
            </div>
        </div>
    </div>
    {{-- <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
            <i class="fas fa-credit-card"></i>
        </div> --}}
        
       
       
        @include('layouts.footers.auth')
    
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush


