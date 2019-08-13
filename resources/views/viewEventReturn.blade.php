@extends('layouts.app')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> --}}
@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
		
	{{-- <!-- Modal -->
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
				
				<div class="modal-footer">
				  {{ Form::submit('Confirm Changes', ['class' => 'btn btn-success']) }}
				  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			  </div>
		  
			</div>
		  </div> --}}
		
				{{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
				<div class="col-xl-12 mb-5">
					<div class="card shadow " >
						<div class="card-header ">
							<div class="row align-items-center">
								<div class="col">
									<div class="row">
											<div class="col-md-5 ">
												<h2 calss="">View Item Details</h2>
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
						{!! Form::open(['action' => ['ReturnInventoryController@update', $borrowedItems[0]->event_id], 'method' => 'POST' ,'id' => 'barcodeForm']) !!}
					<div class="card-body">
		
							<div class="row">
									
									<div class="col-xl-4">
										{{-- <label class="text-muted">Event Name: {{$borrowedItems[0]->event_name}}</label> --}}
										<label class="form-label">Event Name</label>
										{{ Form::text('itemName', $borrowedItems[0]->event_name,['class' => 'form-control', 'disabled'] )}}
									</div>
									<div class="col-xl-4">
											{{-- <label class="text-muted">Event Name: {{$borrowedItems[0]->event_name}}</label> --}}
											<label class="form-label">Client Name</label>
											{{ Form::text('itemName', $borrowedItems[0]->client_name,['class' => 'form-control', 'disabled'] )}}
										</div>
									<div class="col-xl-4">
											<label class="form-label">Date Borrowed</label>
											{{ Form::text('itemName', $borrowedItems[0]->event_start,['class' => 'form-control', 'disabled'] )}}
									</div>
									<div class="col-xl-4">
										{{-- <label class="text-muted">Date Due: {{$borrowedItems[0]->event_end}}</label> --}}
										<label class="form-label">Date Due</label>
										{{ Form::text('itemName', $borrowedItems[0]->event_end,['class' => 'form-control', 'disabled'] )}}
									</div>
									<div class="col-xl-12">
											<label class="form-label">Venue</label>
											{{ Form::text('itemName', $borrowedItems[0]->venue,['class' => 'form-control', 'disabled'] )}}
									</div>
									
									<div class="col-xl-4">
										
									</div>
								
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
											<th scope="col">Rental Cost</th>
											<th scope="col">Quantity</th>
											<th scope="col">Total Rental Cost</th>
                                            <th scope="col">Items Scanned</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($borrowedItems as $i)
                                        @if($i->status > 0)
                                        <tr id="row{{ $i->esku }}" class="success">
                                            
											<td>{{ $i->inventory_name }}</td>
											<td>{{ $i->color_name }}</td>
											<td>
												<div id="barcode-{!! $i->inventory_id !!}" value="{!! "toPrint-" . $i->inventory_id!!}">
													{!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->esku, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!}
													<br>{{$i->esku}}
												</div>	
											</td>
											<td>{{ $i->rental_cost}} </td>
											<td>
												{{ $i->qty }}
												<input hidden type="text" value="{{ $i->qty}}" id="qty{{ $i->esku }}">
											</td>
											<td> {{ $i->rental_cost * $i->qty }} </td>
											<td>
												<div class="col-xl-4">
													<label class="form-label">Qty to Return</label>
													<input type="hidden" class="invID" name="invIDs[]" value="{{ $i->inventory_id }}" id="inventory-{{ $i->inventory_id }}">
													<input type="number" value=0  readonly class="form-control qtyReturn" name="qtyReturned[]" id="qtyReturn{{ $i->esku }}">
												</div>
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
								<button type="submit" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Return Items to Inventory</button>
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
				{{Form::hidden('_method', 'PUT')}}
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
				// alert(barcode);
				
				var barcodeId = "qtyReturn"+barcode+"";
				var qtyId = "qty"+barcode+"";
				var rowId = "row"+barcode+"";
				if (document.getElementById(barcodeId).value != null){
					if(parseInt(document.getElementById(barcodeId).value) < parseInt(document.getElementById(qtyId).value)){
						// alert(barcode);
						document.getElementById(barcodeId).value = parseInt(document.getElementById(barcodeId).value) + 1;
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
						// alert(input.value);
					}).join();


				// var Quant = qtys.split(",");
				// var IDS = ids.split(","); 
				
				document.getElementById('qtyReturnArray').value = qtys;
				document.getElementById('idReturnArray').value = ids;

				var qty = document.getElementById('qtyReturnArray').value;
				var id = document.getElementById('idReturnArray').value;

				// alert(id);
				// alert(qty);

			}
		});
	</script>
@endpush