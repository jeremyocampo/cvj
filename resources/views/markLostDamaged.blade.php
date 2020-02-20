
@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
            <a href="{{ url('inventory')}}" class="btn btn-secondary mb-5">Go to View Inventory</a>
            <a href="{{ url('deploy')}}" class="btn btn-secondary mb-5">Go to Deploy Inventory</a>
            <a href="{{ url('return')}}" class="btn btn-secondary mb-5">Go to Return Inventory</a>
				<div class="card shadow">
						<div class="card-header">
                            {{-- {!! Form::open(['action' => 'InventoryController@return', 'method' => 'POST']) !!} --}}
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="mb-0">Unreported Mark as Lost/Damaged</h1>
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            {{-- <div class="custom-control custom-checkbox">
                                                <label class="form-label">Status</label> <label class="text-muted">(optional)</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option selected disabled value=0>Please Select a status</option>
                                                    <option value="1">Mark as Lost</option>
                                                    <option value="2">Mark as Damaged</option>
                                                </select>
                                            </div> --}}
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
                                            @if(session()->has('deleted'))
                                                <br>
                                                <div class="alert alert-danger" role="alert">
                                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                                    {{ session()->get('deleted') }}<br>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="card-body">
                            <div class="table-responsive mb-3">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush" id="myTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Event Name</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Borrow Date/Time</th>
                                            {{-- <th scope="col">Return Date/Time</th> --}}
                                            <th scope="col">Event Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td>Jeremy's Birthday Bash</td>
                                            <td>CVJ Catering Ground Floor</td>
                                            <td>March 25, 2020</td>
                                            <td>March 25, 2020</td>
                                            <td>Complete</td>
                                            <td>
                                                <a href="{{url('returnInventory/1')}}" class="btn btn-small">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('Return Deployed Items') }}</span>
                                                </a>
                                            </td>
                                        </tr> --}}
                                        @foreach ($events as $i)
                                        @if($i->status == 5)
                                        <tr>
                                            <td>{{ $i->event_name }}</td>
                                            <td>{{ $i->venue }}</td>
                                            <td>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a') }}</td>
                                            {{-- <td>{{ Carbon\Carbon::parse($i->eevent_end)->format('F j, Y g:i a') }}</td> --}}
                                            <td>{{ $i->status_name}} </td>
                                            <td>
                                                <a class="" href="{{ url('markLostDamaged/'.$i->event_id) }}">
                                                    <button class="btn btn-block btn-sm"><i class="ni ni-zoom-split-in"></i> &nbsp; Report Reason</button>
                                                </a>
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
                                    {{-- <a href="{{ url('inventory')}}" class="btn btn-secondary">Back to View Inventory</a> --}}
                                    {{-- {{Form::hidden('_method', 'PUT')}} --}}
                            </div>
                        </div>
		        {{-- {!! Form::close() !!} --}}
		    </div>
		</div>
    </div>
    




    <div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header">
                            {{-- {!! Form::open(['action' => 'InventoryController@return', 'method' => 'POST']) !!} --}}
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="mb-0">Reported Mark as Lost/Damaged</h1>
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                            {{-- <div class="custom-control custom-checkbox">
                                                <label class="form-label">Status</label> <label class="text-muted">(optional)</label>
                                                <select class="form-control" name="status" id="status">
                                                    <option selected disabled value=0>Please Select a status</option>
                                                    <option value="1">Mark as Lost</option>
                                                    <option value="2">Mark as Damaged</option>
                                                </select>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{-- @if(session()->has('success'))
                                                <br>
                                                <div class="alert alert-success" role="alert">
                                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                                    {{ session()->get('success') }}<br>
                                                </div>
                                            @endif
                                            @if(session()->has('deleted'))
                                                <br>
                                                <div class="alert alert-danger" role="alert">
                                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                                    {{ session()->get('deleted') }}<br>
                                                </div>
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="card-body">
                            <div class="table-responsive mb-3">
                                <!-- Projects table -->
                                <table class="table align-items-center table-flush" id="myTable1">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Event Name</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Borrow Date/Time</th>
                                            {{-- <th scope="col">Return Date/Time</th> --}}
                                            <th scope="col">Event Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td>Jeremy's Birthday Bash</td>
                                            <td>CVJ Catering Ground Floor</td>
                                            <td>March 25, 2020</td>
                                            <td>March 25, 2020</td>
                                            <td>Complete</td>
                                            <td>
                                                <a href="{{url('returnInventory/1')}}" class="btn btn-small">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('Return Deployed Items') }}</span>
                                                </a>
                                            </td>
                                        </tr> --}}
                                        @foreach ($events as $i)
                                        @if($i->status >= 4)
                                        <tr>
                                            <td>{{ $i->event_name }}</td>
                                            <td>{{ $i->venue }}</td>
                                            <td>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y g:i a') }}</td>
                                            {{-- <td>{{ Carbon\Carbon::parse($i->eevent_end)->format('F j, Y g:i a') }}</td> --}}
                                            <td>{{ $i->status_name}} </td>
                                            <td>
                                                {{-- <a class="" href="{{ url('markLostDamaged/'.$i->event_id) }}">
                                                    <button class="btn btn-block btn-sm"><i class="ni ni-zoom-split-in"></i> &nbsp; Report Reason</button>
                                                </a> --}}
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
                                    {{-- <a href="{{ url('inventory')}}" class="btn btn-secondary">Back to View Inventory</a> --}}
                                    {{-- {{Form::hidden('_method', 'PUT')}} --}}
                            </div>
                        </div>
		        {{-- {!! Form::close() !!} --}}
		    </div>
		</div>
	</div>
</div>
@endsection

@push('js')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    {{-- DATA TABLES START --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href=". /resources/DataTables/datatables.min.css"/>
    <script type="text/javascript" src=". /resources/DataTables/datatables.min.js"></script>
    {{-- DATA TABLES END --}}

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "order":["2"]
            });
            $('#myTable1').DataTable({
                "order":["2"]
            });
        } );
    </script>

    {{-- <script>
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
    </script> --}}

    

@endpush
