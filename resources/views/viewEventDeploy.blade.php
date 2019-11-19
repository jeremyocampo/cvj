
@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-10 mb-5 mb-xl-0">
                {{-- <div class="row"> alternate lang para tight --}}
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
                        {{-- {!! Form::open(['action' => ['DeployInventoryController@update', $event[0]->event_id], 'method' => 'POST']) !!} --}}
                        {!! Form::open(['action' => ['DeployInventoryController@store'], 'method' => 'POST']) !!}
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                              
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <div class="row">
                                          <div >
                                              <h2 class="modal-title">Are you sure you want to continue?</h2>

                                          </div>
                                      
                                      </div>
                                      
                                    </div>
                                    {{-- <div class="modal-body">
                                      <p>Some text in the modal.</p>
                                    </div> --}}
                                    <div class="modal-footer">
                                      {{ Form::submit('Deploy Items', ['class' => 'btn btn-success']) }}
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>
                              
                                </div>
                              </div>
						<div class="card-body">
                                <div class="table-responsive mb-3">
                                    <!-- Projects table -->
                                    <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-5 mb-5">
                                            <div class="row">
                                                <div class="col-md-12 mb-7">
                                            @foreach ($event as $i)
                                                @if($i->status > 0)
                                                    <input type="hidden" name="event_id" id="event_id" value="{{ $i->event_id }}">
                                                    <label> Event Name </label><input class="form-control" type="text" disabled value="{{ $i->event_name }}">
                                                    <input type="hidden" class="form-control" value="{{ $i->event_name }}" name="event_name" id="event_name"></form>
                                                    <label> Venue </label> <input class="form-control" type="text" disabled value="{{ $i->venue }}">
                                                    <input type="hidden" class="form-control" value="{{ $i->venue }}" name="qty" id="qty"></form>
                                                    <label> Date </label> <input class="form-control" type="text" disabled value="{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y      g:i a') }}"> 
                                                    <input type="hidden" class="form-control" value="{{ $i->event_start }}" name="event_start" id="qty"></form>
                                                    <label> Package </label><input class="form-control" type="text" disabled value="{{ $i->package_name }}"> 
                                                    <input type="hidden" class="form-control" value="{{ $i->package_name }}" name="package_name" id="package_name"></form>
                                                @endif
                                            @endforeach
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                Assigned Personel In-charge: 
                                                <select class="form-control" name="employeeAssigned" required>
                                                    <option disabled selected > -Please Assign an Employee- </option>
                                                    @foreach($employees as $a)
                                                        <option value="{{ $a->employee_id}}"> {{$a->employee_FN}} {{$a->employee_LN}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th>Category</th>
                                                    <th>Color</th>
                                                    <th>Barcode</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                    <td>Ikea Chair</td>
                                                    <td>Chair</td>
                                                    <td>White</td>
                                                    <td> {!! QrCode::size(200)->generate("Item-Name: Ikea Chair, Item-Category: Chair, Color: White, Quantity: 55, Event-Name: Jeremy's Birthday Bash"); !!}</td>
                                                    <td>55 Piece(s)</td>
                                                </tr>
                                                <tr>
                                                    <td>Ikea Table</td>
                                                    <td>Table</td>
                                                    <td>White</td>
                                                    <td> {!! QrCode::size(200)->generate("Item-Name: Ikea Table, Item-Category: Table, Color: White, Quantity: 8, Event-Name: Jeremy's Birthday Bash"); !!}</td>
                                                    <td>8 Piece(s)</td>
                                                </tr>
                                                <tr>
                                                    <td>Table Cloth</td>
                                                    <td>Linen</td>
                                                    <td>Gray</td>
                                                    <td> {!! QrCode::size(200)->generate("Item-Name: Table Cloth, Item-Category: Linen, Color: Gray, Quantity: 8, Event-Name: Jeremy's Birthday Bash"); !!}</td>
                                                    <td>8 Piece(s)</td>
                                                </tr> --}}
                                                @foreach ($package as $i)
                                                <tr>
                                                    <input type="hidden" name="item_id{{ $i->inventory_id}}" id="item_id" value="{{ $i->inventory_id}}">
                                                    <td> {{ $i->inventory_name }}</td>
                                                <input type="hidden" class="form-control" value="{{ $i->inventory_name }}" name="inventory_name{{$i->inventory_id}}" id="inventory_name"></form>
                                                    <td> {{ $i->category_name}} </td>
                                                    <td> {{ $i->color_name}} </td>
                                                    <td> {!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->sku, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!}</td>
                                                    <input type="hidden" class="form-control" value=" {{$i->sku}}" name="barcode" id="barcode"></form>
                                                    <td> {{ $i->qty }}</td>
                                                    <input type="hidden" class="form-control" value="{{ $i->qty }}" name="qty" id="qty"></form> 
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                    
                                    </div>
                                </div>
                                        {{-- <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Food Name</th>
                                                    <th>Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody> --}}
                                                {{-- @foreach ($packageA as $i)
                                                <tr>
                                                    <td> {{ $i->item_name }}</td>
                                                    <td> {{ $i->quantity }}</td>
                                                </tr>
                                                @endforeach --}}
                                            {{-- </tbody>
                                        </table> --}}
                                </div>

                                
                                </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Deploy</button>
                                    <a href="{{ url('deploy')}}" class="btn btn-default">Back</a>
                            </div>
                        </div>
                        {{-- {{Form::hidden('_method', 'PUT')}} --}}
		{!! Form::close() !!}
		</div>
        </div>
        
	</div>
</div>
@endsection