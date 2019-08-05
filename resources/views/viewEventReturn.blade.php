@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
		{{-- {!! Form::open(['action' => ['ReturnInventoryController@update', $borrowedItems[0]->event_id], 'method' => 'POST']) !!} --}}
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
		  
			  <!-- Modal content-->
			  <div class="modal-content">
				<div class="modal-header">
				  <div class="row">
					  <div >
				  		<h2 class="modal-title">Are you sure you want to continue?</h4>
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
		<div class="col-xl-10 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header">
							<div class="row">
									<div class="col-xl-8 ">
										<h2 calss="mb-0">View Item Details</h2>
									</div>
									<div class="col-xl-4">
										<label class="text-muted">Event Name: {{$borrowedItems[0]->event_name}}</label>
									</div>
									<div class="col-xl-4">
										<label class="text-muted">Date Borrowed: {{$borrowedItems[0]->event_start}}</label>
									</div>
									<div class="col-xl-4">
										<label class="text-muted">Date Due: {{$borrowedItems[0]->event_end}}</label>
									</div>
									<div class="col-xl-4">
										<label class="text-muted">Date Due: {{$borrowedItems[0]->date_created}}</label>
									</div>
									<div class="col-xl-4">
										<label class="text-muted">Date Due: {{$borrowedItems[0]->date_created}}</label>
									</div>
									<div class="col-xl-4">
										
									</div>
								
						</div>
						<div class="card-body border-0">
							@foreach($errors->all() as $error)
							<div class="alert alert-danger" role="alert">
								<button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
									{{ $error }}<br>
							</div>
							@endforeach
                    	</div>
                    <div class="table-responsive mb-3">
                            <!-- Projects table -->
                            
                            <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Event Name</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Borrow Date/Time</th>
                                            <th scope="col">Return Date/Time</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($borrowedItems as $i)
                                        @if($i->status > 0)
                                        <tr>
                                            <td>{{ $i->event_name }}</td>
                                            <td>{{ $i->venue }}</td>
                                            <td>{{ $i->event_start }}</td>
                                            <td>{{ $i->event_end }}</td>
                                            <td>{{ $i->status_name}} </td>
                                            <td>
                                                <a class="" href="{{ url('returnInventory/'.$i->event_id) }}" >
                                                    
                                                    <button class="btn btn-block btn-sm"><i class="ni ni-zoom-split-in"></i> &nbsp; View Event Details</button>
                                                    {{-- <span>{{ __('View Event Details') }}</span> --}}
                                                </a>
                                                {{-- <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                        <div class=" dropdown-header noti-title">
                                                            <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                        </div>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="{{ url('returnInventory/'.$i->event_id) }}" class="dropdown-item">
                                                            <i class="ni ni-zoom-split-in"></i>
                                                            <span>{{ __('View Event Details') }}</span>
                                                        </a>
                                                        <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                            document.getElementById('delete-form-{{ $i->event_name }}').submit();">
                                                            <i class="ni ni-fat-remove"></i>
                                                            <span>{{ __('Remove from Inventory') }}</span>
                                                            {!! Form::open(['action' => ['InventoryController@destroy', $i->event_name], 'method' => 'POST', 'id' => 'delete-form-'.$i->inventory_id]) !!}
                                                                {{ Form::hidden('_method','DELETE')}}
                                                            {!! Form::close() !!}
                                                        </a>
                                                    </div>
                                                </div> --}}
                                            </td>
                                        </tr>
                                        
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
				</div>
				<div class="card-footer text-muted">
						<div class="text-right">
								<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Save</button>
								<a href="{{ url('returnInventory')}}" class="btn btn-default">Back</a>
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