@extends('layouts.app')

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
                                    <h1 class="mb-0">Current Inventory</h1>
                                </div>
                                <div class="col-xs-2">
                                        &nbsp;&nbsp;
                                </div>
                                <div class="col-xs-4">
                                    <a href="inventory/create" class="btn btn-sm btn-primary"> + Add Item</a>
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
                                    <th >Item name</th>
                                    {{-- <th >Stock Keeping Unit(SKU)</th> --}}
                                    <th >Category</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th >Quantity</th>
                                    <th >Threshold</th>
                                    <th >Last Modified (YY-MM-DD)</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  

                                ?>
                                @foreach ($joinedInventory as $i)
                                @if($i->status > 0)
                                <tr>
                                    
                                    <td>
                                        <a href="{{ url('inventory/'.$i->inventory_id) }}" class="dropdown-item">
                                            {{ $i->inventory_name }}
                                        </a>
                                    </td>    
                                    <td>{{ $i->category_name }}</td>
                                    <td>{{ $i->color_name }}</td>
                                    <td> {{ $i->size }}</td>
                                    <td>{{ $i->quantity }}</td>
                                    <td>{{ $i->threshold }}</td>
                                    {{-- <td>{{ $i->barcode }}</td> --}}
                                   
                                    <td>{{ $i->last_modified }}</td>
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
                                                <a href="{{ url('inventory/'.$i->inventory_id) }}" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('View Item Details') }}</span>
                                                </a>

                                                <a href="{{ url('inventory/'.$i->inventory_id.'/edit')}}" class="dropdown-item">
                                                    <i class="ni ni-fat-add"></i>
                                                    <span>{{ __('Replenish Item') }}</span>
                                                </a>
                                                
                                                <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('delete-form-{{ $i->inventory_id }}').submit();">
                                                    <i class="ni ni-fat-remove"></i>
                                                    <span>{{ __('Remove from Inventory') }}</span>
                                                    {!! Form::open(['action' => ['InventoryController@destroy', $i->inventory_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->inventory_id]) !!}
                                                        {{ Form::hidden('_method','DELETE')}}
                                                    {!! Form::close() !!}
                                                </a>
                                            </div>
                                        </div>
                                        {{-- <a class="btn btn-sm btn-primary" href="inventory/{{ $i->itemId }}/edit"> Replenish Item </a> mahaba--}} 
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


                    <div class="col-xl-12 mb-5">
                        <div class="card shadow " >
                            <div class="card-header ">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <h1 class="mb-0">Critical Inventory</h1> &nbsp;&nbsp;
                                            </div>
                                            
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
                                    {{-- </div>
                                </div>
                            </div> --}}
                            <div class="card-body">
        
                            
        
                            <div class="table-responsive mb-3">
                                <!-- Projects table -->
                                
                                <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th >Item name</th>
                                            {{-- <th >Stock Keeping Unit(SKU)</th> --}}
                                            {{-- <th >Category</th> --}}
                                            <th >Quantity</th>
                                            <th >Threshold</th>
                                            {{-- <th >Last Modified (YY-MM-DD)</th> --}}
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($criticalInventory as $b)
                                        @if($b->status > 0)
                                        <tr>
                                            <td scope="col">{{ $b->inventory_name }}</td>
                                            {{-- <td scope="col">{{ $b->category_name}} </td>  --}}
                                            <td scope="col">{{ $b->quantity }}</td>
                                            <td scope="col">{{ $b->threshold }}</td>
                                            
                                            {{-- <td scope="col">{{ $b->updated_at }}</td> --}}
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
                                                        <a href="{{ url('inventory/'.$b->inventory_id) }}" class="dropdown-item">
                                                            <i class="ni ni-zoom-split-in"></i>
                                                            <span>{{ __('View Event Details') }}</span>
                                                        </a>
                                                        <a href="{{ url('inventory/'.$b->inventory_id.'/edit')}}" class="dropdown-item">
                                                            <i class="ni ni-fat-add"></i>
                                                            <span>{{ __('Replenish Item') }}</span>
                                                        </a>
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
                            <!--pagination-->
                            
                            <!--pagination-->
        
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
    {{-- @include('layouts.footers.auth') --}}
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