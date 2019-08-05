
@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	
<div class="row">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						{{-- {!! Form::open(['action' => 'InventoryController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!} --}}
						<div class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<h1 class="">Approve/Decline Pending Events</h1>
									</div>
									<div class="col-md-4">
											<div align="right">
													<input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
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
								<div class="col-md-12 mb-3">
									<iframe src="https://calendar.google.com/calendar/embed?src=cvjcatering.info%40gmail.com&ctz=Asia%2FManila" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
								</div>
								<div class="table-responsive mb-2" >
									{{-- <div class="row"> --}}
									<!-- Projects table -->
									<table class="table table-bordered align-items-center  mb-3" id="myTable" >
										<thead class="thead-light">
											<tr>
												<th>Event Name</th>
												<th>Venue</th>
												<th>Start Date/Time</th>
												<th>End Date/Time</th>
												<th>Description</th>
												<th>Status</th>
												<th >Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($pendingEvents as $i)
											{{-- @if($i->status > 0) --}}
											<tr>
												<td> {{ $i->event_name }}</td>
												<td> {{ $i->venue }}</td>
												<td>
													{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a') }}
												</td>
												<td>
													 {{ Carbon\Carbon::parse($i->event_end)->format('F j, Y g:i a') }}
												</td>
												<td> {{ $i->event_detailsAdded }}</td>
												<td> {{ $i->status_name }} </td>
												<td class="popup">
													<div class="dropdown">
														<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
															Action
														</button>
														<div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
															<div class=" dropdown-header noti-title">
																<h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
															</div>
															<div class="dropdown-divider"></div>
																<a href="{{ url('events/'.$i->event_id) }}" class="dropdown-item">
																	<i class="ni ni-zoom-split-in"></i>
																	<span>{{ __('View Event Details') }}</span>
																</a>
			
															<a href="{{ url('inventory/create')}}" class="dropdown-item">
																<i class="ni ni-fat-add"></i>
																<span>{{ __('Purchse Inventory') }}</span>
																
															</a>
															
															<a href="" class="dropdown-item" onclick="event.preventDefault();
																document.getElementById('delete-form-{{ $i->event_id }}').submit();">
																<i class="ni ni-fat-remove"></i>
																<span>{{ __('Remove from Inventory') }}</span>
																{!! Form::open(['action' => ['InventoryController@destroy', $i->event_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->event_id]) !!}
																	{{ Form::hidden('_method','DELETE')}}
																{!! Form::close() !!}
															</a>
														</div>
													</div>
													{{-- <a class="btn btn-sm btn-primary" href="inventory/{{ $i->itemId }}/edit"> Replenish Item </a> mahaba--}} 
												</td>
											</tr>
											{{-- @endif --}}
											@endforeach
										</tbody>
									</table>
							</div>




						</div>
						<div class="card-footer text-muted">
								<div id="pageNavPosition" style="padding-top: 20px; cursor: pointer;" align="center"></div>
								<script type="text/javascript">
									<!--
									var pager = new Pager('myTable', 5);
									pager.init();
									pager.showPageNav('pager', 'pageNavPosition');
									pager.showPage(1);
								</script>
							<div class="text-right">
								
								
								{{-- {{Form::hidden('_method', 'PUT')}} --}} 
							</div>
						</div>
					{{-- {!! Form::close() !!} --}}
				</div>
			</div>

			
		</div>
		
		

	</div>

	<div class="card-body">
			<div class="col-xl-12 mb-5 mb-xl-0">
					<div class="card shadow">
						<div class="card-header">
							<div class="row align-items-center">
									<div class="col-md-8">
										<h1 class="">Upcoming Approved Events</h1>
									</div>
									<div class="col-md-4">
										<div align="right">
											<input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
										</div>
									</div>
								</div>
								
						</div>
						<div class="card-body border-0">
								<div class="table-responsive mb-2" >
										{{-- <div class="row"> --}}
										<!-- Projects table -->
										<table class="table table-bordered align-items-center  mb-3" id="myTable1" >
											<thead class="thead-light">
												<tr>
													<th>Event Name</th>
													<th>Venue</th>
													<th>Start Date/Time</th>
													<th>End Date/Time</th>
													<th>Description</th>
													<th>Status </th>
													<th >Action</th>
												</tr>
											</thead>
											<tbody>
												@foreach ($events as $i)
												{{-- @if($i->status > 0) --}}
												<tr>
													<td> {{ $i->event_name }}</td>
													<td> {{ $i->venue }}</td>
													<td>
														{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a') }}
													</td>
													<td>
														 {{ Carbon\Carbon::parse($i->event_end)->format('F j, Y g:i a') }}
													</td>
													<td> {{ $i->event_detailsAdded }}</td>
													<td> {{ $i->status_name }}</td>
													<td class="popup">
														<div class="dropdown">
															<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
																Action
															</button>
															<div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
																<div class=" dropdown-header noti-title">
																	<h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
																</div>
																<div class="dropdown-divider"></div>
																	<a href="{{ url('events/'.$i->event_id) }}" class="dropdown-item">
																		<i class="ni ni-zoom-split-in"></i>
																		<span>{{ __('View Event Details') }}</span>
																	</a>
				
																<a href="{{ url('inventory/create')}}" class="dropdown-item">
																	<i class="ni ni-fat-add"></i>
																	<span>{{ __('Purchse Inventory') }}</span>
																	
																</a>
																
																<a href="" class="dropdown-item" onclick="event.preventDefault();
																	document.getElementById('delete-form-{{ $i->event_id }}').submit();">
																	<i class="ni ni-fat-remove"></i>
																	<span>{{ __('Remove from Inventory') }}</span>
																	{!! Form::open(['action' => ['InventoryController@destroy', $i->event_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->event_id]) !!}
																		{{ Form::hidden('_method','DELETE')}}
																	{!! Form::close() !!}
																</a>
															</div>
														</div>
														{{-- <a class="btn btn-sm btn-primary" href="inventory/{{ $i->itemId }}/edit"> Replenish Item </a> mahaba--}} 
													</td>
												</tr>
												{{-- @endif --}}
												@endforeach
											</tbody>
										</table>
						</div>
						<div class="card-footer text-muted">
								<div id="pageNavPosition" style="padding-top: 20px; cursor: pointer;" align="center"></div>
                            <script type="text/javascript">
                                <!--
                                var pager = new Pager('myTable1', 5);
                                pager.init();
                                pager.showPageNav('pager', 'pageNavPosition');
                                pager.showPage(1);
                            </script>
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
	function getSelected(){

	}
	$('#selectField').change(function(){
	if($('#selectField').val() == 'N'){
		$('#secondaryInput').hide();
	} else {
		$('#secondaryInput').show();
	}
	});


</script>
<script>
	$('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');

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
