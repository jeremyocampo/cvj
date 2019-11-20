
@extends('layouts.inventoryApp')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-8 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header border-0">
								<div class="row align-items-center">
									<div class="col">
										<h3 class="mb-0">Replenish Inventory</h3>
									</div>
									<div class="col alight-items-right">
										<h4>Last Replenished: {{$items[0]->last_modified}}</h4>
									</div>
								</div>
								{{-- <div class="row alight-items-right">
									<h4>Last Replenished: {{$items[0]->last_modified}}</h4>
								</div> --}}
						</div>
						<div class="card-body border-0">
								@foreach($errors->all() as $error)
								<div class="alert alert-danger" role="alert">
									<button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
										{{ $error }}<br>
								</div>
								@endforeach
							
							{!! Form::open(['action' => ['InventoryController@update', $items[0]->inventory_id], 'method' => 'POST', 'autocomplete' => 'off']) !!}
							{{-- {{ Form::model($item, array('route' => array('inventory.update', $item->itemId), 'method' => 'PUT')) }} --}}
							<div class="col-md-12"></div>
							<div class="row">
								
								<div class="col-md-12 mb-3">
									<label class="form-label">Item Name</label>
									<h3>{{ $items[0]->itemName }}</h3>
									{{ Form::hidden('itemName', $items[0]->itemName, ['class' => 'form-control', 'placeholder' => 'Item Name' ] )}}
								</div>
								<div class="col-md-12 mb-3">
									<label class="form-label">Category</label>
									<h3>{{ $category[0]->category_name }}</h3>
									{{ Form::hidden('category', $items[0]->category, ['class' => 'form-control', 'placeholder' => 'Category', 'type' => 'number'] )}}
								</div>
								{{ Form::hidden('source', $items[0]->source, [ 'type' => 'number'] )}}
								{{ Form::hidden('subcategory', $items[0]->subcategory, [ 'type' => 'number'] )}}
								{{ Form::hidden('threshold', $items[0]->threshold, [ 'type' => 'number'] )}}
								{{ Form::hidden('status', $items[0]->status, [ 'type' => 'number'] )}}
								
								{{-- <div class="col-md-12 mb-3">
										<label class="form-label">Category</label>
										<select id="category" name="category" class="form-control" placeholder="Category" required>
												<option>-</option>
												@foreach ($categories as $category)
													<option value="{{ $category->categoryId }}">{{ $category->categoryName }}</option>
												@endforeach 
										</select>
								</div> --}}
								<div class="col-md-12 mb-3">
									<label class="form-label">Replenish Quantity</label>
									<div class="row">
									{{-- <div class="col-md-4">
									<p>Current Quantity</p>
									</div> --}}
									<div class="col-md-4">
									{{-- {{ Form::number('quantity', '',['class' => 'form-control', 'placeholder' => 'Quantity to be Replenished', 'id' => 'qty', 'onkeyup' => 'getTotal()'] )}} --}}
										<input type="number" class="form-control" id="qty" onkeyup="getTotal()" placeholder="Quantity" required>
										<input type="number" class="form-control" name
									</div>
									<div class="col-md-4">
											
									</div>
									</div>
								</div>
								<div class="col-md-12 mb-3">
										<table class="table align-items-center table-striped" id="myTable">
											<thead>
												<tr>
													<th>Current Quantity</th>
													<th>Quantity to be Replenished</th>
													<th>New Total</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><p>	{{ $items[0]->quantity}} </p>
														<input type="hidden" id="curQty" value={{ $items[0]->quantity}}>
													</td>
													<td><span id="inpQty"></span></td>
													<td><b><span id="total"></span></b></td>
												</tr>
											</tbody>
										</table> 
									</div>
				
				{{-- <div class="col-md-12 mb-3">
						{{ Form::submit('Replenish Item', ['class' => 'btn btn-success']) }}
				</div> --}}
							</div>
						</div>
						<div class="card-footer text-muted">
								<div class="text-right">
										{{ Form::submit('Replenish Item', ['class' => 'btn btn-success']) }}
										<a href="{{ url('inventory')}}" class="btn btn-default">Back</a>
										{{Form::hidden('_method', 'PUT')}}
								</div>
						</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection
<script>
	// function getTotal(){
	// 	var input = document.getElementById('qty').value;
	// 	var output = document.getElementById('inpQty');
	// 	output.value = input;
	// 	var current = document.getElementById('curQty').value;
	// 	var total = current+input;
	// 	document.getElementById('total').value = total;
	// }

	// $('input').on('keyup input', function () {
	// var actualQty = Number($("#curQty").val().trim());
	// var newQty = Number($("#qty").val().trim());
	// // var shipping = Number($("#shipping").val().trim());

	// var sum = (actual + newQty);
	// var result = sum;
	
	// $("#inpQty").val(result.toFixed(2));

	// });
	function getTotal(){
		var y = document.getElementById("curQty").value;
		var z = document.getElementById("qty").value;

		var x = parseInt(y) + parseInt(z);
		document.getElementById('inpQty').innerHTML = z;
		document.getElementById("total").innerHTML = x;
	}
</script>