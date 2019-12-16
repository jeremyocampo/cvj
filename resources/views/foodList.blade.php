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
                                    <h1 class="mb-0">Food Items Available</h1>
                                </div>
                                <div class="col-xs-2">
                                        &nbsp;&nbsp;
                                </div>
                                <div class="col-xs-4">
                                    <a href="fooditem/create" class="btn btn-sm btn-primary"> + Add Item</a>
                                </div>
                                </div>
                            </div>
                            <div class="col text-right">
                                {{-- <a href="inventory/create" class="btn btn-sm btn-primary">Add Item</a> --}}
                                
                            </div>
                            <div class="col text-left">
                                {{-- <div class="row"> --}}
                                    <div class="col-xs-5">
                                {{-- <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here"> --}}
                                {{-- <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here"> --}}
                                    </div>
                                    {{-- <div class="col-xs-2">
                                        &nbsp; &nbsp;
                                    </div> --}}
                                    {{-- <div class="col-xs-3">
                                    <button type="button" class="btn btn-md btn-block" onclick="seachTable()">Search</button>
                                    </div> --}}
                                {{-- </div> --}}
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
                                    <th >Dish Name</th>
                                    <th>Food Image</th>
                                    <th>Unit Cost (per piece)</th>
                                    <th >Unit Expense (per piece)</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dishes as $i)
                                <tr>
                                    <td><a href="{{ url('fooditem/'.$i->item_id) }}" class="dropdown-item"> {{ $i->item_name }}</a>
                                    </td>  
                                    <td><img class="card-img-top" src="{{asset($i->item_image)}}"  alt=""></td>  
                                    <td>{{$i->unit_cost}}</td>
                                    <td>{{$i->unit_expense}}</td>
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
                                                <a href="{{ url('fooditem/'.$i->item_id) }}" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('View Item Details') }}</span>
                                                <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('delete-form-{{ $i->item_id }}').submit();">
                                                    <i class="ni ni-fat-remove"></i>
                                                    <span>{{ __('Remove from Food Records') }}</span>
                                                    {!! Form::open(['action' => ['FoodItemController@destroy', $i->item_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->item_id]) !!}
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
                            {{-- <div id="pageNavPosition" style="padding-top: 20px; cursor: pointer;" align="center"></div>
                            <script type="text/javascript">
                                <!--
                                var pager = new Pager('myTable', 5);
                                pager.init();
                                pager.showPageNav('pager', 'pageNavPosition');
                                pager.showPage(1);
                            </script> --}}
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

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        } );
    </script>

@endpush