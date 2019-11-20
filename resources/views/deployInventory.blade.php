
@extends('layouts.inventoryApp')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-8 mb-5 mb-xl-0">
				<div class="card shadow">
						{!! Form::open(['action' => 'InventoryController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!}
						<div class="card-header">
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