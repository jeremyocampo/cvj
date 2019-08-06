
@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-8 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header">
                            {{-- {!! Form::open(['action' => 'InventoryController@return', 'method' => 'POST']) !!} --}}
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="mb-0">Return Inventory</h1>
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            {{-- <div class="custom-control custom-checkbox">
                                                <label class="form-label">Status</label> <label class="text-muted">(optional)</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option selected disabled value=0>Please Select a status</option>
                                                    <option value="1">Mark as Lost</option>
                                                    <option value="2">Mark as Damaged</option>
                                                </select>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="card-body">
                                <div class="table-responsive mb-3">
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
                                                    <td>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a') }}</td>
                                                    <td>{{ Carbon\Carbon::parse($i->event_end)->format('F j, Y g:i a') }}</td>
                                                    <td>{{ $i->status_name}} </td>
                                                    <td>
                                                        <a class="" href="{{ url('returnInventory/'.$i->event_id) }}" >
                                                            
                                                            <button class="btn btn-block btn-sm"><i class="ni ni-zoom-split-in"></i> &nbsp; View Event Details</button>
                                                            {{-- <span>{{ __('View Event Details') }}</span> --}}
                                                        </a>
                                                        {{-- <div class="dropdown">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                Action
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                                <div class=" dropdown-header noti-title">
                                                                    <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                                </div>
                                                                <div class="dropdown-divider"></div>
                                                                <a href="{{ url('returnInventory/'.$i->event_id) }}" class="dropdown-item">
                                                                    <i class="ni ni-zoom-split-in"></i>
                                                                    <span>{{ __('View Event Details') }}</span>
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
                                                        </div> --}}
                                                    </td>
                                                </tr>
                                                
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>

                                
                                </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                    <a href="{{ url('inventory')}}" class="btn btn-default">Back</a>
                                    {{-- {{Form::hidden('_method', 'PUT')}} --}}
                            </div>
                        </div>
		{!! Form::close() !!}
		</div>
		</div>
	</div>
</div>
@endsection