
@extends('layouts.inventoryApp')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-10 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header">
								{!! Form::open(['action' => ['InventoryController@update', $itemInfo[0]->inventory_id], 'method' => 'POST']) !!}
								<div class="row">
									<div class="col-xl-8 ">
										<h2 calss="mb-0">View Item Details</h2>
									</div>
									<div class="col-xl-4">
										<label class="text-muted">Date Created: {{$itemInfo[0]->date_created}}</label>
									</div>
									<div class="col-xl-8 ">
									</div>
									<div class="col-xl-4">
										<div id="barcode-{!! $itemInfo[0]->inventory_id !!}" value="{!! "toPrint-" . $itemInfo[0]->inventory_id!!}">
                                            <a href="" class="dropdown-item" onclick="printContent('barcode-{{$itemInfo[0]->inventory_id}}');" id="printBtn{{ $itemInfo[0]->inventory_id }}">
												{!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$itemInfo[0]->sku, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!}
                                            </a>
                                        </div>	
										{{-- {!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$itemInfo[0]->sku, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!} --}}
									</div>
									<div class="col-xl-8">
									</div>
									<div class="col-xl-4">
											<label class="text-muted">SKU Number: &nbsp;</label>{{$itemInfo[0]->sku}}
									</div>
									

									<div class="col-xl-6 mt-3">
										<h4>Item Name</h4>
										<h1 class="mb-0">{{$itemInfo[0]->inventory_name}}</h1>
									</div>
									<div class="col-xl-3 mt-3"></div>
									<div class="col-xl-3 mt-3">
										<div class="col-md-12">
											<label class="form-label">Item Status</label>
											<select id="status" name="status" class="form-control" placeholder="Sub-Category" required>
												<option value=-1 disabled> Please Select a Status</option>
												@if($itemInfo[0]=='0')
													<option value=0 selected>Disabled</option>
													<option value=1> Activate Item</option>
												@else
													<option value=0>		  Disable Item </option>
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
									{{-- <h3>{{ $itemInfo[0]->itemName }}</h3> --}}
									{{ Form::text('itemName', $itemInfo[0]->inventory_name, ['class' => 'form-control', 'placeholder' => 'Item Name' ] )}}
								</div>
								{{-- <div class="col-md-12 mb-3">
									<label class="form-label">Category</label>
									{{-- <h3>{{ $itemInfo[0]->categoryName }}</h3> --}}
									{{--  --}}
								{{-- </div> --}} 
								<div class="col-md-6 mb-3">
										<label class="form-label">Category</label>
										<select id="category" name="category" class="form-control" placeholder="Category" required>
												<option disabled>Pleaase Select a Cetegory</option>
												@foreach ($categories as $category)
													@if ($category->category_no == $itemInfo[0]->category)
														<option value="{{ $category->category_no }}" id="categoryBal" selected>{{ $category->category_name }}</option>
													@else
														<option value="{{ $category->category_no }}" id="categoryBal" >{{ $category->category_name }}</option>
													@endif
												@endforeach 
										</select>
										{{ Form::hidden('categoryVal', $itemInfo[0]->category, ['class' => 'form-control', 'placeholder' => 'Category'] )}}
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Color</label>
									<select id="color" name="color" class="form-control" placeholder="Color" required>
										<option disabled>Pleaase Select a Color</option>
											@foreach ($colors as $color)
												@if ($color->color_id	 == $itemInfo[0]->color)
													<option value="{{ $color->color_id }}" id="color" selected>{{ $color->color_name }}</option>
												@else
													<option value="{{ $color->color_id }}" id="color" >{{ $color->color_name }}</option>
												@endif
											@endforeach 
									</select>
									{{ Form::hidden('categoryVal', $itemInfo[0]->category, ['class' => 'form-control', 'placeholder' => 'Category'] )}}
								</div>
								<div class="col-md-6 mb-3">
									<label class="form-label">Size</label>
									<select id="size" name="size" class="form-control" placeholder="Size" required>
										<option disabled>Pleaase Select a Size</option>
											@foreach ($sizes as $size)
												@if ($size->size_id == $itemInfo[0]->size)
													<option value="{{ $size->size_id }}" id="size" selected>{{ $size->size_name }}</option>
												@else
													<option value="{{ $size->size_id }}" id="size" >{{ $size->size_name }}</option>
												@endif
											@endforeach 
									</select>
									{{ Form::hidden('categoryVal', $itemInfo[0]->category, ['class' => 'form-control', 'placeholder' => 'Category'] )}}
								</div>
								{{ Form::hidden('source', $itemInfo[0]->itemSource, ['class' => 'form-control', 'placeholder' => 'Category'] )}}
								{{-- <div class="col-md-4">
								<p>Current Quantity</p>
								</div> --}}
								<div class="col-md-3">
									<label class="form-label">Quantity</label>
									{{ Form::number('quantity', $itemInfo[0]->quantity,['class' => 'form-control', 'placeholder' => 'Current Quantity'] )}}
								</div>
								<div class="col-md-3 mb-3">
										<label class="form-label">Threshold</label>
									{{ Form::number('threshold', $itemInfo[0]->threshold,['class' => 'form-control', 'placeholder' => 'Item Threshold'] )}}
								</div>
								<div class="col-md-3 mb-3">
									<label class="form-label">Item Price (Php)</label>
									{{ Form::number('price', $itemInfo[0]->price,['class' => 'form-control', 'placeholder' => 'Item Price' , 'type' => 'number' , 'min' => 1 , 'step' => 0.01] )}}
								</div>
					
					</div>
				</div>
				<div class="card-footer text-muted">
						<div class="text-right">
								{{ Form::submit('Save Changes', ['class' => 'btn btn-success']) }}
								<a href="{{ url('inventory')}}" class="btn btn-default">Back</a>
								<a href="" class="btn btn-primary" onclick="printContent('barcode-{{ $itemInfo[0]->inventory_id }}');" id="printBtn{{ $itemInfo[0]->inventory_id}}">
									<i class="ni ni-single-copy-04"></i>
									<span>{{ __('Print Barcode') }}</span>
								</a>
								{{Form::hidden('_method', 'PUT')}}
						</div>
				</div>
				{{-- <div class="col-md-12 mb-3">
						{{ Form::submit('Replenish Item', ['class' => 'btn btn-success']) }}
				</div> --}}
			</div>
		</div>				
		{!! Form::close() !!}
		</div>
		</div>
	</div>
</div>
@endsection


@push('js')
    <script>
        // $('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');

        function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            document.location.reload(true);
            
            // var restorepage = document.body.innerHTML;
            // var printcontent = document.getElementById().innerHTML;
            // document.body.innerHTML = printcontent;
            // window.print();
            // document.body.innerHTML = restorepage;
        }
    </script>
@endpush