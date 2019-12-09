@extends('layouts.app')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> --}}
@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
		
				
				{{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
				<div class="col-xl-12 mb-5">
					<div class="card shadow " >
						<div class="card-header ">
							<div class="row align-items-center">
								<div class="col">
									<div class="row">
											<div class="col-md-5 ">
												<h1 calss="">Event Item Details</h1>
											</div>
									<div class="col-xs-2">
											&nbsp;&nbsp;
									</div>
									
									</div>
								</div>
								
								<div class="col text-left">
									{{-- <div class="row"> --}}
										<div class="col-xs-5">
									{{-- <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here"> --}}
									<input class="form-control" id="barcodeInput" type="number" onkeyup="checkBarcode(this)" style="background: transparent;" placeholder="Input Barcode Here" autofocus>
										</div>
										{{-- <div class="col-xs-2">
											&nbsp; &nbsp;
										</div> --}}
										{{-- <div class="col-xs-3">
										<button type="button" class="btn btn-md btn-block" onclick="seachTable()">Search</button>
										</div> --}}
									{{-- </div> --}}
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
						{{-- {!! Form::open(['action' => ['ReturnInventoryController@update', $borrowedItems[0]->event_id], 'method' => 'POST' ,'id' => 'barcodeForm']) !!} --}}
						{!! Form::open(['action' => ['ReturnInventoryController@store'], 'method' => 'POST']) !!}
                        <!-- Modal -->
                        <!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<div class="modal-header">
											<h1 class="modal-title">Are you sure you want to continue?</h1>
										</div>
												
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<p>Please check all necessary details before you continue.</p>
									</div>
									<div class="modal-footer">
										{{ Form::submit('Return Items to Inventory', ['class' => 'btn btn-success']) }}
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="row">
								@foreach($event as $event)
								<div class="col-md-4">
										<label class="form-label">Client Name</label>
											<h1><b>{{ $event->client_name }}</b></h1>
										<input type="hidden" class="form-control" name="event_name" value="{{ $event->event_name}}">	
								</div>
								<div class="col-md-4">
									<input type="hidden" class="form-control" name="event_id" value="{{ $event->event_id}}">
									<label class="form-label">Event Name</label>
										<h1><b>{{ $event->event_name }}</b></h1>
									<input type="hidden" class="form-control" name="event_name" value="{{ $event->event_name}}">
								</div>
								<div class="col-md-4">
									<label class="form-label">Date Deployed</label>
									@if($dateDeployed->date_deployed <= $event->event_start)
										<h1><b>{{ Carbon\Carbon::parse($dateDeployed->date_deployed)->format('F j, Y g:i a') }}</b></h1>
									@else
										<h1><b>{{ Carbon\Carbon::parse($dateDeployed->date_deployed)->format('F j, Y g:i a') }} <font color="red">[LATE]</font></b></h1>
									@endif
									<input type="hidden" class="form-control" name="event_start" value="{{ $dateDeployed->date_deployed}}">
								</div>

								
								<div class="col-md-8">
									<label class="form-label">Venue</label>
									<h1><b>{{ $event->venue}}</b></h1>
									<input type="hidden" class="form-control" name="venue" value="{{ $event->venue}}">
								</div>
								<div class="col-md-4">
										<label class="form-label">Employee Assigned/Responsible</label>
										<h1><b>{{ $employee->employee_fn. ' ' .$employee->employee_ln. ' ('. $employee->contact_no.')' }}</b></h1>
										<input type="hidden" class="form-control" name="venue" value="{{ $employee->id}}">
									</div>
								
								@endforeach
							</div>
						<div class="card-body border-0">
							@foreach($errors->all() as $error)
							<div class="alert alert-danger" role="alert">
								<button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
									{{ $error }}<br>
							</div>
							@endforeach
                    	</div>
                    <div class="table-responsive mb-3">
                            <!-- Projects table -->
                            
                            <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
											<th scope="col">Item Name</th>
											<th scope="col">Color</th>
											<th scope="col">Event Barcode</th>
											{{-- <th scope="col">Rental Cost</th> --}}
											<th scope="col">Quantity Deployed</th>
											{{-- <th scope="col">Total Rental Cost</th> --}}
											<th scope="col">Quantity Scanned for Return</th>
											<th scope="col">Quantity Lost/Damaged</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										{{-- <tr>
												<td>Ikea Chair</td>
												<td>White</td>
												<td> {!! QrCode::size(200)->generate("Item-Name: Ikea Chair, Item-Category: Chair, Color: White, Quantity: 55, Event-Name: Jeremy's Birthday Bash"); !!}</td>
												<td>20 Php</td>
												<td>55 Piece(s)</td>
												<td>1,100 Php</td>
												<td>
													<div class="col-xl-4">
														<label class="form-label">Qty to Return</label>
														<input type="hidden" class="invID" name="invIDs[]" value="1" id="inventory-1">
														<input type="number" value=0  readonly class="form-control qtyReturn" name="qtyReturned[]" id="qtyReturn9876543210123">
													</div>
												</td>
										{{-- </tr> --}}
									
                                        @foreach ($deployed as $i)
                                        {{-- @if($i->status > 0) --}}
                                        <tr id="row{{ $i->barcode }}" class="success">
                                            
											<td>{{ $i->inventory_name }}</td>
											<td>{{ $i->color_name }}</td>
											<td>
												<div id="barcode-{!! $i->inventory_id !!}" value="{!! "toPrint-" . $i->inventory_id!!}">
													{!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->barcode, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!}
													<br>{{$i->barcode}}
												</div>	
											</td>
											{{-- <td>{{ $i->rental_cost}} </td> --}}
											<td>
												{{ $i->qty }}
												<input hidden type="text" value="{{ $i->qty}}" id="qty{{ $i->barcode }}">
											</td>
											{{-- <td> {{ $i->rental_cost * $i->qty }} </td> --}}
											<td>
												<div class="col-xl-6">
													{{-- <label class="form-label">Qty to Return</label> --}}
													<input type="hidden" class="invID" name="invIDs[]" value="{{ $i->inventory_id }}" id="inventory-{{ $i->inventory_id }}">
													<input type="number" value=0  readonly class="form-control qtyReturn" name="qtyReturned[]" id="qtyReturn{{ $i->barcode }}">
												</div>
											</td>
											<td>
												<div class="col-xl-6">
													{{-- <label class="form-label">Qty to Return</label> --}}
													<input type="hidden" class="lostID" name="lostIDs[]" value="{{ $i->inventory_id }}" id="lost-{{ $i->inventory_id }}">
													<input type="number" value={{ $i->qty }}  readonly class="form-control qtyLostDam" name="qtyLostDam[]" id="qtyLostDam{{ $i->barcode }}">
												</div>
											</td>
                                        </tr>
                                        {{-- @endif --}}
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
				</div>
				<div class="card-footer text-muted">
						<div class="text-right">
								<button type="button" onclick="checkLoD()" class="btn btn-success" data-toggle="modal" data-target="#myModal">Return Items To Inventory</button>
								{{-- <button type="submit" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Return Items to Inventory</button> --}}
								<a href="{{ url('returnInventory')}}" class="btn btn-default">Back</a>
								{{-- <a href="" class="btn btn-primary" onclick="printContent('barcode-{{ $itemInfo[0]->inventory_id }}');" id="printBtn{{ $itemInfo[0]->inventory_id}}">
									<i class="ni ni-single-copy-04"></i>
									<span>{{ __('Print Barcode') }}</span>
								</a> --}}
								
						</div>
				</div>
				{{-- <div class="col-md-12 mb-3">
						{{ Form::submit('Replenish Item', ['class' => 'btn btn-success']) }}
				</div> --}}
			</div>
		</div>
				<input type="hidden" name="qtyReturnArray" id="qtyReturnArray">
				<input type="hidden" name="idReturnArray" id="idReturnArray">
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
			var barcode = document.getElementById('barcodeInput').value;
			document.getElementById('barcodeInput').onkeyup = function checkBarcode(){

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