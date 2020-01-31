
@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header">
                            {{-- {!! Form::open(['action' => 'InventoryController@return', 'method' => 'POST']) !!} --}}
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="mb-0">Report Lost/Damaged</h1>
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
                        {{-- {!! Form::open(['action' => ['DeployInventoryController@update', $event[0]->event_id], 'method' => 'POST']) !!} --}}
                        {!! Form::open(['action' => ['MarkLostDamagedController@store'], 'method' => 'POST']) !!}
                        
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title">Are you sure you want to continue?</h1>
                                    </div>
                                    <div class="modal-body">
                                        <p>Please check all necessary details before you continue.</p>
                                    </div>
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
                                        <div class="col-md-3 mb-3">
                                            <div class="row">
                                                <div class="col-md-12 mb-7">
                                            {{-- @foreach ($event as $i) --}}
                                                {{-- @if($i->status > 0) --}}
                                                    <input type="hidden" name="event_id" id="event_id" value="{{ $event->event_id }}">
                                                    <label> Event Name </label>
                                                    <h1>{{ $event->event_name }}</h1>
                                                    <input type="hidden" class="form-control" value="{{ $event->event_name }}" name="event_name" id="event_name"></form>
                                                    <label> Venue </label> 
                                                    <h1>{{ $event->venue }}</h1>
                                                    <input type="hidden" class="form-control" value="{{ $event->venue }}" name="qty" id="qty"></form>
                                                    <label> Date of Event </label>
                                                    <h1>{{ Carbon\Carbon::parse($event->event_start)->format('F j, Y      g:i a') }}</h1> 
                                                    <input type="hidden" class="form-control" value="{{ $event->event_start }}" name="event_start" id="qty"></form>
                                                    <label> Package </label>
                                                    <h1>{{ $event->package_name }}</h1>
                                                    <input type="hidden" class="form-control" value="{{ $event->package_name }}" name="package_name" id="package_name"></form>
                                                {{-- @endif --}}
                                            {{-- @endforeach --}}
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                        <label> Assigned Personel In-charge: </label>
                                                        <h1>{{ $employee->employee_fn. ' ' .$employee->employee_ln. ' ('. $employee->contact_no.')' }}</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                        {{-- <table class="table table-bordered align-items-center table-flush mb-4 responsive" id="myTable">
                            <thead class="thead-light">
                                <tr>
                                    <th >Dish Name</th>
                                    <th>Food Image</th>
                                    <th>Unit Cost (per piece)</th>
                                    <th >Unit Expense (per piece)</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dishes as $i)
                                <tr>
                                    <td><a href="{{ url('fooditem/'.$i->item_id) }}" class="dropdown-item"> {{ $i->item_name }}</a>
                                    </td>  
                                    <td><img class="card-img-top" src="{{asset($i->item_image)}}"  style="width:150px;height:100px;" alt="{{$i->item_name}}"></td>  
                                    <td>{{$i->unit_cost}}</td>
                                    <td>{{$i->unit_expense}}</td>
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
                                                <a href="{{ url('fooditem/'.$i->item_id) }}" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('View Item Details') }}</span>
                                                <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('delete-form-{{ $i->item_id }}').submit();">
                                                    <i class="ni ni-fat-remove"></i>
                                                    <span>{{ __('Remove from Food Records') }}</span>
                                                    {!! Form::open(['action' => ['FoodItemController@destroy', $i->item_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->item_id]) !!}
                                                        {{ Form::hidden('_method','DELETE')}}
                                                    {!! Form::close() !!}

                                                   
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th>Category</th>
                                                    <th>Color</th>
                                                    <th>Barcode</th>
                                                    <th>Quantity Reported</th>
                                                    <th>Status</th>
                                                    <th>Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <tr>
                                                    <td>Ikea Chair</td>
                                                    <td>Chair</td>
                                                    <td>White</td>
                                                    <td> {!! QrCode::size(200)->generate("Item-Name: Ikea Chair, Item-Category: Chair, Color: White, Quantity: 55, Event-Name: Jeremy's Birthday Bash"); !!}</td>
                                                    <td>55 Piece(s)</td>
                                                </tr> --}}
                                                @foreach ($lostDamaged as $i)
                                                <tr>
                                                    <input type="hidden" name="item_id{{ $i->inventory_id}}" id="item_id" value="{{ $i->inventory_id}}">
                                                    <td> {{ $i->inventory_name }}</td>
                                                <input type="hidden" class="form-control" value="{{ $i->inventory_name }}" name="inventory_name{{$i->inventory_id}}" id="inventory_name"></form>
                                                    <td> {{ $i->category_name}} </td>
                                                    <td> {{ $i->color_name}} </td>
                                                    <td> 
                                                        {!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->barcode, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!}
                                                        <br>{{$i->barcode}}
                                                    </td>
                                                    
                                                    <input type="hidden" class="form-control" value=" {{$i->barcode}}" name="barcode" id="barcode"></form>
                                                    <td> {{ $i->qty }}</td>
                                                    <input type="hidden" class="form-control" value="{{ $i->qty }}" name="qty" id="qty"></form> 
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                {{-- <input type="hidden" id="barcode" value="{{ $i->barcode }}">
                                                                <input type="hidden" class="invID" name="invIDs[]" value="{{ $i->inventory_id }}" id="inventory-{{ $i->inventory_id }}"> --}}
                                                                <select name="status-{{ $i->inventory_id }}" id="status" class="form-control statusLD" required>
                                                                    <option selected disabled>- Please Select Status -</option>
                                                                    <option value = 1>Lost</option>
                                                                    <option value = 2>Damaged</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <font color="red">*</font>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                <textarea name="reason-{{ $i->inventory_id }}" id="reason" cols="30" rows="10" placeholder="Please Input Reason for Loss/Damage" required>
                                                                </textarea>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <font color="red">*</font>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Report</button>
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


