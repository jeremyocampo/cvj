
@extends('layouts.inventoryApp')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
		{!! Form::open(['action' => ['InventoryController@update', $itemInfo->inventory_id], 'method' => 'POST']) !!}
            <input type="hidden" name="update_inventory" />
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
		  
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <div class="row">
					  <div >
				  		<h2 class="modal-title">Are you sure you want to continue?</h2>
					  </div>
				  
				  </div>
				  
				</div>
				{{-- <div class="modal-body">
				  <p>Some text in the modal.</p>
				</div> --}}
				<div class="modal-footer">
				  {{ Form::submit('Confirm Changes', ['class' => 'btn btn-success']) }}
				  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
				</div>
			  </div>
		  
			</div>
		  </div>

	<div class="card-body">
		<div class="col-xl-12">
				<div class="card shadow">
						<div class="card-header">

                            @if(session()->has('warning'))
                                <br>
                                <div class="alert alert-warning" role="alert">
                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                    {{ session()->get('warning') }}<br>
                                </div>
                            @endif

							<div class="row">
								<div class="col-xl-8 ">
									<h2 calss="mb-0">View Item Details</h2>
								</div>
								<div class="col-xl-4">
									<label class="text-muted">Date Created: {{$itemInfo->date_created}}</label>
								</div>
								<div class="col-xl-8 ">
								</div>
								<div class="col-xl-4">
									<div id="barcode-{!! $itemInfo->inventory_id !!}" value="{!! "toPrint-" . $itemInfo->inventory_id!!}">
										<a href="" class="dropdown-item" onclick="printContent('barcode-{{$itemInfo->inventory_id}}');" id="printBtn{{ $itemInfo->inventory_id }}">
											{!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$itemInfo->sku, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!}
										</a>
									</div>	
									{{-- {!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$itemInfo->sku, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!} --}}
								</div>
								<div class="col-xl-8">
								</div>
								<div class="col-xl-4">
										<label class="text-muted">SKU Number: &nbsp;</label>{{$itemInfo->sku}}
								</div>
								

								<div class="col-xl-6 mt-3">
									<h4>Item Name</h4>
									<h1 class="mb-0">{{$itemInfo->inventory_name}}</h1>
								</div>
								<div class="col-xl-3 mt-3"></div>
								<div class="col-xl-3 mt-3">
									<div class="col-md-12">
										<label class="form-label">Item Status</label>
										<select id="status" name="status" class="form-control" placeholder="Sub-Category" required>
											<option value=-1 disabled> Please Select a Status</option>
											@if($itemInfo=='0')
												<option value=0 selected>Disabled</option>
												<option value=1> Activate Item</option>
											@else
												<option value=0> Disable Item </option>
												<option value=1 selected> Active</option>
											@endif
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
							
							
							{{-- {{ Form::model($item, array('route' => array('inventory.update', $item->itemId), 'method' => 'PUT')) }} --}}
							<div class="row">
								<div class="col-md-6 mb-3">
									<label class="form-label">Item Name</label>
									{{-- <h3>{{ $itemInfo->itemName }}</h3> --}}
									{{ Form::text('inventory_name', $itemInfo->inventory_name, ['class' => 'form-control', 'placeholder' => 'Item Name' ] )}}
								</div>
								{{-- <div class="col-md-12 mb-3">
									<label class="form-label">Category</label>
									{{-- <h3>{{ $itemInfo->categoryName }}</h3> --}}
									{{--  --}}
								{{-- </div> --}} 
								<div class="col-md-6 mb-3">
										<label class="form-label">Category</label>
										<select id="category" name="category" class="form-control" placeholder="Category" required>
												<option disabled>Pleaase Select a Cetegory</option>
												@foreach ($categories as $category)
                                                    <option value="{{ $category->category_no }}" id="categoryBal" {{ $category->category_no === $itemInfo->category ? "Selected" : "" }}>{{ $category->category_name }}</option>
												@endforeach 
										</select>
										{{ Form::hidden('categoryVal', $itemInfo->category, ['class' => 'form-control', 'placeholder' => 'Category'] )}}
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Color</label>
									<select id="color" name="color" class="form-control" placeholder="Color" required>
										<option disabled>Please Select a Color</option>
											@foreach ($colors as $color)
                                                <option value="{{ $color->color_id }}" id="color" {{ $color->color_id === $itemInfo->color ? "Selected" : ""  }}>{{ $color->color_name }}</option>
											@endforeach 
									</select>
<<<<<<< HEAD
=======
									{{ Form::hidden('categoryVal', $itemInfo[0]->category, ['class' => 'form-control', 'placeholder' => 'Category'] )}}
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Size</label>
									<select id="size" name="size" class="form-control" placeholder="Size" required>
										<option disabled>Please Select a Size</option>
											@foreach ($sizes as $size)
													<option value="{{ $size->size_id }}" id="size" {{ $size->size_id == $itemInfo->size ? "Selected" : "" }} >{{ $size->size_name }}</option>
											@endforeach 
									</select>
<<<<<<< HEAD
								</div>
=======
									{{ Form::hidden('categoryVal', $itemInfo[0]->category, ['class' => 'form-control', 'placeholder' => 'Category'] )}}
								</div>
								{{ Form::hidden('source', $itemInfo[0]->itemSource, ['class' => 'form-control', 'placeholder' => 'Category'] )}}
								{{-- <div class="col-md-4">
								<p>Current Quantity</p>
								</div> --}}
>>>>>>> 8014dcfb69bdaf0569c5cb6a3da6a8581c79d997
								<div class="col-md-3">
									<label class="form-label">Quantity</label>
									{{ Form::number('quantity', $itemInfo->quantity,['class' => 'form-control', 'placeholder' => 'Current Quantity'] )}}
								</div>
								<div class="col-md-3 mb-3">
										<label class="form-label">Threshold</label>
									{{ Form::number('threshold', $itemInfo->threshold,['class' => 'form-control', 'placeholder' => 'Item Threshold'] )}}
								</div>
								<div class="col-md-3 mb-3">
									<label class="form-label">Item Price (Php)</label>
									{{ Form::number('price', $itemInfo->price,['class' => 'form-control', 'placeholder' => 'Item Price' , 'type' => 'number' , 'min' => 1 , 'step' => 0.01] )}}
								</div>
                                <div class="col-md-4">
                                    <label>
                                        Shelf Life
                                    </label>
                                    <input type="text" class="form-control" value="{{ $itemInfo->shelf_life }}" name="shelf_life" placeholder="Shelf Life" required />
                                </div>
                                <div class="col-md-4">
                                    <label>Returnable Item</label>
                                    <select class="form-control" name="returnable_item" required>
                                        <option value="Yes" {{ $itemInfo->returnable_item === "Yes" ? "Selected" : "" }}>Yes</option>
                                        <option value="No" {{ $itemInfo->returnable_item === "No" ? "Selected" : "" }}>No</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Suppliers</label>
                                    <select class="form-control" name="supplier" required>
                                        <option value="">-- Select Supplier --</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->supplier_id }}" {{ $supplier->supplier_id == $itemInfo->supplier_id ? "Selected" : ""  }}>{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
					
					</div>
				</div>
				<div class="card-footer text-muted">
						<div class="text-right">
								<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Save</button>
								<a href="{{ url('inventory')}}" class="btn btn-default">Back</a>
								<a href="" class="btn btn-primary" onclick="printContent('barcode-{{ $itemInfo->inventory_id }}');" id="printBtn{{ $itemInfo->inventory_id}}">
									<i class="ni ni-single-copy-04"></i>
									<span>{{ __('Print Barcode') }}</span>
								</a>
								{{Form::hidden('_method', 'PUT')}}
						</div>
				</div>
			</div>
		</div>				
		{!! Form::close() !!}
		</div>
    </div>
@endsection


@push('js')
    <script>

        function printContent(el){
            let body = $('body');

            let restorepage = body.html();
            let printcontent = $('#' + el).clone();

            body.empty().html(printcontent);
            window.print();

            body.html(restorepage);
            document.location.reload(true);

        }
    </script>
@endpush
