@extends('layouts.eventApp')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
        </div>
        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Events Happening Now</h3>
                            </div>
                            <div class="col text-right">
                            <a href="{{--url("events")--}}" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Event Name</th>
                                    <th scope="col">Venue</th>
                                    <th scope="col">Borrow Date/Time</th>
                                    <th scope="col">Return Date/Time</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $i)
                                @if($i->status > 0)
                                <tr>
                                    <td>{{ $i->event_name }}</td>
                                    <td>{{ $i->venue }}</td>
                                    <td>{{ $i->event_start }}</td>
                                    <td>{{ $i->event_end }}</td>
                                    <td>{{ $i->status}} </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                <div class=" dropdown-header noti-title">
                                                    <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('inventory/'.$i->event_name) }}" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('View Event Details') }}</span>
                                                </a>

                                                <a href="{{ url('inventory/'.$i->event_name.'/edit')}}" class="dropdown-item">
                                                    <i class="ni ni-fat-add"></i>
                                                    <span>{{ __('Replenish Item') }}</span>
                                                </a>
                                                
                                                <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('delete-form-{{ $i->event_name }}').submit();">
                                                    <i class="ni ni-fat-remove"></i>
                                                    <span>{{ __('Remove from Inventory') }}</span>
                                                    {!! Form::open(['action' => ['InventoryController@destroy', $i->event_name], 'method' => 'POST', 'id' => 'delete-form-'.$i->inventory_id]) !!}
                                                        {{ Form::hidden('_method','DELETE')}}
                                                    {!! Form::close() !!}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Critical Items</h3>
                            </div>
                            <div class="col text-right">
                            <a href="{{url("inventory")}}" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Threshold</th>
                                    <th scope="col">Quantity in Stock</th>
                                    <th scope="col">Price per Item</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criticalInventory as $b)
                                @if($b->status > 0)
                                <tr>
                                    <td scope="col">{{ $b->inventory_name }}</td>
                                    <td scope="col">{{ $b->threshold }}</td>
                                    <td scope="col">{{ $b->quantity }}</td>
                                    <td scope="col">{{ $b->price }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                <div class=" dropdown-header noti-title">
                                                    <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('inventory/'.$b->inventory_id) }}" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('View Event Details') }}</span>
                                                </a>

                                                <a href="{{ url('inventory/'.$b->inventory_id.'/edit')}}" class="dropdown-item">
                                                    <i class="ni ni-fat-add"></i>
                                                    <span>{{ __('Replenish Item') }}</span>
                                                </a>
                                                
                                                <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('delete-form-{{ $b->inventory_id }}').submit();">
                                                    <i class="ni ni-fat-remove"></i>
                                                    <span>{{ __('Remove from Inventory') }}</span>
                                                    {!! Form::open(['action' => ['InventoryController@destroy', $b->inventory_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->inventory_id]) !!}
                                                        {{ Form::hidden('_method','DELETE')}}
                                                    {!! Form::close() !!}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                @endif
                                @endforeach
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