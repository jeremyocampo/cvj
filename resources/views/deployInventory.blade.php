
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
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $i)
                                        @if($i->status <= 3)
                                        <tr>
                                            <td>{{ $i->event_name }}</td>
                                            <td>{{ $i->venue }}</td>
                                            <td>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a') }}</td>
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
                                        @foreach ($eventsDep as $i)
                                        @if($i->status <= 4)
                                        <tr>
                                            <td>{{ $i->event_name }}</td>
                                            <td>{{ $i->venue }}</td>
                                            <td>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a') }}</td>
                                            <td>{{ $i->status_name}}</td>
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