@inject('func', 'App\Http\Controllers\EventsCostingController')
@extends('layouts.inventoryApp', ['title' => __('User Management')])
@section('content')
    @include('layouts.headers.eventsCard')
    <style>
        .cost_item{
            height:80%;
        }
    </style>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <center>
                                    <h3 class="mb-0">View Event Costing</h3>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" style="padding-bottom: 5vh;padding-right: 2vw">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>{{$event_name}}</h3>
                                <p style="font-size: 95%">{{$func::getPackage_by_Id($event->package_id)->package_name}}</p>
                                <h3>P{{number_format($func::getPackage_by_Id($event->package_id)->price, 2)}}</h3>
                                <hr>
                                <h3 style="display: inline;">Net Profit:</h3>
                                <p id="net_profit" style="display: inline;"></p>
                            </div>
                            <div class="col-md-6" style="background-color: #f4f5f7;padding: 1.5vw;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Outsourcing Expenses</label><br>
                                        <small><a href="#" data-toggle="modal" data-target="#exampleModal">[view breakdown]</a></small>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="P{{number_format($total_outsource,2)}}" disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <center><h3 style="margin-left: 1vw">Extra Expenses</h3></center>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Labor</label><br>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control cost_item" value="{{number_format($event_costing->labor,2)}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Food</label><br>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control cost_item" value="{{number_format($event_costing->food,2)}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Beverage</label><br>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control cost_item" value="{{number_format($event_costing->beverage,2)}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Logistics</label><br>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control cost_item" value="{{number_format($event_costing->logistics,2)}}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div style="display: inline;text-align: right;width: 100%;margin-right: 1vw">
                                        <h3 style="display: inline">Subtotal: </h3><p id="expense_subtotal" style="display: inline;font-size: 125%">P123.0</p>
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
    <script>
        let subtotal = 0;
        let price = {{$func::getPackage_by_Id($event->package_id)->price}};
        compute_expense();
        compute_net_profit();

        function compute_expense(){
            subtotal = 0;
            $(".cost_item").each(function() {
                subtotal += parseFloat($(this).val());
            });
            console.log(subtotal);
            $("#expense_subtotal").html("P"+parseFloat(subtotal).toFixed(2));
        }
        $('.cost_item').keyup(function(){
            compute_expense();
            compute_net_profit();
        });
        function compute_net_profit() {
            $("#net_profit").html((price-subtotal).toFixed(2));
        }

    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Outsourcing Expenses for {{$event_name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table class="table">
                        <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Supplier</th>
                            <th>QTY</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($outsourced_items as $outsourced_item)
                            <tr>
                                <td>{{$func::getOutsourceItem_by_Id($outsourced_item->outsourced_item_id)->item_name}}</td>
                                <td>{{$func::getSupplier_by_Id( $func::getOutsourceItem_by_Id($outsourced_item->outsourced_item_id)->supplier_id )->name}}</td>
                                <td>{{$outsourced_item->quantity}}</td>
                                <td>{{$outsourced_item->total_price}}</td>
                            </tr>
                    @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection