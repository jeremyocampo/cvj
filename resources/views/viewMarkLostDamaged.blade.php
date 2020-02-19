
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
                                        {{ Form::submit('Report Lost/Damaged Items', ['class' => 'btn btn-success']) }}
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
                                        <div class="col-md-12 mb-5">
                                            <div class="row">
                                                <input type="hidden" name="event_id" id="event_id" value="{{ $event->event_id }}">
                                                <input type="hidden" class="form-control" value="{{ $event->event_name }}" name="event_name" id="event_name">
                                                <input type="hidden" class="form-control" value="{{ $event->venue }}" name="qty" id="qty">
                                                <input type="hidden" class="form-control" value="{{ $event->event_start }}" name="event_start" id="qty">
                                                <input type="hidden" class="form-control" value="{{ $event->package_name }}" name="package_name" id="package_name">
                                                <div class="col-md-3">
                                                    <label> Event Name </label>
                                                    <h1>{{ $event->event_name }}</h1>
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Venue </label> 
                                                    <h1>{{ $event->venue }}</h1>
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Date of Event </label>
                                                    <h1>{{ Carbon\Carbon::parse($event->event_start)->format('F j, Y      g:i a') }}</h1> 
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Package </label>
                                                    <h1>{{ $event->package_name }}</h1>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                        <label> Assigned Personel In-charge: </label>
                                                        <h1>{{ $employee->employee_fn. ' ' .$employee->employee_ln. ' ('. $employee->contact_no.')' }}</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                @foreach ($lostDamaged as $i)
                                                <input type="hidden" name="item_id{{ $i->inventory_id}}" id="item_id-{{ $i->barcode }}" value="{{ $i->inventory_id}}">
                                                <input type="hidden" class="form-control" value="{{ $i->inventory_name }}" name="inventory_name{{$i->inventory_id}}" id="inventory_name">
                                                <input type="hidden" class="form-control barcode" value=" {{$i->barcode}}" name="barcode" id="barcode">
                                                <input type="hidden" class="form-control" value="{{ $i->qty }}" name="qty" id="qty">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <label> Item Name </label>
                                                                <h2> {{ $i->inventory_name }}</h2>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label> Category </label>
                                                                <h2> {{ $i->category_name }}</h2>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label> Color </label>
                                                                <h2> {{ $i->color_name }}</h2>
                                                            </div>
                                                            <div class="col-md-3">
                                                                {{-- <style>
                                                                    .short-content{
                                                                        width:100%
                                                                        overflow:hidden
                                                                    }
                                                                </style> --}}
                                                                <label> Event Barcode (not inventory barcode) </label>
                                                                <div class="col-md-12 short-content">
                                                                    {!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->barcode, "C128A",2,50,array(1,1,1), true) . '" alt="barcode"   />' !!}
                                                                    <br>{{$i->barcode}}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 offset-1">
                                                                <label> Quantity Reported </label>
                                                                <h2> {{ $i->qty }} </h2>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label> Reason <font color="red">*</font></label>
                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        
                                                                        <textarea class="form-control reason" name="reason-{{ $i->inventory_id }}" id="reason-{{ $i->barcode }}" cols="30" rows="10" placeholder="Please Input Reason for Loss/Damage" required></textarea>
                                                                        
                                                                    </div>
                                                                    <div class="col-md-2 offset-1">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="reasonsArray" id="reasonsArray">
                                                            <input type="hidden" name="idsArray" id="idsArray">
                                                            {!! Form::close() !!}
                                                            <div class="col-md-1">
                                                                <button type="button" class="btn btn-sm btn-success check" name="accept" id="{{$i->barcode}}" onclick="checkReason(this.id)"><i class="ni ni-check-bold"></i></button>
                                                                <button type="button" class="btn btn-sm btn-danger cancel" name="cancel" id="{{$i->barcode}}" onclick="cancelReason(this.id)"><i class="ni ni-fat-remove"></i></button>
                                                            </div>
                                                        </div>
                                                        
                                                        {{-- <td>
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <input type="hidden" id="barcode" value="{{ $i->barcode }}">
                                                                    <input type="hidden" class="invID" name="invIDs[]" value="{{ $i->inventory_id }}" id="inventory-{{ $i->inventory_id }}">
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
                                                        </td> --}}
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                <button type="button" class="button btn-success btn-lg" data-toggle="modal" onclick="checkInputClosed()" data-target="#myModal">Report</button>
                                <a href="{{ url('markLostDamaged')}}" class="btn btn-default">Back</a>
                            </div>
                        </div>
                        {{-- {{Form::hidden('_method', 'PUT')}} --}}
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
            var reasonsWhy = array();

           

        //     document.getElementsByClassName('button').onclick = function checkReason(){
        //         alert("hi");

        //         reasonsWhy.push( $( "textarea" ).map(function() {
        //         return $( this ).val();
        //         })
        //         .get()
        //         .join( ", " ) );

        //         // window.alert(reasonsWhy+"-hi");

        //         // alert("HELLO");

		// 		// var barcode = document.getElementById('barcodeInput').value;
                

				
		// 		var barcodeId = "qtyReturn"+barcode+"";
		// 		var lostbarcodeId = "qtyLostDam"+barcode+""; 
		// 		var qtyId = "qty"+barcode+"";
		// 		var rowId = "row"+barcode+"";

		// 		if (document.getElementById(barcodeId).value != null){
		// 			if(parseInt(document.getElementById(barcodeId).value) < parseInt(document.getElementById(qtyId).value)){
		// 				document.getElementById(barcodeId).value = parseInt(document.getElementById(barcodeId).value) + 1;
		// 				document.getElementById(lostbarcodeId).value = parseInt(document.getElementById(lostbarcodeId).value) - 1;
		// 			} else if (parseInt(document.getElementById(barcodeId).value) == parseInt(document.getElementById(qtyId).value)){
		// 				document.getElementById(rowId).className = 'success';
		// 			}
		// 			barcode = document.getElementById('barcodeInput').value = "";
		// 		}

		// 		var quantities = document.getElementsByClassName( 'qtyReturn' ),
		// 			qtys  = [].map.call(quantities, function( input ) {
		// 				return input.value;
		// 			}).join();

		// 		var inventoryIDs = document.getElementsByClassName( 'invID' ),
		// 			ids  = [].map.call(inventoryIDs, function( input ) {
		// 				return input.id;
		// 			}).join();

		// 		// var lostIDs = document.getElementsByClassName('lostID'),
		// 		// 	losts = [].

		// 		document.getElementById('qtyReturnArray').value = qtys;
		// 		document.getElementById('idReturnArray').value = ids;

		// 		var qty = document.getElementById('qtyReturnArray').value;
		// 		var id = document.getElementById('idReturnArray').value;
		// 	}


		});

		function checkReason(clicked_id){
            // var barcode = document.getElementsByClassName('reason')
            // var text = a.value;
            // alert(text+"-hi");
            // alert("hello");

            var reason = "reason-"+clicked_id+"";

            document.getElementById(reason).readOnly = true;

            var inputs = document.getElementsByClassName( 'reason' ),
            reasons  = [].map.call(inputs, function( input ) {
                return input.value;
                
            }).join( ',' );

            var inputs = document.getElementById( 'barcode' ),
            ids  = [].map.call(inputs, function( input ) {
                return inputs.value;
                
            }).join( ',' );

            alert(ids+"");

            document.getElementById('reasonsArray').value = reasons;
            document.getElementById('idsArray').value = ids;
            // document.getElementById('idReturnArray').value = ids;
            
		}

        function cancelReason(clicked_id){
            var reason = "reason-"+clicked_id+"";
            document.getElementById(reason+"").readOnly = false;
            // alert(reason);
            alert( document.getElementById('idsArray').value + "");
        }
	</script>
@endpush