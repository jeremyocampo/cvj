@extends('layouts.app')
@section('content')
@include('layouts.headers.costing')
<div class="container-fluid mt--7">
            <div class="col-xl-12 mb-5">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="row">
                                    <div class="col-xs-5">
                                        <h1 class="mb-0">Add Cost</h1>
                                    </div>
                                    </div>
                                </div>
                                <div class="col text-right">
                                    
                                </div>
                                <div class="col text-left">
                                    <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Event Here">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            
                            <table class="table align-items-center table-flush" id="AddCostTable">
                                <thead class="thead">
                                    <tr>
                                        <th >Event Name</th>
                                        <th >Date</th>
                                        <th align="right" >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                       $idx = 0; 
                                    @endphp
                                    @foreach ($eventdata as $i)
                                    <tr>
                                        <td>{{ $i->event_name }}</td>
                                        <td>{{ $i->event_date_time }}</td>
                                            <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$idx}}">
                                                View Damaged/ Lost Items
                                        </button>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade modal-responsive" id="exampleModal{{$idx}}"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                <div class="modal-content" style='width: 150%; overflow: auto'>
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Damaged/ Lost Items</h5>
                                                 
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body modal-lg">
                                                    {!! Form::open(['action' => 'AddCostController@store','method' => 'POST']) !!}

                                                    {{-- Damaged Inventory Table --}}
                                                    <h3>Damaged Items</h3>
                                                    <table class="table align-items-center table-flush" id="DamagedInventory">
                                                            {{-- table-responsive <- put after class  --}}
                                                         <thead class="thead">
                                                            <tr>
                                                                <th>Item Name</th>
                                                                <th>Quantity</th>
                                                                <th></th>
                                                                <th>Price Per Item</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $damaged_items = DB::table("damaged_inventory")
                                                                ->where('event_name', $i->event_name)
                                                                ->get();
                                                            @endphp
                                                            @foreach ($damaged_items as $damagedItem)
                                                                @php
                                                                    $damaged_item_details = DB::table('inventory')
                                                                    ->where('inventory_id', $damagedItem->damaged_id)
                                                                    ->get();
                                                                @endphp
                                                                <tr> 
                                                                    <td>
                                                                        {{$damaged_item_details[0]->inventory_name}}
                                                                    </td>
                                                                    <td>
                                                                        {{$damagedItem->quantity}}
                                                                        <input id="curQtyD-{{$damaged_item_details[0]->inventory_id}}" type="hidden" value="{{$damagedItem->quantity}}">
                                                                    </td>
                                                                    <td>X</td>
                                                                    <td>
                                                                        <input onkeyup="getSubtotalD({{$damaged_item_details[0]->inventory_id}})" id="priceD-{{$damaged_item_details[0]->inventory_id}}" class="form-control" type="float" name="costName" placeholder="Enter Price">
                                                                    </td>
                                                                    <td>
                                                                        <p id="subtotalD-{{$damaged_item_details[0]->inventory_id}}"></p>
                                                                        <input type="hidden" id="subtotalDinput-{{$damaged_item_details[0]->inventory_id}}">
                                                                    </td>
                                                                </tr>   
                                                                @php
                                                                    $idx ++;
                                                                @endphp
                                                            @endforeach
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td> 
                                                                    <b>TOTAL DAMAGED: <div align="right"><p id="totalD"></p></div></b>
                                                                    <input type="hidden" id="subtotalDoutput">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <hr>
                                                    {{-- Lost Inventory Table --}}
                                                    <h3>Lost Items</h3>
                                                    <table class="table align-items-center table-flush" id="LostInventory">
                                                         <thead class="thead">
                                                            <tr>
                                                                <th>Item Name</th>
                                                                <th>Quantity</th>
                                                                <th></th>
                                                                <th>Price Per Item</th>
                                                                <th>Subtotal<th>    
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $lost_items = DB::table("lost_inventory")
                                                                ->where('event_name', $i->event_name)
                                                                ->get();
                                                            @endphp
                                                            @foreach ($lost_items as $lostItem)
                                                                @php
                                                                    $lost_item_details = DB::table('inventory')
                                                                    ->where('inventory_id', $lostItem->lost_id)
                                                                    ->get();
                                                                @endphp
                                                                <tr> 
                                                                    
                                                                    <td>{{$lost_item_details[0]->inventory_name}}</td>
                                                                    <td>{{$lostItem->quantity}}
                                                                    <input id="curQtyL-{{$lost_item_details[0]->inventory_id}}" type="hidden" value={{$lostItem->quantity}}>
                                                                    </td>
                                                                    <td>X</td>
                                                                    <td><input onkeyup="getSubtotalL({{$lost_item_details[0]->inventory_id}})" onkeydown="subtractL({{$lost_item_details[0]->inventory_id}}, this.value)" id="priceL-{{$lost_item_details[0]->inventory_id}}" class="form-control" type="float" name="costName" placeholder="Enter Price"></td>
                                                                    <td>
                                                                        <p id="subtotalL-{{$lost_item_details[0]->inventory_id}}"></p>
                                                                        <input type="hidden" id="subtotalLinput-{{$lost_item_details[0]->inventory_id}}">
                                                                    </td>
                                                                </tr>   
                                                                @php
                                                                    $idx ++;
                                                                @endphp
                                                            @endforeach
                                                            <tr>
                                                                <td></td>
                                                                <td></td>   
                                                                <td></td>
                                                                <td></td>
                                                                <td> 
                                                                    <b>TOTAL LOST: <div align="right"><p id="totalL"></p></div></b>
                                                                    <input type="hidden" id="subtotalLoutput">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    {{-- add form here --}}
                                                        {{-- <input class="form-control" type="text" name="costName" placeholder="Cost Name"> --}}
                                                        {{-- <button type="submit" class="btn btn-primary" name = "">Submit</button>     --}}
                                                    <div class="col-xl-12">
                                                        <h2><b> Grand Total: <p id="TOTALF"></p></b></h2>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                                                    <button type="submit" class="btn btn-primary" name = "">Submit</button>
                                                    {!! Form::close() !!}   
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            {{-- end of modal --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        <!--pagination-->
                        <div id="pageNavPosition" style="padding-top: 20px; cursor: pointer" align="center"></div>
                        <script type="text/javascript">
                            <!--
                            var pager = new Pager('myTable', 5);
                            pager.init();
                            pager.showPageNav('pager', 'pageNavPosition');
                            pager.showPage(1);
                        </script>
                        <!--pagination-->
                        </div>
                    </div>
                </div>
            </div>
        @include('layouts.footers.auth')
        </div>
                        {{-- {!! Form::close() !!} --}}
                    </div>
                </div>
                <div class="card-body border-0">



                </div>
            {{-- </div></div>
    </div></div></div> --}}

@endsection

@push('js')

    <script>
        function searchTable() {
            // Declare variables 
            var input, filter, table, tr, td, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            th = table.getElementsByTagName("th");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i <= tr.length; i++) {
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

    </script>

<script>
    
    
     

	function getSubtotalD(el){
        //alert(el);
		var y = document.getElementById("curQtyD-"+el).value;

		var z = document.getElementById("priceD-"+el).value;

        //alert("Current Quantity: "+y+" | Price Input: "+z+"");
		var x = parseFloat(y) * parseFloat(z);
		// document.getElementById('inpQty').innerHTML = z;
        //  alert("Current Quantity: "+y+" | Price Input: "+z+" | Sum: "+x);

        if(x>0){
            document.getElementById("subtotalD-"+el).innerHTML = x;
            document.getElementById("subtotalDinput-"+el).value = x;
        } else {
            document.getElementById("subtotalD-"+el).innerHTML = "";
            document.getElementById("subtotalDinput-"+el).value = "";
        }
		

        // return x;
        // document.getElementById("subtotalDinput-"+el).value;
        var subtotal = 0;
        var table = document.getElementById('DamagedInventory'),
        rows = table.rows, rowcount = rows.length, r,
        cells, cellcount, c, cell;
        // alert('hi');
        for( r=0; r<rowcount; r++) {
            cells = rows[r].cells;
            cellcount = cells.length;
            var t = document.getElementById("subtotalDinput-"+(r+1)).value;
            alert('hi');
            subtotal += parseFloat();
            // alert(cells[3].value);

            // for( c=0; c<cellcount; c++) {
            //     cell = cells[c];
            //     // now do something.
            // }
        }

        document.getElementById('totalD').innerHTML = subtotal;
        document.getElementById('subtotalDoutput').value = subtotal;

    }

    function getSubtotalL(el){
        var y = document.getElementById("curQtyL-"+el).value;

		var z = document.getElementById("priceL-"+el).value;

        //alert("Current Quantity: "+y+" | Price Input: "+z+"");
		var x = parseInt(y) * parseInt(z);
		// document.getElementById('inpQty').innerHTML = z;
        //  alert("Current Quantity: "+y+" | Price Input: "+z+" | Sum: "+x);

		document.getElementById("subtotalL-"+el).innerHTML = x;
        document.getElementById("subtotalLinput-"+el).value = x;

        // return x;

	}


</script>


@endpush