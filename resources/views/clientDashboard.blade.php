<link href="/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
@extends('layouts.app')



@section('content')



<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="col-md-12 {{ $class ?? '' }}">
                        <h1 class="display-2 text-white">Hi {{ auth()->user()->name }} !</h1>
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
                                    
                                    @foreach ($events as $i)
                                    <tr>
                                        <td>{{ $i->event_name}}</td>
                                            @if(($i->status > 0) )
                                                <td class="text-center">
                                                    <div class="icon icon-shape bg-success text-white rounded-circle">
                                                        <i class="ni ni-check-bold"></i>
                                                    </div>
                                                    Event booking request has been sent and is <br> being reviewed by the event manager
                                                </td>
                                            @endif
                                            @if(($i->status > 0) && ($i->status < 3))
                                                <td class="text-center">
                                                    <div class="icon icon-shape bg-success text-white rounded-circle">
                                                        <i class="ni ni-check-bold"></i>
                                                    </div>
                                                    Event booking request has been <br> approved
                                                </td>
                                            @endif
                                            @if(($i->status > 0) && ($i->status < 4))
                                                <td class="text-center">
                                                    {{-- <div class="icon icon-shape bg-danger text-white rounded-circle" >
                                                        <i class="fas fa-times"></i>
                                                    </div>   --}}
                                                    <div class="icon icon-shape bg-success text-white rounded-circle">
                                                        <i class="ni ni-check-bold"></i>
                                                    </div>
                                                    You have confirmed your booking <br> request
                                                </td>
                                            @endif
                                            @if(($i->status > 0) && ($i->status < 5))
                                            <td class="text-center">
                                                    <div class="icon icon-shape bg-success text-white rounded-circle">
                                                        <i class="ni ni-check-bold"></i>
                                                    </div>
                                                Event is now in progress
                                            </td>
                                            @endif
                                            @if(($i->status > 0) && ($i->status < 6))
                                            <td class="text-center">
                                                    <div class="icon icon-shape bg-success text-white rounded-circle">
                                                        <i class="ni ni-check-bold"></i>
                                                    </div>
                                                Event finished
                                            </td>
                                            @endif
                                    </tr>
                                @endforeach
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


{{-- <tbody>
        
        @foreach ($joinedInventory as $i)
        @if($i->status > 0)
        <tr>
            
            <td>
                <a href="{{ url('inventory/'.$i->inventory_id) }}" class="dropdown-item">
                    {{ $i->inventory_name }}
                </a>
            </td>    
            <td>{{ $i->category_name }}</td>
            <td>{{ $i->color_name }}</td>
            <td> {{ $i->size }}</td>
            <td>{{ $i->quantity }}</td>
            <td>{{ $i->threshold }}</td>
            <td>{{ $i->barcode }}</td>
           
            <td>{{ $i->last_modified }}</td>
            <td class="popup">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('inventory/'.$i->inventory_id) }}" class="dropdown-item">
                            <i class="ni ni-zoom-split-in"></i>
                            <span>{{ __('View Item Details') }}</span>
                        </a>

                        <a href="{{ url('inventory/'.$i->inventory_id.'/edit')}}" class="dropdown-item">
                            <i class="ni ni-fat-add"></i>
                            <span>{{ __('Replenish Item') }}</span>
                        </a>
                        
                        <a href="" class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('delete-form-{{ $i->inventory_id }}').submit();">
                            <i class="ni ni-fat-remove"></i>
                            <span>{{ __('Remove from Inventory') }}</span>
                            {!! Form::open(['action' => ['InventoryController@destroy', $i->inventory_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->inventory_id]) !!}
                                {{ Form::hidden('_method','DELETE')}}
                            {!! Form::close() !!}
                        </a>
                    </div>
                </div>
                <a class="btn btn-sm btn-primary" href="inventory/{{ $i->itemId }}/edit"> Replenish Item </a> mahaba 
            </td>
        </tr>
        @endif
        @endforeach
    </tbody> --}}