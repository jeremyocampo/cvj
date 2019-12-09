
@extends('layouts.inventoryApp')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-8 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header">
                            {!! Form::open(['action' => 'InventoryController@return', 'method' => 'POST']) !!}
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="mb-0">Return Inventory</h1>
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            <div class="custom-control custom-checkbox">
                                                <label class="form-label">Status</label> <label class="text-muted">(optional)</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option selected disabled value=0>Please Select a status</option>
                                                    <option value="1">Mark as Lost</option>
                                                    <option value="2">Mark as Damaged</option>
                                                </select>
                                            </div>
                                        </div>
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
							
							
							{{-- {{ Form::model($item, array('route' => array('inventory.update', $item->itemId), 'method' => 'PUT')) }} --}}
							<div class="row">
								<div class="col-md-12 mb-3">
									<label class="form-label">Item Name</label>
									{{-- <h3>{{ $items[0]->itemName }}</h3> --}}
									{{ Form::hidden('itemName', '', ['class' => 'form-control', 'placeholder' => 'Item Name' ] )}}
								</div>
								<div class="col-md-12 mb-3">
									<label class="form-label">Category</label>
									{{-- <h3>{{ $category[0]->categoryName }}</h3> --}}
									{{ Form::hidden('category', '', ['class' => 'form-control', 'placeholder' => 'Category', 'type' => 'number'] )}}
								</div>
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
                                <label class="form-label">Quantity</label>
                                <div class="row">
                                {{-- <div class="col-md-4">
                                <p>Current Quantity</p>
                                </div> --}}
                                <div class="col-md-4">
                                {{ Form::number('quantity', '',['class' => 'form-control', 'placeholder' => 'Quantity to be Replenished'] )}}
                                </div>
                                <div class="col-md-4">
                                       
                                </div>
                                </div>
                            </div>
                            
                            {{-- <div class="col-md-12 mb-3">
                                    {{ Form::submit('Replenish Item', ['class' => 'btn btn-success']) }}
                            </div> --}}
                        </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="text-right">
                                    {{ Form::submit('Return Item', ['class' => 'btn btn-success']) }}
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