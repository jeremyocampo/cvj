@extends('layouts.app')
@section('title', 'Costing Report')

{{-- @include('layouts.headers.pagination') --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" /> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js">


</script>

@section('content') 
    @include('layouts.headers.eventsCard')

    <div class="container-fluid mt--7">
            {{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
        <div class="col-xl-12 mb-5">
        <div class="card shadow " >
        <div class="card-header ">
        <div class="row align-items-center">
        <div class="col">
        <div class="row">

        <div class="col-xs-5">
             <h1 class="">Costing Report</h1>
        </div>
                                
        <div class="col-xs-2">
            &nbsp;&nbsp;
        </div>
                               
        </div>
        </div>
        </div>

            <div class="row">
            <div class="col-md-12">
                @if(session()->has('success'))
                    <br>
                    <div class="alert alert-success" role="alert">
                        <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                        {{ session()->get('success') }}<br>
                    </div>
                @endif
            </div>
            </div>
            <div class="container box">
                   {!! Form::open(['action' => 'DateRangeController@index', 'method' => 'POST', 'autocomplete' =>'off']) !!}
                    <div class="panel panel-default">
                     <div class="panel-heading">
                      <div class="row">
                       {{-- <div class="col-md-5">Sample Data - Total Records - <b><span id="total_records"></span></b></div> --}}
                       <div class="col-md-5">
                        <div class="input-group input-daterange">
                                &nbsp;<input type="date" name="from_date" id="from_date"  class="form-control" /> &nbsp;
                            <div>  &nbsp;  to   &nbsp; </div> 
                            &nbsp;<input type="date" name="to_date" id="to_date"  class="form-control" />  &nbsp;
                        </div>
                        <br>
                        <br>
                       </div>
                       <div class="col-md-2">
                        {{-- <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Generate</button> --}}
                        {{ Form::submit('Generate', ['class' => 'btn btn-info btn-sm', 'name'=>'filter ', 'id'=> 'filter']) }} 
                        {{-- <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button> --}}
                       </div>
                      </div>
                     </div>
                     <div class="panel-body">
                      <div class="table-responsive">
                            <div class="table-responsive mb-3">
									<!-- Projects table -->
									
									<table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
										<thead class="thead-light">
											<tr>
												{{-- <th>Event ID</th> --}}
												<th>Event Name</th>
												<th>Availed Package</th>
												<th>Expected Cost</th>
												<th>Actual Cost</th>
												{{-- <th>Description</th> --}}
												
											</tr>
										</thead>
										<tbody>
											@foreach ($eventdetails as $i)
                                            {{-- @if($i->status > 0) --}}
                                            
											<tr>
												{{-- <td> {{ $i->id}}</td> --}}
												<td> {{ $i->event_name }}</td>
												<td> {{ $i->package_name }}</td>
												<td> {{ $i->total_budget }}</td>
												<td> {{ $i->total_spent }}</td>
											{{-- <td> {{ $i->description }}</td> --}}
												
											</tr>
											{{-- @endif --}}
											@endforeach
										</tbody>
									</table>
                                    {!! Form::close() !!}
                      </div>
                     </div>
                    </div>
                   </div>

                   
                   <center><h4>--- END OF REPORT ---</h4></center>
                  </body>
                 </html>


                 @endsection

                {{-- <script>
                
                //  $(document).ready(function(){
                //     echo "{!! Form::open(['action' => 'DateRangeController@index', 'method' => 'POST']) !!}";
                //   var date = new Date();
                 
                //   $('.input-daterange').datepicker({
                //    todayBtn: 'linked',
                //    format: 'yyyy-mm-dd',
                //    autoclose: true
                //   });
                 
                //   var _token = $('input[name="_token"]').val();
                 
                //   fetch_data();
                 
                //   function fetch_data(from_date = '', to_date = '')
                //   {
                //    $.ajax({
                //     url:"{{ route('daterange.fetch_data') }}",
                //     method:"POST",
                //     data:{from_date:from_date, to_date:to_date, _token:_token},
                //     dataType:"json",
                //     success:function(data)
                //     {
                //      var output = '';
                //     //  $('#total_records').text(data.length);
                //     echo '@foreach($event as $event)';
                //      for(var count = 0; count < data.length; count++)
                //      { 
                //       output += '<tr>';
                //       output += '<td>' + data[count].echo'{{$event->event_name}}' + '</td>';
                //       output += '<td>' + data[count].echo'{{$event->package_name}}' + '</td>';
                //       output += '<td>' + data[count].echo'{{$event->total_budget}}'  + '</td></tr>';
                //       output += '<td>' + data[count].echo'{{$event->total_spent}}'  + '</td></tr>';
                     
                //      }
                //      echo '@endforeach';

                //      $('tbody').html(output);
                //     }
                //    })
                //   }
                 
                //   $('#filter').click(function(){
                //    var from_date = $('#from_date').val();
                //    var to_date = $('#to_date').val();
                //    if(from_date != '' &&  to_date != '')
                //    {
                //     fetch_data(from_date, to_date);
                //    }
                //    else
                //    {
                //     alert('Both Date is required');
                //    }
                //   });
                 
                //   $('#refresh').click(function(){
                //    $('#from_date').val('');
                //    $('#to_date').val('');
                //    fetch_data();
                //   });
                 
                 
                //  });

                //  echo '{!! Form::close() !!} ';
                 </script> --}}