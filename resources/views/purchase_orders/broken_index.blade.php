
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
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Purchase Orders Created <span class="badge badge-warning">{{$unrcvd_pos}}</span></a></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Lease Returns    
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table  align-items-center  mb-12" id="myTable" >
                                    <thead class="thead-light">
                                    <tr>
                                        <th> Event Name </th>
                                        <th> Event Start Date</th>
                                        <th>Total Amount</th>
                                        <th> <center>Total QTY Created/Required</center></th>
                                        <th> Status </th>
                                        <th> Action </th>     
                                    </tr>
                                    </thead>
                                    <tbody>                                    
                                    @foreach ($outsource_events as $i)
                                    <tr>
                                        <td><h3>{{$i->event_name}}</h3></td>
                                        <td><h4>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y') }} </h4></td>
                                        <td><h4>P {{number_format($i->get_po_total_amt() , 2) }}</h4></td>
                                        <td><center><h4>{{$i->quantity_created}}/<b>{{$i->quantity_required}}</b></center></h4></td>
                                        <td>@if($i->all_created == 1) <i style="color:#3dff18" style="display:inline" class="fa fa-check-circle"></i> @endif <h4 style="display:inline;color: {{$i->status_color}}">{{$i->status}}</h4></td>
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
                                    </tr>
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
                                            <th>Status</th>
                                            <th>Items Received/Required</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($purchaseOrders as $i)
                                    <tr>
                                        <td>PO-{{$i->reference_number}}</td>
                                        <td>{{$i->event()->event_name}}</td>
                                        <td>{{$i->supplier()->name}}</td>
                                        <td>{{ Carbon\Carbon::parse($i->expected_delivery_date)->format('F j, Y') }} </td>
                                        <td>@if($i->receive_status() == 2) <i style="color:#3dff18" style="display:inline" class="fa fa-check-circle"></i> @endif {{$i->receive_status_text}}</td>
                                        <td><h4>{{$i->quantity_received}}/<b>{{$i->quantity_required}}</b></h4></td>
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
                                                    <a  href="{{ url('receive_purchase_order/'.$i->purchase_order_id) }}"
                                                   {{-- Emmbed fields for the PO here for receipt. --}} 
                                                    class="dropdown-item @if($i->all_fulfilled  == 1) disabled @endif">
                                                        <i class="ni ni-box-2"></i>
                                                        <span>Receive Purchase Order</span>
                                                    </a>
                                                    <a href="{{ url('event_po_detail/'.$i->event_id) }}" class="dropdown-item">
                                                        <i class="ni ni-zoom-split-in"></i>
                                                        <span>View Event PO Details</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <table class="table  align-items-center  mb-3" id="myTable" >
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Event Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>POs Returned/Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($events_with_returns as $i)
                                    <tr>
                                        <td><h3>{{$i->event_name}}</h3></td>
                                        <td><h4>{{ Carbon\Carbon::parse($i->event_start)->format('F j, Y') }} </h4></td>
                                        <td><center><h4>{{$i->quantity_created}}/<b>{{$i->quantity_required}}</b></center></h4></td>
                                        <td>@if($i->all_created == 1) <i style="color:#3dff18" style="display:inline" class="fa fa-check-circle"></i> @endif <h4 style="display:inline;color: {{$i->status_color}}">{{$i->status}}</h4></td>
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
                                                    <a href="#" data-target="#returnModal" onclick="modal_launch(this)" data-toggle="modal" 
                                                        data-pos="@foreach($i->purchase_orders() as $po)({{$po->purchase_order_id}},{{$po->supplier()->name}},{{$po->status}}),@endforeach"
                                                    class="dropdown-item">
                                                        <i class="ni ni-collection"></i>
                                                        <span>Return POs</span>
                                                    </a>
                                                    <a href="{{ url('event_po_detail/'.$i->event_id) }}" class="dropdown-item">
                                                        <i class="ni ni-zoom-split-in"></i>
                                                        <span>View Event Details</span>
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
                    </div>
                </div>
            </div>
    <div class="modal fade" id="returnModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{url('return_pos/post')}}" id="return_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Return Purchase Order/Items</h4>
                        <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div id="return_pos_div">
                            <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" value="">Option 1
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input" value="">Option 2
                            </label>
                          </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit" disabled>Submit</button>
                        <button class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>               
                </form>
            </div>
        </div>
    </div>
@stop



@push('js')
    <script>
        function modal_launch(obj){
            let str = $(obj).attr('data-pos');
            let arr = str.split(",");
            console.log("array splitted: "+arr);

        }
        $('#addPO').on('click', function() {
            $('#modalPO').modal('show');
        });
    </script>
@endpush