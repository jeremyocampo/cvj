
@extends('layouts.inventoryApp')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						{!! Form::open(['action' => 'InventoryController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!}
						<div class="card-header">
<<<<<<< HEAD
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
=======
								<div class="row align-items-center">
									<div class="col">
										<h1 class="">Deploy Inventory Form</h1>
									</div>
									<div class="col-md-4">
											{{-- <label class="form-label">Item Source</label> --}}
											<div align="right">
											</div>
									</div>
								</div>
						</div>
						<div class="card-body border-0">
								@foreach($errors->all() as $error)
								<div class="alert alert-danger" role="alert">
									<button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
										{{ $error }}<br>
								</div>
								@endforeach
								<div class="table-responsive mb-3">
									<!-- Projects table -->
									
									<table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
										<thead class="thead-light">
											<tr>
												<th >Event Name</th>
												<th >Client</th>
												<th >Venue</th>
												<th >Date</th>
												<th >Threshold</th>
												<th >Last Modified (YY-MM-DD)</th>
												<th >Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($events as $i)
											@if($i->status > 0)
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											@endif
											@endforeach
										</tbody>
									</table>
								</div>




						</div>
						<div class="card-footer text-muted">
							{{-- @foreach($subcategoryIds as $subcategoryId)
								<p>{{$subcategoryId}}</p>
							@endforeach --}}
							<div class="text-right">
								{{ Form::submit('Deploy Item', ['class' => 'btn btn-success']) }}
								<a href="{{ url('inventory')}}" class="btn btn-default">Back</a>
								{{-- {{Form::hidden('_method', 'PUT')}} --}} 
							</div>
						</div>
						{!! Form::close() !!}
			</div>
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
		</div>
        </div>

        

	</div>
</div>
@endsection

<script>
	function getSelected(){

		// // get references to select list and display text box
		// var sel = document.getElementById('category');
		// var el = document.getElementById('display');

		// function getSelectedOption(sel) {
		// 	var opt;
		// 	for ( var i = 0, len = sel.options.length; i < len; i++ ) {
		// 		opt = sel.options[i];
		// 		if ( opt.selected === true ) {
		// 			break;
		// 		}
		// 	}
		// 	return opt;
		}

		// assign onclick handlers to the buttons
		// document.getElementById('showVal').onclick = function () {
		// 	el.value = sel.value;    
		// }
	}
	$('#selectField').change(function(){
    if($('#selectField').val() == 'N'){
        $('#secondaryInput').hide();
    } else {
        $('#secondaryInput').show();
	}
	});


</script>
{{-- <script>
	function filterDropdown(){
		// alert('hi');

		// var arr = document.getElementById('hiddenArray').value;
		// alert('hi');
		var ids = @json($subcategoryIds);
		var names = @json($subcategoryNames);
		alert(names);
		// alert('hi');
		var a = document.getElementById('category').value;
		var select = document.getElementById("subcategory");
		var options;

		

		$("#subcategory").empty();


		if(a==1){
			for( var x=0; x<ids.length; x++){
				options[x] = names[x];
				alert(options[x]);
			}
		} else if(a==2){
			var b = 4;
			for( var x=0; (x+b)<ids.length; x++){
				options[x] = names[x];
			}
		} else if(a==3){
			var b = 9;
			for( var x=0; (x+b)<ids.length; x++){
				options[x] = names[x];
			}
		} else{
			options = [16, 17, 18, 19, 20];
			
		}

		
		// var options = 
		for(var i = 0; i < options.length; i++) {
			// alert(i);
			var opt = options[i];
			var el = document.createElement("option");
			el.textContent = opt;
			el.value = opt;
			select.appendChild(el);
		}
	}
	// 	var options = $("#DropDownList2").html();
	// $("#DropDownList1").change(function(e) {
	// var text = $("#DropDownList1 :selected").text();
	// $("#DropDownList2").html(options);
	// if(text == "All") return;
	// 	$('#DropDownList2 :not([value^="' + text.substr(0, 3) + '"])').remove();
	// });​

	
	
</script> --}}