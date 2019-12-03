@extends('layouts.app')

{{-- @include('layouts.headers.pagination') --}}

@section('content')
    @include('layouts.headers.inventoryCard')

    <div class="container-fluid mt--7">
        {{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
        <div class="col-xl-12 mb-5">
            <div class="card shadow " >
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-xs-5">
                                    <h1 class="mb-0">Schedule List</h1>
                                </div>
                                <div class="col-xs-2">
                                    &nbsp;&nbsp;
                                </div>
                                <div class="col-xs-4">
                                    <a href="schedules/create" class="btn btn-sm btn-primary"> + Add Item</a>
                                </div>
                            </div>
                        </div>
                        <div class="col text-right"> </div>
                        <div class="col text-left">
                            <div class="col-xs-5">
                                <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
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
                <div class="card-body">



                    <div class="table-responsive mb-3">
                        <!-- Projects table -->

                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                            <thead class="thead-light">
                            <tr>
                                <th >Schedule Name</th>
                                <th >Monday</th>
                                <th >Tuesday</th>
                                <th >Wednesday</th>
                                <th >Thursday</th>
                                <th >Friday</th>
                                <th >Saturday</th>
                                <th >Sunday</th>
                                <th>Availability</th>
                                <th >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>

                                    <td>
                                        {{ $schedule->shift_name }}
                                    </td>
                                    <td>{{ $schedule->monday_in_time }} - {{ $schedule->monday_out_time }}</td>
                                    <td>{{ $schedule->tuesday_in_time }} - {{ $schedule->tuesday_out_time }}</td>
                                    <td>{{ $schedule->wednesday_in_time }} - {{ $schedule->wednesday_out_time }}</td>
                                    <td>{{ $schedule->thursday_in_time }} - {{ $schedule->thursday_out_time }}</td>
                                    <td>{{ $schedule->friday_in_time }} - {{ $schedule->friday_out_time }}</td>
                                    <td>{{ $schedule->saturday_in_time }} - {{ $schedule->saturday_out_time }}</td>
                                    <td>{{ $schedule->sunday_in_time }} - {{ $schedule->sunday_out_time }}</td>

                                    <td>{{ $schedule->is_available === 0 ? "Not Available" : "Available" }}</td>
                                    <td class="popup">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                <div class=" dropdown-header noti-title">
                                                    <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('schedules/'.$schedule->id) }}" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('View Schedule Details') }}</span>
                                                </a>
                                                <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('delete-form-{{ $schedule->id }}').submit();">
                                                    <i class="ni ni-fat-remove"></i>
                                                    <span>{{ __('Delete Schedule') }}</span>
                                                    {!! Form::open(['action' => ['SchedulesController@destroy', $schedule->id], 'method' => 'POST', 'id' => 'delete-form-'.$schedule->id]) !!}
                                                    {{ Form::hidden('_method','DELETE')}}
                                                    {!! Form::close() !!}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div id="pageNavPosition" style="padding-top: 20px; cursor: pointer;" align="center"></div>
                    <script type="text/javascript">
                        <!--
                        var pager = new Pager('myTable', 5);
                        pager.init();
                        pager.showPageNav('pager', 'pageNavPosition');
                        pager.showPage(1);
                    </script>
                </div>
            </div>
            <!--pagination-->

            <!--pagination-->

        </div>


        {{-- <div class="col-xl-12 mb-5">
            <div class="card shadow " >
                    <div class="card-body">
                            <div class="table-responsive mb-3">
                                <!-- Projects table -->
                                <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">

                                </table>
                            </div>
                    </div>
            </div>
        </div> --}}
        {{--    @include('layouts.footers.auth')--}}
    </div>
@endsection

@push('js')
    <script>
        $('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');

        function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            document.location.reload(true);

        }
    </script>

@endpush