@push('js')

    <script>
        // $('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');

        function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            document.location.reload(true);
            
            // var restorepage = document.body.innerHTML;
            // var printcontent = document.getElementById().innerHTML;
            // document.body.innerHTML = printcontent;
            // window.print();
            // document.body.innerHTML = restorepage;
        }
	</script>
	<script>
		$( document ).ready(function() {
			// var barcode = document.getElementById('barcodeInput').value;
			// document.getElementById('status').onchange = function checkBarcode(){
            document.getElementsByClassName('statusLD').onchange = function checkReason(){

				var barcode = document.getElementById('barcodeInput').value;
				
				var barcodeId = "qtyReturn"+barcode+"";
				var lostbarcodeId = "qtyLostDam"+barcode+""; 
				var qtyId = "qty"+barcode+"";
				var rowId = "row"+barcode+"";

				if (document.getElementById(barcodeId).value != null){
					if(parseInt(document.getElementById(barcodeId).value) < parseInt(document.getElementById(qtyId).value)){
						document.getElementById(barcodeId).value = parseInt(document.getElementById(barcodeId).value) + 1;
						document.getElementById(lostbarcodeId).value = parseInt(document.getElementById(lostbarcodeId).value) - 1;
					} else if (parseInt(document.getElementById(barcodeId).value) == parseInt(document.getElementById(qtyId).value)){
						document.getElementById(rowId).className = 'success';
					}
					barcode = document.getElementById('barcodeInput').value = "";
				}

				var quantities = document.getElementsByClassName( 'qtyReturn' ),
					qtys  = [].map.call(quantities, function( input ) {
						return input.value;
					}).join();

				var inventoryIDs = document.getElementsByClassName( 'invID' ),
					ids  = [].map.call(inventoryIDs, function( input ) {
						return input.value;
					}).join();

				// var lostIDs = document.getElementsByClassName('lostID'),
				// 	losts = [].

				document.getElementById('qtyReturnArray').value = qtys;
				document.getElementById('idReturnArray').value = ids;

				var qty = document.getElementById('qtyReturnArray').value;
				var id = document.getElementById('idReturnArray').value;

			}


		});

		function checkLoD(){

		}
	</script>
@endpush