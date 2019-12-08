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
										<h1 class="">Add Item to Inventory</h1>
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

                                @if(session()->has('warning'))
                                    <br>
                                    <div class="alert alert-warning" role="alert">
                                        <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                        {{ session()->get('warning') }}<br>
                                    </div>
                                @endif
							
							<div class="row">
<<<<<<< HEAD
								<div class="col-md-12 mb-3">
									<label class="form-label">Inventory Name</label>
									{{ Form::text('inventory_name', '',['class' => 'form-control', 'placeholder' => 'Inventory Name'] )}}
=======
								<div class="col-md-9 mb-3">
									<label class="form-label">Item Name</label>
									{{ Form::text('itemName', '',['class' => 'form-control', 'placeholder' => 'Item Name'] )}}
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
								</div>
								<div class="col-md-3 mb-3"></div>
								<div class="col-md-3 mb-3">
										<label class="form-label">Category</label>
										<select id="category" name="category" class="form-control" placeholder="Category" onchange="filterDropdown()" required>
												<option value = 0 selected disabled>Please Select a Category</option>
												@foreach ($categories as $category)
													<option id="category-{{$category->category_no}}" value="{{ $category->category_no }}">{{ $category->category_name }}</option>
												@endforeach
										</select>
								</div>
								<div class="col-md-3 mb-3">
									<label class="form-label">Color</label>
									<select id="color" name="color" class="form-control" placeholder="Color" required>
											<option value = 0 selected disabled>Please Select a Color</option>
											@foreach ($colors as $color)
												<option id="category-{{ $color->color_id }}" value="{{ $color->color_id }}">{{ $color->color_name}}</option>
											@endforeach
									</select>
								</div>
								<div class="col-md-3 mb-3">
									<label class="form-label">Size</label>
<<<<<<< HEAD
									<select id="color" name="size" class="form-control" placeholder="Size" required>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->size_id }}" id="size">{{ $size->size_name }}</option>
                                        @endforeach
                                    </select>
								</div>
								<div class="col-md-3 mb-3"></div>
=======
									<select id="color" name="Size" class="form-control" placeholder="Size" required>
											<option value = 0 selected disabled>Please Select a Size</option>
											<option value=1>Small</option>
											<option value=2>Medium</option>
											<option value=3>Large</option>
											<option value=4>Extra Large</option>
									</select>
								</div> 
								<!-- test test -->
								{{-- <div class="col-md-6 mb-3">
										<label class="form-label">Sub-Category</label>
										<select id="subcategory" name="subcategory" class="form-control" placeholder="Sub-Category" required>
												<option value = 0 selected disabled>Please Select a Category</option>
												{{$items[] = array()}}
													@foreach($subcategories as $subcategory)
														{{$items[] = $subcategory->subcategory}}
													@endforeach
												<input type="hidden" value="{{$items}}" id="hiddenArray">
												@foreach ($subcategories as $subcategory)
													
													<option id="subcategory-{{$subcategory->category_no}}" value="{{ $subcategory->subcategory }}">{{ $subcategory->subcategory_name }}</option>
													
												@endforeach             
												@foreach ($subcategories as $subcategory)
													<option id="category-{{$subcategory->subcategory}}" value="{{ $subcategory->subcategory }}">{{ $subcategory->subcategory_name }}</option>
												@endforeach
										</select>
								</div> --}}
								
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
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
                                <div class="col-md-4">
                                    <label>
                                        Shelf Life
                                    </label>
                                    <input type="text" class="form-control" name="shelf_life" placeholder="Shelf Life" required />
                                </div>
                                <div class="col-md-4">
                                    <label>Returnable Item</label>
                                    <select class="form-control" name="returnable_item" required>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Suppliers</label>
                                    <select class="form-control" name="supplier_id" required>
                                        @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
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
