@extends('layouts.inventoryApp')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-8 mb-5 mb-xl-0">
				<div class="card shadow">
						{!! Form::open(['action' => 'FoodItemController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!}
						<div class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<h1 class="">Add Food to Inventory</h1>
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
								<div class="col-md-12 mb-3">
									<label class="form-label">Food Name<font color="red">*</font></label>
									{{ Form::text('foodName', '',['class' => 'form-control', 'placeholder' => 'Food Name', 'required'] )}}
								</div>
								{{-- <div class="col-md-4 mb-3">
                                    <label class="form-label">Item Price (Php)<font color="red">*</font></label>
									{{ Form::number('price', '',['class' => 'form-control', 'placeholder' => 'Item Price' , 'type' => 'number' , 'min' => 1 , 'step' => 0.01, 'required'] )}}
								</div> --}}
								<div class="col-md-6 mb-3 ">
									<label class="form-label">Unit Cost (Php)<font color="red">*</font></label>
									{{ Form::number('unit_cost', '',['class' => 'form-control', 'placeholder' => 'Unit Cost' , 'type' => 'number' , 'min' => 1 , 'step' => 0.01, 'required'] )}}
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Unit Expense (Php)<font color="red">*</font></label>
									{{ Form::number('unit_expense', '',['class' => 'form-control', 'placeholder' => 'Unit Expense' , 'type' => 'number' , 'min' => 1 , 'step' => 0.01, 'required'] )}}
								</div>
								<div class="col-md-12">
									{{-- <button name="image">Upload Item Image</button> --}}
									<input type="file" class="form-control" name="image" required>
								</div>
								
								{{-- <div class="col-md-12 mb-3">
									<button class="btn btn-sm btn-block btn-success" type="button" id="more_fields" onclick="add_a_row();" value="" class="btn btn-secondary">+ Add Ingredient</button>
								</div> --}}

								<div class="table-responsive mb-2" >
								
									
								{{-- <table class="table  align-items-center table-hover  mb-3" id="myTable" >
											<thead>
												<tr>
													<th>Question</th>
													<th>Answer</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
											<tr>
												<td>
												<input type="text" name="itemName" placeholder="Item Name"  id="item_name1" class="form-control">
												</td>
												<td>
													<input type="number" name="qty" placeholder="Item Quantity"  id="item_qty1" class="form-control">
												</td>
												<td>
													<button > hi</button>
												</td>
											</tr>
											</tbody>
										</table> --}}
								</div>
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
	// function getSelected(){

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
		// }

		// assign onclick handlers to the buttons
		// document.getElementById('showVal').onclick = function () {
		// 	el.value = sel.value;    
		// }
	// }
	// $('#selectField').change(function(){
    // if($('#selectField').val() == 'N'){
    //     $('#secondaryInput').hide();
    // } else {
    //     $('#secondaryInput').show();
	// }
	// });

    // function add_fields() {    
    //     document.getElementById("myTable").insertRow(-1).innerHTML = 
    //     '<tr><td><input class="form-control" name="ingredientName" placeholder="Question" th:field="${questionAnswerSet.question}"></textarea></td><td><input class="form-control" name="quantity" placeholder ="Answer" field="${questionAnswerSet.answer}"></textarea></td ><td><input class="form-control" name="price" placeholder="Price" disabled></td></tr>';
    // }

	// 	var trArray = [];
	// 	$('#tbPermission tr').each(function () {
	// 		var tr =$(this).text();  //get current tr's text
	// 		var tdArray = [];
	// 		$(this).find('td').each(function () {
	// 			var td = $(this).text();  //get current td's text
	// 			var items = {}; //create an empty object
	// 			items[tr] = td; // add elements to object 
	// 			tdArray.push(items); //push the object to array
	// 		});    
	// 	});
</script>
