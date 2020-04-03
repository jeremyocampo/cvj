{{-- @extends('supplier.layout.dashboard') --}}

@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<style>
    a.disabled {
    pointer-events: none;
    cursor: default;
    }
</style>
    {{-- <div class="header bg-gradient-logo-color pb-8 pt-5 pt-md-8"></div> --}}
    <div class="container-fluid mt--7">
        {{-- <div class="row"> --}}
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">Purchase Order List</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Events with Outsourcing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Purchase Orders Created</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Lease Returns</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table  align-items-center  mb-12" id="myTable" >
                                    <thead class="thead-light">
                                    <tr>
                                        <th> Event Name </th>
                                        <th> Start Date</th>
                                        <th> <center>Total Quantity Created/Required</center></th>
                                        <th> Action </th>
                                        <th> Status </th>
                                    </tr>
                                    </thead>
                                    <tbody>                                    
                                    @foreach ($outsource_events as $i)
                                        <td><h3>{{$i->event_name}}<h2></td>
                                        <td>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y') }} </td>
                                       <td><center><h2>{{$i->quantity_created}}/<b>{{$i->quantity_required}}</b></center></h2></td>
                                        <td class="popup">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                    Action
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                    <div class=" dropdown-header noti-title">
                                                        <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="{{ url('add_purchase_order/'.$i->event_id) }}" class="dropdown-item @if($i->all_created  == 1) disabled @endif">
                                                        <i class="ni ni-collection"></i>
                                                        <span>Create Purchase Order</span>
                                                    </a>
                                                    <a href="{{ url('event_po_detail/'.$i->event_id) }}" class="dropdown-item">
                                                        <i class="ni ni-zoom-split-in"></i>
                                                        <span>View Event Details</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    <td><h3 style="color: {{$i->status_color}}">{{$i->status}}</h2></td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table  align-items-center  mb-3" id="myTable" >
                                    <thead class="thead-light">
                                        <tr>
                                            <th>PO Reference Number</th>
                                            <th>Event</th>
                                            <th>Supplier</th>
                                            <th>Expected Delivery Date</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($purchaseOrders as $i)
                                        <td>{{$i->reference_number}}</td>
                                        <td>{{$i->event()->event_name}}</td>
                                        <td>{{$i->supplier()->name}}</td>
                                        <td>{{ Carbon\Carbon::parse($i->expected_delivery_date)->format('F j, Y') }} </td>
                                        <td class="popup">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                    Action
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                    <div class=" dropdown-header noti-title">
                                                        <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="#" data-toggle="modal" data-target="#receiveModal" 
                                                   {{-- Emmbed fields for the PO here for receipt. --}} 
                                                    class="dropdown-item @if($i->all_fulfilled  == 1) disabled @endif">
                                                        <i class="ni ni-collection"></i>
                                                        <span>Receive Purchase Order</span>
                                                    </a>
                                                    <a href="{{ url('event_po_detail/'.$i->event_id) }}" class="dropdown-item">
                                                        <i class="ni ni-zoom-split-in"></i>
                                                        <span>View Event Details</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>unf</td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <div class="modal fade" id="receiveModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Purchase Order</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <div class="modal-body">
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

                    <table class="table">
                        <thead class="table-light table-flush">
                            <tr class="text-center">
                                <th>Item</th>
                                <th>Rate</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="itemName" id="itemName" class="form-control"></td>
                                <td><input type="text" name="itemRate" id="itemRate" class="form-control"></td>
                                <td><input type="text" name="itemQuantity" id="itemQuantity" class="form-control"></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-sm btn-success" id="addItem">
                                        Add Item
                                    </button>
                                </td>
                            </tr>
                        </thead>
                        <tbody id="POItem">
                        </tbody>
                    </table>
                </div>
    
                <div class="modal-footer">
                    <button class="btn btn-success" id="savePO">Save</button>
                    <button class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@stop



@push('js')
    <script>
        $('#addPO').on('click', function() {
            $('#modalPO').modal('show');
        });
    </script>
@endpush