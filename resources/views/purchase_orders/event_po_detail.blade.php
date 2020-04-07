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
    </style>
    
    <div class="modal fade" id="OutInvModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Event Outsourced Items</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body">
                    <div class="row">
                        <table class="table  align-items-center  mb-12" id="myTable" >
                            <thead class="thead-light">
                            <tr>
                                <th> Item Name</th>
                                <th> Quantity </th>
                                <th> Quantity Created </th>
                            </tr>
                            </thead>
                            <tbody>                                    
                            @foreach ($outsource_inventory as $inv)
                            <tr>
                                <td>{{$inv->inventory()->inventory_name}}</td>
                                <td>{{$inv->quantity}}</td>
                                <td>{{$inv->get_quantity_created()}}</td>
                             </tr>    
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
            {{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
            <div class="col-xl-12 mb-5">
                <div class="card shadow " >
                    <div class="card-header ">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="row">
                                <div class="col-xs-5">
                                    <h1 class="">Event Purchase Orders</h1>
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
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Event Name</span>
                                        </div>
                                    <input type="text" name="referenceNumber" id="eventName" class="form-control" value="{{$event->event_name}}" disabled>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Start Date</span>
                                        </div>
                                    <input type="date" value="{{$event_start_date}}" name="expectedDelDate" id="expectedDelDate" class="form-control itm_nms" readonly>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Client Name</span>
                                        </div>
                                        <input type="text" name="referenceNumber" id="eventName" class="form-control" value="{{$event->client()->client_name}}" disabled>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Total Amount</span>            
                                        </div>
                                        <input type="text" name="referenceNumber" id="eventName" class="form-control" value="P {{number_format($event->total_amount , 2) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Package</span>
                                        </div>
                                    <input type="text" name="referenceNumber" id="eventName" class="form-control" value="{{$event->package()->package_name}}" disabled>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Venue</span>
                                        </div>
                                        <input type="text" name="referenceNumber" id="eventName" class="form-control" value="{{$event->venue}}" disabled>
                                    </div>
                                    <div class="input-group input-group-alternative mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Total Outsourced Items</span>            
                                        </div>
                                        <input type="text" name="referenceNumber" id="eventName" class="form-control" value="{{$event->quantity_required}}" disabled>
                                    </div>
                                    <small><a href="#" data-toggle="modal" data-target="#OutInvModal" >[click to view list of outsourced items]</a></small>
                                </div>
                            </div>
                            <hr>
                            <h2>Purchase Orders Created</h2>
                            <div class="row">
                                <div class="accordion" id="accordionExample" style="width:100%"> 
                                @foreach ($existing_pos as $po)
                                    
                                <div class="card">
                                    <div class="card-header" id="heading_{{$po->purchase_order_id}}">
                                      <h4 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_{{$po->purchase_order_id}}" aria-expanded="true" aria-controls="collapseOne">
                                          Purchase Order - {{$po->reference_number}}
                                        </button>
                                        <label  style="float: right"> P {{number_format($po->total , 2) }}</label>
                                      </h4>
                                    </div>
                                    <div id="collapse_{{$po->purchase_order_id}}" class="collapse" aria-labelledby="heading_{{$po->purchase_order_id}}" data-parent="#accordionExample">
                                      <div class="card-body">
                                        <div class="row">
                                            <div>
                                                @if($po->is_max() != true)<a href="{{ url('receive_purchase_order/'.$po->purchase_order_id) }}" style="margin-left: 0;padding-left:0;" class="btn btn-link"><i class="ni ni-box-2"></i> Receive PO</a>
                                                @else
                                                <small> <b><i style="color:#3dff18" style="display:inline" class="fa fa-check-circle"></i> All Purchase Order Items received.</b></small>
                                                @endif
                                                <br>
                                                <label>Supplier Name: <b>{{$po->supplier_name}}</b></label><br>
                                                <label>Delivery Date: <b>{{$po->expected_delivery_date}}</b></label><br>
                                                <small><label style="color: gainsboro">Date Created:<b> {{$po->created_at}}</b></label></small>
                                            </div>       
                                        </div>
                                        <div class="row">
                                            <table class="table  align-items-center  mb-12" id="myTable" >
                                                <thead class="thead-light">
                                                <tr>
                                                    <th> Item Name</th>
                                                    <th> Rate </th>
                                                    <th> Quantity </th>
                                                    <th> Quantity Received</th>
                                                    <th> Subtotal Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>                                    
                                                @foreach ($po->po_items as $po_item)
                                                <tr>
                                                    <td>{{$po_item->name}}</td>
                                                    <td>{{$po_item->rate}}</td>
                                                    <td>{{$po_item->quantity}}</td>
                                                    <td>{{$po_item->total_items_received()}}</td>
                                                    <td>P {{number_format($po_item->total() , 2) }}</td>
                                                 </tr>    
                                                @endforeach
                                                <tr>
                                                    <td><h3>TOTAL</h3></td><td>-----</td><td>-----</td>
                                                    <td></td><td> <h3>P {{number_format($po->total , 2) }} </h3></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                                  </div>
                            </div>
                            <hr>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection