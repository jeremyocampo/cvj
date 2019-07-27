@extends('layouts.inventoryApp')

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
                                    <h1 class="mb-0">Inventory Table</h1>
                                </div>
                                <div class="col-xs-2">
                                        &nbsp;&nbsp;
                                </div>
                                <div class="col-xs-4">
                                    <a href="inventory/create" class="btn btn-sm btn-primary"> + Add Item</a>
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
                                <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
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
                                @if(session()->has('delete'))
                                    <br>
                                    <div class="alert alert-danger" role="alert">
                                        <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                        {{ session()->get('delete') }}<br>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{-- {!! Form::open(['action' => 'InventoryController@selectType', 'method' => 'POST']) !!}
                        <div class="col-md-4">
                            <select name="itemType" id="itemType" class="form-control">
                                <option disabled selected value="">- Please Select an Option -</option>
                                <option value="cen">Centerpiece</option>
                                <option value="lin">Linen</option>
                                <option value="flo">Flower</option>
                                <option value="tab">Table</option>
                                <option value="cha">Chair</option>
                                <option value="ute">Utensils</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                                {{ Form::submit('Add Item', ['class' => 'btn btn-success']) }}
                        </div>
                        {!! Form::close() !!} --}}
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
                                            {{ $i->inventory_name }}</td>
                                        </a>
                                   
                                    {{-- <td>
                                        <div id="barcode-{{$i->inventory_id}}" value="toPrint-{{$i->inventory_id}}">
                                            <a href="" class="dropdown-item" onclick="printContent('barcode-{{$i->inventory_id}}');" id="printBtn{{ $i->inventory_id}}">
                                                {!!'<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("".$i->sku, "C128A",2,44,array(1,1,1), true) . '" alt="barcode"   />' !!}
                                            </a>
                                        </div>
                                    </td> --}}
                                    <td>{{ $i->category_name }}</td>
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