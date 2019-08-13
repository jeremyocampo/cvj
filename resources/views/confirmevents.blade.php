
@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						{!! Form::open(['action' => 'InventoryController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!}
						<div class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<h1 class="">Confirm Events</h1>
									</div>
									<div class="col-md-4">
											{{-- <label class="form-label">Item Source</label> --}}
											<div align="right">
											</div>
									</div>
								</div>
						</div>
						<div class="card-body border-0">
								{{-- @foreach($errors->all() as $error)
								<div class="alert alert-danger" role="alert">
									<button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
										{{ $error }}<br>
								</div>
								@endforeach --}}
								<div>
									<iframe src="https://calendar.google.com/calendar/embed?src=cvjcatering.info%40gmail.com&ctz=Asia%2FManila" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
								</div>
								<div class="table-responsive mb-3">
									<!-- Projects table -->
									
									<table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
										<thead class="thead-light">
											<tr>
												{{-- <th>Event ID</th> --}}
												<th>Event Name</th>
												<th>Venue</th>
												<th>Start Date/Time</th>
												<th>End Date/Time</th>
												{{-- <th>Description</th> --}}
												<th >Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($events as $i)
											{{-- @if($i->status > 0) --}}
											<tr>
												{{-- <td> {{ $i->id}}</td> --}}
												<td> {{ $i->name }}</td>
												<td> {{ $i->location }}</td>
												<td> {{ $i->startDateTime }}</td>
												<td> {{ $i->endDateTime }}</td>
											{{-- <td> {{ $i->description }}</td> --}}
												<td>
													
													<button class="btn btn-success" data-toggle="modal" data-target="#approve-modal">Approve</button>
													<button class="btn btn-danger" data-toggle="modal" data-target="#decline-modal">Decline</button>
												</td>
											</tr>
											{{-- @endif --}}
											@endforeach
										</tbody>
									</table>
								</div>


								<div class="modal fade" id="approve-modal">
										<div class="modal-dialog">
										  <div class="modal-content">
											<div class="modal-header">
												<h2 class="modal-title" text-align: center><b>Add Deposit</b></h2>
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											  
											</div>
											<div class="modal-body">
											 	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
												<div class="box-body">
				
												  <div class="form-group">
													<label > <h3>  Amount </h3> </label> 
													{{ Form::number('amount', '', ['class' => 'form-control', 'placeholder' => '0.00', 'step'=>'0.01', 'min'=>'20000','required' => 'true'])}}
													
												  </div> 
				
												</div>
				
				
												<div class="modal-footer">
												  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
												  <button type="submit" class="btn btn-success">Submit</button>
												</div>
											  
											</div>
										  </div>
										</div>
									  </div>


									  <div class="modal fade" id="decline-modal">
											<div class="modal-dialog">
											  <div class="modal-content">
												<div class="modal-header">
													<h2 class="modal-title" text-align: center><b>Reason for Declining Event</b></h2>
												  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												  </button>
												  
												</div>
												<div class="modal-body">
												 	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
													<div class="box-body">
					
													  <div class="form-group">
														{{ Form::textarea('reason', '', ['class' => 'form-control', 'placeholder' => 'Input reason here', 'required' => 'true'])}}
														
													  </div> 
					
													</div>
					
					
													<div class="modal-footer">
													  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
													  {{ Form::submit('Submit', ['class' => 'btn btn-success']) }} 
                                                                    
                                                      {{ Form::hidden('_method','DELETE')}}
																{!! Form::close() !!}
													</div>
												  
												</div>
											  </div>
											</div>
										  </div>



						</div>
						<div class="card-footer text-muted">
							{{-- @foreach($subcategoryIds as $subcategoryId)
								<p>{{$subcategoryId}}</p>
							@endforeach --}}
							<div class="text-right">
								
								
								{{-- {{Form::hidden('_method', 'PUT')}} --}} 
							</div>
						</div>
					{!! Form::close() !!}
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
