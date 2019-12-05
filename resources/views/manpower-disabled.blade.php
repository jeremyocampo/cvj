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
                                    <h1 class="mb-0">Manpower List</h1>
                                </div>
                                <div class="col-xs-2">
                                    &nbsp;&nbsp;
                                </div>
                                <div class="col-xs-4">
                                    <a href="manpowers/create" class="btn btn-sm btn-primary"> + Add Item</a>
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
                                <th >Name</th>
                                {{-- <th >Stock Keeping Unit(SKU)</th> --}}
                                <th >Employee Type</th>
                                <th>Email</th>
                                <th>Agency</th>
                                <th >Contact No</th>
                                <th >Address</th>
                                <th >Time</th>
                                <th >Date</th>
                                <th >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($manpowers as $manpower)
                                <tr>

                                    <td>
                                        {{ $manpower->employee_ln . ", " . $manpower->employee_fn }}
                                    </td>
                                    <td>
                                        {{ $manpower->employee_type }}
                                    </td>
                                    <td>{{ $manpower->email }}</td>
                                    <td> {{ $manpower->agency->agency_name }}</td>
                                    <td>{{ $manpower->contact_no }}</td>
                                    <td>{{ $manpower->address }}</td>
                                    <td>{{ $manpower->schedule->time_from  . " - " . $manpower->schedule->time_to  }}</td>
                                    <td>{{ $manpower->schedule->schedule_date }}</td>
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
                                                <a href="{{ url('recover-manpower/'.$manpower->id) }}" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('Enable Manpower') }}</span>
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