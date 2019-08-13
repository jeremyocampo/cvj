@extends('layouts.app')

{{-- @include('layouts.headers.pagination') --}}

@section('content')
    @include('layouts.headers.inventoryCard')

    <div class="container-fluid mt--7">
            {{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
           


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
                    <div class="col-xl-12 mb-5">
                        <div class="card shadow " >
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h1 class="mb-0">Outsource Requests</h1> 
                                            </div>
                                            {{-- <div class="col-xs-4">
                                                <a href="outsource/create" class="btn btn-sm btn-primary"> + Generate Outsource Request</a>
                                            </div>              --}}
                                        </div>
                                    </div>
                                   
                                    <div class="col text-left">
                                       
                                            <div class="col-xs-5">
                                                <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
            
                                        <div class="card-body">
        
                            
        
                            <div class="table-responsive mb-3">
                                <!-- Projects table -->
                                
                                <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Event Name</th>
                                            <th >Supplier Name</th>
                                            <th >Item name</th>
                                             <th >Quantity</th>
                                            <th >Status</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($outsource as $b)
                                        <tr>
                                            <td scope="col">{{ $b->event_name }}</td> 
                                            <td scope="col">{{ $b->name }}</td>
                                            <td scope="col">{{ $b->item_name }}</td>
                                            <td scope="col">{{ $b->quantity }}</td>
                                            <td scope="col">{{ $b->status }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                        <div class=" dropdown-header noti-title">
                                                            <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                        </div>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="{{ url('outsource/'.$b->sku) }}" class="dropdown-item">
                                                            <i class="ni ni-zoom-split-in"></i>
                                                            <span>{{ __('View Outsource Details') }}</span>
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
                                    
                                    var pager = new Pager('myTable', 5);
                                    pager.init();
                                    pager.showPageNav('pager', 'pageNavPosition');
                                    pager.showPage(1);
                                </script>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 mb-5">
                        <div class="card shadow " >
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h1 class="mb-0">Upcoming Events with Insufficient Inventory</h1> 
                                            </div>
                                            {{-- <div class="col-xs-4">
                                                <a href="outsource/create" class="btn btn-sm btn-primary"> + Generate Outsource Request</a>
                                            </div>              --}}
                                        </div>
                                    </div>
                                   
                                    <div class="col text-left">
                                       
                                            <div class="col-xs-5">
                                                <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="table-responsive mb-3">
                                                <!-- Projects table -->
                                                
                                                <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Event Name</th>
                                                            <th >Event Date</th>
                                                            <th >Package Name</th>
                                                            <th >Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($needed as $b)
                                                        @if(($b->status > 0))
                                                        <tr>
                                                            <td scope="col">{{ $b->event_name }}</td> 
                                                            <td scope="col">
                                                                {{-- {{ Carbon\Carbon::parse($b->event_start)->format('F j, Y') }}
                                                                <br>
                                                                {{Carbon\Carbon::parse($b->event_start)->format('g:i a') ." - ". Carbon\Carbon::parse($b->event_end)->format('g:i a')}} --}}
                                                                {{Carbon\Carbon::parse($b->event_start)->format('F j, Y g:i a')}}
                                                                <br>
                                                                {{Carbon\Carbon::parse($b->event_end)->format('F j, Y g:i a')}}
                                                            </td>
                                                            <td scope="col">{{ $b->package_name }}</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                                        <div class=" dropdown-header noti-title">
                                                                            <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                                        </div>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a href="{{ url('outsource/create') }}" class="dropdown-item">
                                                                            <i class="ni ni-zoom-split-in"></i>
                                                                            <span>{{ __('Generate Outsource ') }}</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        
                                                        @endif
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    {{-- <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script> --}}
    {{-- <script>
        function searchTable() {
            // Declare variables 
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            // tr = table.getElementsByClassName("mamamo");
            th = table.getElementsByTagName("th");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none";
                for (var j = 0; j <= th.length; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1) {
                            tr[i].style.display = "";
                            break;
                        }
                    }
                }
            }
        }

    </script> --}}
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