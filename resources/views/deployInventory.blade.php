
@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header">
                            {{-- {!! Form::open(['action' => 'InventoryController@return', 'method' => 'POST']) !!} --}}
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="mb-0">Deploy Inventory</h1>
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            {{-- <div class="custom-control custom-checkbox">
                                                <label class="form-label">Status</label> <label class="text-muted">(optional)</label>
                                                <select class="form-control" name="status" id="status">
    x                                                <option selected disabled value=0>Please Select a status</option>
                                                    <option value="1">Mark as Lost</option>
                                                    <option value="2">Mark as Damaged</option>
                                                </select>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @if(session()->has('success'))
                                        <br>
                                        <div class="alert alert-success" role="alert">
                                            <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                            {{ session()->get('success') }}<br>
                                        </div>
                                    @endif
                                    @if(session()->has('deleted'))
                                        <br>
                                        <div class="alert alert-danger" role="alert">
                                            <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                            {{ session()->get('deleted') }}<br>
                                        </div>
                                    @endif
                                </div>
                            </div>
						</div>
						<div class="card-body">
                                <div class="table-responsive mb-3">
                                    <!-- Projects table -->
                                    <h1>Undeployed Events Happening today</h1>
                                    <table class="table ">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Event Name</th>
                                                    <th scope="col">Venue</th>
                                                    <th scope="col">Event Date/Time</th>
                                                    {{-- <th scope="col">Return Date/Time</th> --}}
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                    <td>Jeremy's Birthday Bash</td>
                                                    <td>CVJ Catering Ground Floor</td>
                                                    <td>March 25, 2020</td>
                                                    <td>March 25, 2020</td>
                                                    <td>
                                                        <a href="{{ url('deploy/1') }}" class="btn btn-sm">
                                                            <i class="ni ni-zoom-split-in"></i>
                                                            <span>{{ __('View Event Details') }}</span>
                                                        </a>
                                                    </td>
                                                </tr> --}}
                                                @foreach ($events as $i)
                                                @if($i->status > 0)
                                                <tr>
                                                    <td>{{ $i->event_name }}</td>
                                                    <td>{{ $i->venue }}</td>
                                                    <td>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a') }}</td>
                                                    {{-- <td>{{ Carbon\Carbon::parse($i->event_end)->format('F j, Y g:i a') }}</td> --}}
                                                    <td>
                                                        <a class="" href="{{ url('deploy/'.$i->event_id) }}" >
                                                            <button class="btn btn-block btn-sm">Deploy Inventory</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                </div>

                                <div class="table-responsive mb-3">
                                    <!-- Projects table -->
                                    <h1>Deployed Events</h1>
                                    <table class="table mb-3">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Event Name</th>
                                                    <th scope="col">Venue</th>
                                                    <th scope="col">Event Date/Time</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                    <td>Jeremy's Birthday Bash</td>
                                                    <td>CVJ Catering Ground Floor</td>
                                                    <td>March 25, 2020</td>
                                                    <td>March 25, 2020</td>
                                                    <td>
                                                        <a href="{{ url('deploy/1') }}" class="btn btn-sm">
                                                            <i class="ni ni-zoom-split-in"></i>
                                                            <span>{{ __('View Event Details') }}</span>
                                                        </a>
                                                    </td>
                                                </tr> --}}
                                                @foreach ($eventsDep as $i)
                                                @if($i->status > 0)
                                                <tr>
                                                    <td>{{ $i->event_name }}</td>
                                                    <td>{{ $i->venue }}</td>
                                                    <td>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a') }}</td>
                                                    {{-- <td>{{}}</td> --}}
                                                    <td>
                                                        Deployed
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
                                    {{-- <a href="{{ url('deploy')}}" class="btn btn-success">Deploy</a> --}}
                                    {{-- <a href="{{ url('inventory')}}" class="btn btn-default">Back</a> --}}
                                    {{-- {{Form::hidden('_method', 'PUT')}} --}}
                            </div>
                        </div>
		</div>
        </div>

        

	</div>
</div>
@endsection