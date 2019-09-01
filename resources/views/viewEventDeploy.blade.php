
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
                                            <h1 class="mb-0">Deploy Inventory</h1>
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
                        {!! Form::open(['action' => ['DeployInventoryController@update', $event[0]->event_id], 'method' => 'POST']) !!}
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                              
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <div class="row">
                                          <div >
                                              <h2 class="modal-title">Are you sure you want to continue?</h4>
                                          </div>
                                      
                                      </div>
                                      
                                    </div>
                                    {{-- <div class="modal-body">
                                      <p>Some text in the modal.</p>
                                    </div> --}}
                                    <div class="modal-footer">
                                      {{ Form::submit('Confirm Changes', ['class' => 'btn btn-success']) }}
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
                                                    <th scope="col">Package</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($event as $i)
                                                @if($i->status > 0)
                                                <tr>
                                                    <td>{{ $i->event_name }}</td>
                                                    <td>{{ $i->venue }}</td>
                                                    <td>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a') }}</td>
                                                    <td>{{ Carbon\Carbon::parse($i->event_end)->format('F j, Y g:i a') }}</td>
                                                    <td>{{ $i->package_name }} </td>
                                                    
                                                </tr>
                                                
                                                @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    {{-- <th>Event ID</th> --}}
                                                    <th>Item Name</th>
                                                    <th>Barcode</th>
                                                    <th>Quantity</th>
                                                    
                                                    {{-- <th>Description</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($package as $i)
    
                                               
                                                
                                                <tr>
                                                    {{-- <td> {{ $i->id}}</td> --}}
                                                    <td> {{ $i->inventory_name }}</td>
                                                    <td> {!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->sku, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!}</td>
                                                    {{-- <td> {{ $i->rental_cost }}</td> --}}
                                                    <td> - </td>
                                                {{-- <td> {{ $i->description }}</td> --}}
                                                </tr>
                                                {{-- @endif --}}
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    {{-- <th>Event ID</th> --}}
                                                    <th>Food Name</th>
                                                    {{-- <th>Price</th> --}}
                                                    <th>Quantity</th>
                                                    
                                                    {{-- <th>Description</th> --}}
                                                    {{-- <th>Total Cost</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($packageA as $i)
    
                                               
                                                
                                                <tr>
                                                    {{-- <td> {{ $i->id}}</td> --}}
                                                    <td> {{ $i->item_name }}</td>
                                                    {{-- <td> {!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->sku, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!}</td> --}}
                                                    {{-- <td> {{ $i->unit_cost }}</td> --}}
                                                    <td> {{ $i->quantity }}</td>
                                                    {{-- <td> {{ ($i->unit_cost) * ($i->quantity) }}</td> --}}
                                                {{-- <td> {{ $i->description }}</td> --}}
                                                </tr>
                                                {{-- @endif --}}
                                                @endforeach
                                            </tbody>
                                        </table>
                                </div>

                                
                                </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Deploy</button>
                                    <a href="{{ url('inventory')}}" class="btn btn-default">Back</a>
                                    {{-- {{Form::hidden('_method', 'PUT')}} --}}
                            </div>
                        </div>
                        {{Form::hidden('_method', 'PUT')}}
		{!! Form::close() !!}
		</div>
		</div>
	</div>
</div>
@endsection