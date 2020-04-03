@extends('layouts.app')

@section('content')
    @include('layouts.headers.inventoryCard1')

    <div class="container-fluid mt--7 mb-10">

        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Events</h5>
                                <span class="h2 font-weight-bold mb-0">{{ number_format($totalEvents) }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Manpower</h5>
                                <span class="h2 font-weight-bold mb-0">{{ number_format($manpower) }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                    <i class="fas fa-chart-pie"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Total Expenses</h5>
                                <span class="h2 font-weight-bold mb-0">{{ number_format($expenses) }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Inventory</h5>
                                <span class="h2 font-weight-bold mb-0">{{ number_format($totalInventory) }}</span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                    <i class="fas fa-percent"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">

                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-8">

            </div>
            {{-- <div class="col-md-4 float-right">
                <form action="/" method="GET" class="form-inline" role="form">
                    <div class="form-group mr-3">
                        <label class="text-black-50">Filter Selection</label>
                        <select class="form-control" name="filter">
                            <option value="monthly">Monthly</option>
                            <option value="weekly">Weekly</option>
                            <option value="daily">Daily</option>
                        </select>
                    </div> <br /><br />
                    <button class="btn btn-default">Filter</button>
                </form>
            </div> --}}
        </div>
        <div class="row mt-4">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Peak Event Report</h2>
                                
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item">
                                        <div class="col-md-4 float-right">
                                            <form action="/" method="GET" class="form-inline" role="form">
                                                <div class="form-group mr-3">
                                                    <label class="text-white-50">Filter Selection</label>
                                                    <select class="form-control" name="filter">
                                                        <option value="monthly">Monthly</option>
                                                        <option value="weekly">Weekly</option>
                                                        <option value="daily">Daily</option>
                                                    </select>
                                                </div>
                                                <button class="btn btn-default">Filter</button>
                                            </form>
                                        </div>
                                    </li>
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            @if(request()->has('filter') && request()->get('filter') == 'monthly')
                                                <span class="d-none d-md-block">Month</span>
                                                <span class="d-md-none">M</span>
                                            @elseif(request()->has('filter') && request()->get('filter') == 'weekly')
                                                <span class="d-none d-md-block">Weekly</span>
                                                <span class="d-md-none">W</span>
                                            @elseif(request()->has('filter') && request()->get('filter') == 'daily')
                                                <span class="d-none d-md-block">Daily</span>
                                                <span class="d-md-none">D</span>
                                            @endif
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            {!! $events->container() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Management</h6>
                                <h2 class="mb-0">Inventory Report</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            {!!  $inventory->container() !!}
{{--                            <canvas id="chart-orders" class="chart-canvas"></canvas>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 mb-10 ">
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Frequently Lost/Damaged Inventory</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush" id="freqLos">
                            <thead class="thead-light">
                                <tr>
                                    {{-- <th scope="col">Event</th> --}}
                                    <th scope="col">Inventory</th>
                                    <th scope="col">Quantity</th>
                                    {{-- <th scope="col">Date Reported</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($lostInventory as $row)
                                {{-- @if($row->event || $row->inventory) --}}
                                <tr>
                                    {{-- <th scope="row">
                                        {{ $row->event->event_name }}
                                    </th> --}}
                                    <td>
                                        {{ $row->inventory_name }}
                                    </td>
                                    <td>
                                        {{ $row->qty }}
                                    </td>
                                    {{-- <td>
                                        {{ $row->date_reported }}
                                    </td> --}}
                                </tr>
                                {{-- @endif --}}
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-5 mb-xl-0">
                <div class="card shadow mb-7">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Frequently Deployed Inventory</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush" id="freqDep">
                            <thead class="thead-light">
                                <tr>
                                    {{-- <th scope="col">Event</th> --}}
                                    <th scope="col">Inventory</th>
                                    <th scope="col">Quantity</th>
                                    {{-- <th scope="col">Date Reported</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($deployed as $row1)
                                {{-- @if($row1->event && $row1->inventory) --}}
                                {{-- @if($row1->inventory) --}}
                                <tr>
                                    {{-- <td scope="row">
                                        {{ $row1->event->event_name }}
                                    </td> --}}
                                    <td>{{ $row1->inventory_name }}</td>
                                    <td>
                                        {{ $row1->qty }}
                                    </td>
                                    {{-- <td>
                                        {{ $row1->date_reported }}
                                    </td> --}}
                                </tr>
                                {{-- @endif --}}
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
@endsection



@push('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
{{-- DATA TABLES START --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

<link rel="stylesheet" type="text/css" href=". /resources/DataTables/datatables.min.css"/>
<script type="text/javascript" src=". /resources/DataTables/datatables.min.js"></script>
{{-- DATA TABLES END --}}

<script>
    $(document).ready(function() {
        $('#freqDep').DataTable({
            "order": [[1, "desc"]]
        });
        $('#freqLos').DataTable({
            "order": [[1, "desc"]]
        });
    } );
</script>

    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    {!! $events->script() !!}
    {!! $inventory->script() !!}
@endpush
