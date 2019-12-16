
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
										<h1 class="">Add Inventory Form</h1>
									</div>
									<div class="col-md-4 " >
											{{-- <label class="form-label">Item Source</label> --}}
											<div align="right">
											<select id="source" name="source" class="form-control" placeholder="Item Source" required>
													<option value = 0 selected disabled>Please Select Item Source</option>
													<option value = 1>Bought</option>
													<option value = 2>Outsourced</option>
													<option value = 3>Alternative (Flowers Only)</option>
													{{-- @foreach ($categories as $category)
													@if ($category->categoryId == $itemInfo[0]->category)
														<option value="{{ $category->categoryId }}" id="categoryBal" selected>{{ $category->categoryName }}</option>
													@else
														<option value="{{ $category->categoryId }}" id="categoryBal" >{{ $category->categoryName }}</option>
													@endif
													@endforeach --}}
											</select>
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
							
							
							<div class="row">
								<div class="col-md-12 mb-3">
									<label class="form-label">Item Name</label>
									{{ Form::text('itemName', '',['class' => 'form-control', 'placeholder' => 'Item Name'] )}}
									
								</div>
								
								<div class="col-md-6 mb-3">
										<label class="form-label">Category</label>
								<select id="category" name="category" class="form-control" placeholder="Category" onchange="filterDropdown()" required>
												<option value = 0 selected disabled>Please Select a Category</option>
												@foreach ($categories as $category)
													<option id="category-{{$category->category_no}}" value="{{ $category->category_no }}">{{ $category->category_name }}</option>
												@endforeach             
										</select>
								</div>
								<div class="col-md-6 mb-3">
										<label class="form-label">Sub-Category</label>
										<select id="subcategory" name="subcategory" class="form-control" placeholder="Sub-Category" required>
												<option value = 0 selected disabled>Please Select a Category</option>
												{{-- {{$items[] = array()}}
													@foreach($subcategories as $subcategory)
														{{$items[] = $subcategory->subcategory}}
													@endforeach --}}
												{{-- <input type="hidden" value="{{$items}}" id="hiddenArray"> --}}
												{{-- @foreach ($subcategories as $subcategory)
													
													<option id="subcategory-{{$subcategory->category_no}}" value="{{ $subcategory->subcategory }}">{{ $subcategory->subcategory_name }}</option>
													
												@endforeach              --}}
										</select>
								</div>
								
								<div class="col-md-4 mb-3">
									<label class="form-label">Item Quantity</label>
									{{ Form::number('quantity', '',['class' => 'form-control', 'placeholder' => 'Starting Quantity'] )}}
								</div>
								<div class="col-md-4 mb-3">
									<label class="form-label">Item Threshold</label>
									{{ Form::number('threshold', '',['class' => 'form-control', 'placeholder' => 'Minimum Threshold'] )}}
								</div>
							</div>
						</div>
						<div class="card-footer text-muted">
								{{-- @foreach($subcategoryIds as $subcategoryId)
									<p>{{$subcategoryId}}</p>
								@endforeach --}}

								<div class="text-right">
								
								{{ Form::submit('Add Item', ['class' => 'btn btn-success']) }}
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
<!-- <script>
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

	
	
</script> -->