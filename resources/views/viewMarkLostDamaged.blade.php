
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
                                        <h3 class="modal-title">Are you sure you want to continue?</h3>
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
                                                    <h3>{{ $event->event_name }}</h3>
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Venue </label> 
                                                    <h3>{{ $event->venue }}</h3>
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Date of Event </label>
                                                    <h3>{{ Carbon\Carbon::parse($event->event_start)->format('F j, Y      g:i a') }}</h3> 
                                                </div>
                                                <div class="col-md-3">
                                                    <label> Package </label>
                                                    <h3>{{ $event->package_name }}</h3>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                        <label> Assigned Personel In-charge: </label>
                                                        <h3>{{ $employee->employee_fn. ' ' .$employee->employee_ln. ' ('. $employee->contact_no.')' }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                {{-- @foreach ($lostDamaged as $i)
                                                <input type="hidden" name="item_id{{ $i->inventory_id}}" id="item_id-{{ $i->barcode }}" value="{{ $i->inventory_id}}">
                                                <input type="hidden" class="form-control" value="{{ $i->inventory_name }}" name="inventory_name{{$i->inventory_id}}" id="inventory_name">
                                                <input type="hidden" class="form-control barcode" value=" {{$i->barcode}}" name="barcode" id="barcode">
                                                <input type="hidden" class="form-control" value="{{ $i->qty }}" name="qty" id="qty"> --}}
                                                <table class="table align-items-center table-flush" id="myTable1">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th scope="col">Item Name</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Color</th>
                                                            <th scope="col">Barcode</th>
                                                            <th scope="col">Quantity Reported</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Reason</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($lostDamaged as $i)
                                                        <input type="hidden" name="item_id{{ $i->inventory_id}}" id="item_id-{{ $i->barcode }}" value="{{ $i->inventory_id}}">
                                                        <input type="hidden" class="form-control" value="{{ $i->inventory_name }}" name="inventory_name{{$i->inventory_id}}" id="inventory_name">
                                                        <input type="hidden" class="form-control barcode" value=" {{$i->barcode}}" name="barcode" id="barcode">
                                                        <input type="hidden" class="form-control" value="{{ $i->qty }}" name="qty" id="qty">
                                                        <tr>
                                                            <td>{{ $i->inventory_name }}</td>
                                                            <td>{{ $i->category_name }}</td>
                                                            <td>{{ $i->color_name }}</td>
                                                            <td>
                                                                {!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->barcode, "C128A",2,50,array(1,1,1), true) . '" alt="barcode"   />' !!}
                                                                <br>{{$i->barcode}}    
                                                            </td>
                                                            <td>{{ $i->qty }}</td>
                                                            <td>
                                                                <select class="form-control status" name="status" id="status-{{ $i->barcode }}" required>
                                                                    <option selected disabled>Please Select an Option</option>
                                                                    <option value="lost">Lost</option>
                                                                    <option value="damaged">Damaged</option>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control reason" name="reason" id="reason-{{ $i->barcode }}" cols="30" rows="10" placeholder="Please Input Reason for Loss/Damage" required></textarea>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-sm btn-success check" name="accept" id="{{$i->barcode}}" onclick="checkReason(this.id)"><i class="ni ni-check-bold"></i></button>
                                                                <button type="button" class="btn btn-sm btn-danger cancel" name="cancel" id="{{$i->barcode}}" onclick="cancelReason(this.id)"><i class="ni ni-fat-remove"></i></button>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <input type="hidden" name="reasonsArray" id="reasonsArray">
                                                <input type="hidden" name="idsArray" id="idsArray">
                                                <input type="hidden" name="statusesArray" id="statusesArray">

                                                {!! Form::close() !!}
                                                    {{-- <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <label> Item Name </label>
                                                                <h4> {{ $i->inventory_name }}</h4>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label> Category </label>
                                                                <h4> {{ $i->category_name }}</h4>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <label> Color </label>
                                                                <h4> {{ $i->color_name }}</h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                
                                                                <label> Event Barcode (not inventory barcode) </label>
                                                                <div class="col-md-12 short-content">
                                                                    {!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->barcode, "C128A",2,50,array(1,1,1), true) . '" alt="barcode"   />' !!}
                                                                    <br>{{$i->barcode}}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2 offset-1">
                                                                <label> Quantity Reported </label>
                                                                <h4> {{ $i->qty }} </h4>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <select class="form-control status" name="status" id="status-{{ $i->barcode }}" required>
                                                                    <option selected disabled>Please Select an Option</option>
                                                                    <option value="lost">Lost</option>
                                                                    <option value="lost">Damaged</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-10 offset-10">
                                                                <div class="row">
                                                                
                                                                <div class="col-md-3">
                                                                    <label> Reason <font color="red">*</font></label>
                                                                    <div class="row">
                                                                        <div class="col-md-10">
                                                                            
                                                                            <textarea class="form-control reason" name="reason" id="reason-{{ $i->barcode }}" cols="30" rows="10" placeholder="Please Input Reason for Loss/Damage" required></textarea>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                           

                                                            <input type="hidden" name="reasonsArray" id="reasonsArray">
                                                            <input type="hidden" name="idsArray" id="idsArray">

                                                            {!! Form::close() !!}
                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-sm btn-success check" name="accept" id="{{$i->barcode}}" onclick="checkReason(this.id)"><i class="ni ni-check-bold"></i></button>
                                                                <button type="button" class="btn btn-sm btn-danger cancel" name="cancel" id="{{$i->barcode}}" onclick="cancelReason(this.id)"><i class="ni ni-fat-remove"></i></button>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div> --}}
                                            
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                <button type="button" class="button btn btn-success" data-toggle="modal" onclick="checkInputClosed()" data-target="#myModal">Report</button>
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
		function checkReason(clicked_id){

            var reason = "reason-"+clicked_id+"";

            var inputs = document.getElementsByClassName( 'reason' ),
            reasons  = [].map.call(inputs, function( input ) {
                return input.value;
                
            }).join( ',' );

            var inputs = document.getElementsByClassName( 'barcode' ),
            ids  = [].map.call(inputs, function( input ) {
                return input.value;
                
            }).join( ',' );

            var inputs = document.getElementsByClassName( 'status' ),
            statuses  = [].map.call(inputs, function( input ) {
                return input.value;
                
            }).join( ',' );

            document.getElementById(reason).readOnly = true;

            

            document.getElementById('reasonsArray').value = reasons;
            document.getElementById('idsArray').value = ids;
            document.getElementById('statusesArray').value = statuses;

            // alert( document.getElementById('reasonsArray').value+"<br>"+document.getElementById('idsArray').value+"<br>"+document.getElementById('statusesArray').value)
 
		}

        function cancelReason(clicked_id){
            var reason = "reason-"+clicked_id+"";
            document.getElementById(reason+"").readOnly = false;
        }
	</script>
@endpush