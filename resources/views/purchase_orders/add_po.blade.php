@extends('layouts.eventApp')
@section('title', 'BookEvent')

{{-- @include('layouts.headers.pagination') --}}

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
                                    <h1 class="">Create Purchase Order [{{$event->event_name}}]</h1>
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
                            <form method="POST" action="{{url('add_purchase_order/post')}}">
                            {{-- <form action = "BookEventController@store" method = "POST"> --}}
                            {{ csrf_field() }}
                            <input type="hidden" name="event_id" value="{{$event->event_id}}">
                            <div class="row">
                                <div class="col-md-5">
                                    <h2>Purchase Order Details</h2>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Supplier</span>
                                        </div>
                                        <select name="supplier" id="supplierID" class="form-control">
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Delivery To</span>
                                        </div>
                                        <textarea name="delivery-address" id="deliveryAddress" rows="2" class="form-control"></textarea>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Reference Number</span>
                                        </div>
                                        <input type="text" name="referenceNumber" id="referenceNumber" class="form-control">
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Expected Delivery Date</span>
                                        </div>
                                        <input type="date" name="expectedDelDate" id="expectedDelDate" class="form-control">
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Shipment Preference</span>
                                        </div>
                                        <input type="text" name="shipmentPreference" id="shipmentPreference" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <h2>Purchase Order Items</h2>
                                    <table class="table">
                                        <thead class="table-light table-flush">
                                            <tr class="text-center">
                                                <th>Item Name</th>
                                                <th>Rate</th>
                                                <th>Quantity</th>
                                                <th>Quantity Created</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="POItem">
                                            @foreach ($outsource_inventory as $inv)
                                            <tr>
                                                <input type="hidden" name="inv_ids[]" value="{{$inv->inventory_id}}">
                                                <td><input type="text" name="itemName" id="itemName" class="form-control" value="{{$inv->inventory_name}}" readonly></td>
                                                <td><input type="number" step="any" name="itemRate" id="itemRate_{{$inv->inventory_id}}" class="form-control calculated"></td>
                                                <td><input type="number" name="itemQuantity" data-created="{{$inv->qty_created}}" id="itemQuantity_{{$inv->inventory_id}}" class="form-control validated"></td>
                                                <td><input type="number" name="itemQuantityCreated" id="itemQuantityCreated" value="{{$inv->qty_created}}" class="form-control" readonly></td>
                                                <td><h3>P <b id="inv_total_{{$inv->inventory_id}}">0.0</b></h3></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <hr>
                            <center><button class="form-control btn-info" style="width:25%" type="button" disabled> Create</button></center>
                            
                            </form>
                        </div>
                </div>
                <script>
                </script>
            </div>
        </div>
    </div>
</div>
@endsection