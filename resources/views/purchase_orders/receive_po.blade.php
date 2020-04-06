@extends('layouts.app')
@section('title', 'BookEvent')

{{-- @include('layouts.headers.pagination') --}}

@section('content') 
@include('layouts.headers.inventoryCard1')
    <style>
        #referenceNumber:disabled {
        background: white;
        color: black;
      }
      #eventName:disabled {
        background: white;
        color: black;
      }
      .itm_nms:read-only{
          
        background: white;
        color: black;
        border: none;
      }
      .disabld{
        background: white;
        color: black;
      }
    </style>
    <div class="container-fluid mt--7">
            {{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
            <div class="col-xl-12 mb-5">
                <div class="card shadow " >
                    <div class="card-header ">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="row">
                                <div class="col-xs-5">
                                    <h1 class="">Receive Purchase Order Form</h1>
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
                            {{-- {!! Form::open('action' => ['BookEventController@store', 'method' => 'POST', 'id' => 'bookevent']) !!} --}}
                            <form method="POST" action="{{url('receive_purchase_order/post')}}">
                            {{-- <form action = "BookEventController@store" method = "POST"> --}}
                            {{ csrf_field() }}
                            <input type="hidden" name="event_id" value="{{$event->event_id}}">
                            <input type="hidden" name="po_id" value="{{$po->purchase_order_id}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <h2>Purchase Order Details</h2>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">PO/Reference Number</span>
                                        </div>
                                        <input type="text" name="referenceNumber" id="referenceNumber" class="form-control" value="PO-{{ $po->reference_number }}" disabled>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Event Name</span>
                                        </div>
                                        <input type="text" name="referenceNumber" id="eventName" class="form-control disabld" value="{{$event->event_name}}" disabled>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Supplier</span>
                                        </div>
                                        <input type="text" name="referenceNumber" id="eventName" class="form-control disabld" value="{{$po->supplier()->name}}" disabled>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Delivery Address</span>
                                        </div>
                                        <textarea name="delivery_address" id="deliveryAddress" rows="2" class="form-control disabld" disabled>{{$po->billing_address}}</textarea>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Expected Delivery Date</span>
                                        </div>
                                        <input type="date" value="{{$po->expected_delivery_date}}" name="expectedDelDate" id="expectedDelDate" class="disabld form-control">
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Shipment Preference</span>
                                        </div>
                                        <input type="text" name="shipmentPreference" id="shipmentPreference" value="{{$po->shipment_preferences}}" class="disabld form-control">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                            <div class="col-md-6">
                                                <h2>Purchase Order Item Created</h2>
                                            </div>
                                            <div class="col-md-6" >
                                                <p>Total amount: <b  style="float: right" id="inv_total_text">0.0</b></p>
                                            </div>
                                    </div>
                
                                    <table class="table">
                                        <thead class="table-light table-flush">
                                            <tr class="text-center">
                                                <th>Item Name</th>
                                                <th>Rate</th>
                                                <th>Quantity</th>
                                                <th>Quantity Received</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="POItem">
                                            @foreach ($po_items as $po_item)
                                            <tr>
                                                <input type="hidden" name="po_item_ids[]" value="{{$po_item->id}}">
                                                <td><input type="text" name="itemName" id="itemName" class="form-control itm_nms" value="{{$po_item->name}}" readonly></td>
                                                <td><input type="number" step="any" name="itemRate[]" value="{{$po_item->rate}}" onchange="computed()" data-inv_id="{{$po_item->id}}" id="itemRate_{{$po_item->id}}" class="disabld form-control computed" readonly></td>
                                                <td><input type="number" name="itemQuantity[]" value="0" onchange="validated(this)" data-max="{{$po_item->quantity}}" data-rate="{{$po_item->rate}}" data-inv_id="{{$po_item->id}}" data-created="{{$po_item->qty_received}}" id="itemQuantity_{{$po_item->id}}" class="form-control inv_qty"></td>
                                                <td><h3>{{$po_item->qty_received}}<b>/{{$po_item->quantity}}</b></h3></td>
                                                <td><h3>P <b id="inv_total_{{$po_item->id}}">0.0</b></h3></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <center><button class="form-control btn-info" style="width:25%" type="button" onclick="check_valid_submit();">Receive Items</button></center>
                                    <button type="submit" id="sumbit_btn" style="display: none">btn</button>
                            </form>
                        </div>
                </div>
                <script>
                    let inv_total = 0;
                function computed(){
                    inv_subtotal = 0;
                    $(".inv_qty").each(function () {
                        let inv_id = $(this).attr('data-inv_id');
                        console.log()
                        let tot = (parseFloat($(this).val()) * parseFloat($(this).attr('data-rate')));
                        $('#inv_total_'+inv_id).html(parseFloat(tot).toFixed(2));
                        inv_subtotal = parseFloat(inv_subtotal) + tot;
                    });
                    console.log("computed")
                    inv_total = inv_subtotal;
                    $("#inv_total_text").html(parseFloat(inv_subtotal).toFixed(2));
                }
                function validated(obj){
                    inv_subtotal = 0;
                    let created_qty = parseInt($(obj).attr('data-created'));
                    let max_qty = parseInt($(obj).attr('data-max'));
                    let max_possible_qty = max_qty - created_qty;
                    if(parseInt($(obj).val()) + created_qty > max_qty){
                        alert("The quantity exceeds the item's required quantity.");
                        $(obj).val(max_possible_qty);
                    }
                    computed();
                }
                
                function check_valid_submit(){
                    if(inv_total > 0){
                        $("#sumbit_btn").click();
                    }else{
                        alert("Please specify a rate and quantity for at least one item.");
                    }
                }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection