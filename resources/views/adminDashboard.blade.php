<link href="/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="col-md-12">
                        <h1 class="display-2 text-white">Welcome back Admin!</h1>
                        <p class="text-white mt-0 mb-5">You can see your details below</p>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h2 class="card-title text-uppercase mb-0">
                                            <a href="{{ url('users') }}">New users this week</a>
                                        </h2>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle">
                                            <i class="ni ni-single-02"></i>
                                        </div>     
                                    </div>  
                                    <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th >Client name</th>
                                                    {{-- <th >Stock Keeping Unit(SKU)</th> --}}
                                                    <th >Date Added</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php  
                
                                                ?>
                                                @foreach ($users as $i)
                                                @if($i->status > 0)
                                                <tr>
                                                    
                                                    <td>
                                                        <a href="{{ url('users/'.$i->id) }}" class="dropdown-item">
                                                            {{ $i->name }}
                                                        </a>
                                                    </td>    
                                                    <td>{{ $i->created_at }}</td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h2 class="card-title text-uppercase mb-0">Upcoming events</h2>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle">
                                            <i class="ni ni-book-bookmark"></i>
                                        </div>     
                                    </div>  
                                    <table class="table  table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">event name</th>
                                                <th scope="col">event date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Thesis Celebration</th>
                                                <th scope="row">8/02/2019</th>
                                            </tr>
                                            <tr>
                                                <th scope="row">Birthday ni Baby</th>
                                                <th scope="row">9/13/2019</th>
                                            </tr>
                                            <tr>
                                                <th scope="row">Hatdugan with Aljur</th>
                                                <th scope="row">10/03/2019</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h2 class="card-title text-uppercase mb-0">critical inventory</h2>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>     
                                    </div>  
                                    <table class="table  table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">item name</th>
                                                <th scope="col">threshold</th>
                                                <th scope="col">quantity</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">chicken</th>
                                                <th scope="row">10</th>
                                                <th scope="row"> 5</th>
                                            </tr>
                                            <tr>
                                                <th scope="row">beef</th>
                                                <th scope="row">12</th>
                                                <th scope="row">7</th>
                                            </tr>
                                            <tr>
                                                <th scope="row">pork</th>
                                                <th scope="row">8</th>
                                                <th scope="row">4</th>
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
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="text-uppercase mb-0">overview of events</h2>
                        </div>
                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-primary">See all</a>
                        </div>
                    </div>
                </div>
                    <div class="table-responsive">
                    <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Event name</th>
                                    <th scope="col">client name</th>
                                    <th scope="col">date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Bday ni Michael</th>
                                    <th scope="row">Princess Velasquez</th>
                                    <th scope="row">6/20/2019</th>
                                    <th scope="row">COMPLETED</th>

                                </tr>
                                <tr>
                                    <th scope="row">Bye Rosette</th>
                                    <th scope="row">Albert Pops</th>
                                    <th scope="row">8/2/2019</th>
                                    <th scope="row">IN PROGRESS</th>
                                </tr>
                                <tr>
                                    <th scope="row">Good bye Philippines</th>
                                    <th scope="row">Jotaro Kujo</th>
                                    <th scope="row">8/29/2019</th>
                                    <th scope="row">PENDING</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>            
                </div>
        </div>
    </div>
                
        
       

        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush