@extends('layouts.app')

@section('content')
{{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> --}}
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						{!! Form::open(['action' => 'InventoryController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!}
						<div class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<h1 class="">Outsource Item to Inventory</h1>
									</div>
									<div class="col-md-4 " >
											{{-- <label class="form-label">Item Source</label> --}}
											<div align="right">
											
											</div>
									</div>
								</div>
                        </div>
                        
                        

						<div class="card-body border-0">
							
								@foreach($errors->all() as $error)
								<div class="alert alert-danger" role="alert">
									<button type = button data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
										{{ $error }}<br>
								</div>
										
								@endforeach
								<div class="row">
									<div class="col-md-4">
										<label class="form-label">Event Name</label>
											{{-- <div class="dropdown">
											<button onclick="dropdownFilter()" class="dropbtn">Dropdown</button>
											<div id="myDropdown" class="dropdown-content">
												<input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
												<a href="#about">About</a>
												<a href="#base">Base</a>
												<a href="#blog">Blog</a>
												<a href="#contact">Contact</a>
												<a href="#custom">Custom</a>
												<a href="#support">Support</a>
												<a href="#tools">Tools</a>
											</div>
											</div> --}}
											<div class="row-fluid mb-3">
											<select class="selectpicker" data-show-subtext="true" data-live-search="true">
												<option data-subtext="Rep California">Tom Foolery</option>
												<option data-subtext="Sen California">Bill Gordon</option>
												<option data-subtext="Sen Massacusetts">Elizabeth Warren</option>
												<option data-subtext="Rep Alabama">Mario Flores</option>
												<option data-subtext="Rep Alaska">Don Young</option>
												<option data-subtext="Rep California" disabled="disabled">Marvin Martinez</option>
											</select>
											</div>
									</div>
										<div class="col-md-4 mb-3">
											<label class="form-label">Item Price (Php)</label>
											{{-- {{ Form::number('price', '',['class' => 'form-control', 'placeholder' => 'Item Price' , 'type' => 'number' , 'min' => 1 , 'step' => 0.01] )}} --}}
										</div>
		
										
										<div class="col-md-12 mb-3">
											<button class="btn btn-sm btn-block btn-success" type="button" id="more_fields" onclick="add_a_row();" value="" class="btn btn-secondary">+ Add Item</button>
										</div>
		
										<div class="table-responsive mb-2" >
										
											
										<table class="table  align-items-center table-hover  mb-3" id="myTable" >
													<thead>
														<tr>
															<th>Question</th>
															<th>Answer</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													{{-- <tr>
														<td>
														<input type="text" name="itemName" placeholder="Item Name"  id="item_name1" class="form-control">
														</td>
														<td>
															<input type="number" name="qty" placeholder="Item Quantity"  id="item_qty1" class="form-control">
														</td>
														<td>
															<button > hi</button>
														</td>
													</tr> --}}
													</tbody>
												</table>
										</div>
										</div>
							
							
							<div class="row">
								<div class="col-md-12 mb-3">
									<label class="form-label">Item Name</label>
									{{-- {{ Form::text('itemName', '',['class' => 'form-control', 'placeholder' => 'Item Name'] )}} --}}
									<select id="Item Name" name="size" class="form-control" placeholder="Item Name" required>

									</select>
								</div>

								<div class="col-md-3 mb-3"></div>
								<div class="col-md-9 mb-3">
									<label class="form-label">Color</label>
									<select id="color" name="color" class="form-control" placeholder="Color" required>
											<option value = 0 selected disabled>Please Select a Color</option>
											{{-- @foreach ($colors as $color)
												<option id="category-{{ $color->color_id }}" value="{{ $color->color_id }}">{{ $color->color_name}}</option>
											@endforeach --}}
									</select>
								</div>
								<div class="col-md-3 mb-3"></div>
								<div class="col-md-9 mb-3">
									<label class="form-label">Size</label>
									<select id="color" name="size" class="form-control" placeholder="Size" required>
											<option value = 0 selected disabled>Please Select a Size</option>
											<option value=1>Small</option>
											<option value=2>Medium</option>
											<option value=3>Large</option>
											<option value=4>Extra Large</option>
									</select>
								</div>
								<div class="col-md-3 mb-3"></div>
								<div class="col-md-5 mb-3">
									<label class="form-label">Item Quantity</label>
									{{ Form::number('quantity', '',['class' => 'form-control', 'placeholder' => 'Starting Quantity'] )}}
								</div>
								<div class="col-md-4 mb-3">
									<label class="form-label">Item Threshold</label>
									{{ Form::number('threshold', '',['class' => 'form-control', 'placeholder' => 'Minimum Threshold'] )}}
								</div>
								<div class="col-md-3"></div>
								<div class="col-md-4 mb-3">
									<label class="form-label">Item Price (Php)</label>
									{{ Form::number('price', '',['class' => 'form-control', 'placeholder' => 'Item Price' , 'type' => 'number' , 'min' => 1 , 'step' => 0.01] )}}
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


	function dropdownFilter() {
	  document.getElementById("myDropdown").classList.toggle("show");
	}
	
	function filterFunction() {
	  var input, filter, ul, li, a, i;
	  input = document.getElementById("myInput");
	  filter = input.value.toUpperCase();
	  div = document.getElementById("myDropdown");
	  a = div.getElementsByTagName("a");
	  for (i = 0; i < a.length; i++) {
		txtValue = a[i].textContent || a[i].innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
		  a[i].style.display = "";
		} else {
		  a[i].style.display = "none";
		}
	  }
	}

	</script>
	<script>
		var x = 1;
		function add_a_row(){
			if(x>=1){

				var row = $('<tr id="appndd_tr"><td><select id="color" name="rawMatItem" class="form-control" placeholder="Raw Material Item" required><option value="0" selected disabled>Please Select an Item</option><br> @foreach($items as $i) <br><option id="category-{{ $i->inventory_id }}" value="{{ $i->inventory_id }}">{{ $i->inventory_name}}</option><br>@endforeach<br></select></td><td><input type="number" name="qty" placeholder="Item Quantity"  id="item_qty1" class="form-control"></td><td><br/><button type="button" onclick="remove_row()" class="btn btn-wide btn-danger">Remove</button></td></tr>');
				row.append().prependTo("#myTable");
				x++;
			}
		}

		function remove_row(){
			$('#appndd_tr').remove();
			x = x-1;
		}

		var trArray = [];
		$('#tbPermission tr').each(function () {
			var tr =$(this).text();  //get current tr's text
			var tdArray = [];
			$(this).find('td').each(function () {
				var td = $(this).text();  //get current td's text
				var items = {}; //create an empty object
				items[tr] = td; // add elements to object 
				tdArray.push(items); //push the object to array
			});    
		});
	</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>