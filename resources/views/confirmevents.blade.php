
@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						{{-- {!! Form::open(['action' => 'ConfirmEventsController@update', 'method' => 'POST', 'autocomplete' =>'off']) !!} --}}
						<div class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<h1 class="">Confirm Events</h1>
									</div>
									<div class="col-md-4">
											{{-- <label class="form-label">Item Source</label> --}}
											<div align="right">
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
                                
                                @if(session()->has('success'))
                                    <br>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                        {{ session()->get('success') }}<br>
                                    </div>
                                @endif
								<div>
									<iframe src="https://calendar.google.com/calendar/embed?src=cvjcatering.info%40gmail.com&ctz=Asia%2FManila" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
								</div>
								<div class="table-responsive mb-3">
									<!-- Projects table -->
									
									<table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
										<thead class="thead-light">
											<tr>
												{{-- <th>Event ID</th> --}}
												<th>Event Name</th>
												<th>Venue</th>
												<th>Event Type</th>
												<th>Event Date</th>
												{{-- <th>Description</th> --}}
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach ($eventdetails as $i)
                                            {{-- @if($i->status > 0) --}}
                                            
											<tr>
												{{-- <td> {{ $i->id}}</td> --}}
												<td> {{ $i->event_name }}</td>
												<td> {{ $i->venue }}</td>
												<td> {{ $i->event_type }}</td>
												<td> {{ $i->event_start }}</td>
											{{-- <td> {{ $i->description }}</td> --}}
												<td>
													
                                                <button class="btn btn-success" data-toggle="modal" data-target="#approve-modal" value="{{$i->event_id}}" onclick="getevent(this)"> Approve</button>
												<button class="btn btn-danger" data-toggle="modal" data-target="#decline-modal" value="{{$i->event_id}}"  onclick="getevent(this)"> Decline </button>
												</td>
											</tr>
											{{-- @endif --}}
											@endforeach
										</tbody>
									</table>
								</div>
                                {!! Form::open(['action' => 'ConfirmEventsController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!}
                                <input type="hidden" id="eventIDa" name="eventA">
								<div class="modal fade" id="approve-modal">
										<div class="modal-dialog">
										  <div class="modal-content">
											<div class="modal-header">
												<h2 class="modal-title" text-align: center><b>Add Deposit</b></h2>
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											  
                                            </div>
                                            
											<div class="modal-body">
												<div class="box-body">
				
												  <div class="form-group">
													<label > <h3>  Amount </h3> </label> 
													{{ Form::number('amount', '', ['class' => 'form-control', 'placeholder' => '0.00', 'step'=>'0.01', 'min'=>'20000','required' => 'true'])}}
													
                                                  </div> 
                                                  <div class="form-group">
                                                        <label > <h3>  Upload Payment Reciept </h3> </label> 
                                                        <br>
                                                         {{-- {!! Form::file('reciept') !!} --}}
                                                         <input type="file" name="receipt">
                                                </div>
												</div>
				
				
												<div class="modal-footer">
                                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                  
                                                  {{-- <input type="submit" value="approve" name="approve">Submit</button> --}}
                                                  {{-- {{ Form::submit('Confirm', ['class' => 'btn btn-success']) }} --}}
                                                  <input type="submit" class="btn btn-md btn-success" value="Approve" name="approve" id = "approve">
												</div>
											  
											</div>
										  </div>
										</div>
									  </div>
                                      {!! Form::close() !!}


                                      {!! Form::open(['action' => 'ConfirmEventsController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!}
                                      <input type="hidden" id="eventIDd" name="eventD">
									  <div class="modal fade" id="decline-modal">
                                          
											<div class="modal-dialog">
											  <div class="modal-content">
												<div class="modal-header">
													<h2 class="modal-title" text-align: center><b>Reason for Declining Event</b></h2>
												  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												  </button>
												  
												</div>
												<div class="modal-body">
												 	<div class="box-body">
					
													  <div class="form-group">
														{{ Form::textarea('reason', '', ['class' => 'form-control', 'placeholder' => 'Input reason here', 'required' => 'true'])}}
													</div> 
					
													</div>
					
					
													<div class="modal-footer">
                                                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                       <input type="submit" class="btn btn-md btn-danger"  value="Decline" name="decline" id = "decline">
													</div>
												  
												</div>
											  </div>
											</div>
										  </div>



						</div>
						<div class="card-footer text-muted">
							
							<div class="text-right">
								
								
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
    function getevent(obj){
        var event = $(obj).attr('value');
        // alert(event);
        document.getElementById('eventIDa').value = event;
        document.getElementById('eventIDd').value = event;

        // $("eventID").val(event);   
        
    // alert(document.getElementById('eventID').value, ' YES');

    } 

</script>
