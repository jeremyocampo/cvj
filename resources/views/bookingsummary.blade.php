
@extends('layouts.app')
@section('content')
    @include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
    <div class="card-body">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                        <center><h2 class="mb-0" >Event Booking Summary</h2></center>
                </div>
                <div class="card-body border-0">
                    <div class="row">
                        <div class="col-md-8">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <small>Event Name</small><br>
                                            <label class="form-label">{{$event->event_name}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <small>Event Type</small><br>
                                            <label class="form-label">{{$event->event_type}}</label>
                                        </div>
                                        <div class="col-md-4">
                                            <small>Event Theme</small><br>
                                            <label class="form-label">{{$event->theme}}</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small>Event Date</small><br>
                                            <label class="form-label">
                                                {{$event->formatted_day}} - {{$event->formatted_start}} to {{$event->formatted_end}}
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <small>Estimated Number of Attendees</small><br>
                                            <label class="form-label">{{$package->suggested_pax}}</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small>Other Details</small><br>
                                            <label class="form-label">{{$event->others}}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <small>Venue</small><br>
                                            <label class="form-label">[{{$event->venue}}] {{$event->event_detailsAdded}}</label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <h3 style="margin-top: 3vh;">Package Inclusions <i class="fa fa-gift"></i></h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <b>Dishes </b>
                                    <table class="table">
                                        <thead>
                                        <th>Dish</th>
                                        </thead>
                                        <tbody id="food_tbl">
                                        @if($package != null)
                                            @foreach($package->foods as $food)
                                                <tr id="food_row_{{$food->item_id}}">
                                                    <td>  {{$food->item_name}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <b>Items & Misc <i class="fa fa-chair"></i></b>

                                    <table class="table">
                                        <thead>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        </thead>
                                        <tbody id="inv_tbl">
                                        @if($package != null)
                                            @foreach($package->inventory as $inv)
                                                <tr id="inv_row_{{$inv->inventory_id}}">
                                                    <td> {{$inv->inventory_name}}</td>
                                                    <td>{{$inv->quantity}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{asset($package->package_img_url)}}" style="height: 25vh;width: 100%vw" alt="">
                                <div class="card-body">
                                    <h5 style="margin-bottom: 0.1vh">Selected Package</h5>
                                    <h3 class="card-title" style="margin-bottom: 0;">{{$package->package_name}}</h3>
                                    <div>
                                        <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($package->price,2)}}</b>
                                    </div>
                                    @if($additional_count != 0)
                                        <h5 style="margin-bottom: 0.1vh;margin-top:1vh;">Total Additionals</h5>
                                        <div>
                                            <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($event->total_amount_due - $package->price,2)}}</b>
                                        </div>
                                    @endif
                                        <hr>
                                        <h4 style="margin-bottom: 0.1vh">Total Price</h4>
                                        <div>
                                            <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($event->total_amount_due,2)}}</b>
                                        </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: dotted 1px;">
                    @if($additional_count != 0)

                        <h3>Additions <i class="fa fa-cart-plus"></i></h3>
                        <div class="row">
                            <div class="col-md-6">
                                <b>Additional Dishes</b>
                                <table class="table">
                                    <thead>
                                    <th>Dish</th>
                                    <th>Price</th>
                                    </thead>
                                    <tbody id="food_tbl">
                                        @foreach($additional_dishes as $food)
                                            <tr id="food_row_{{$food->item_id}}">
                                                <td>  {{$food->item_name}}</td>
                                                <td>{{$food->total_price}} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <b>Additional Items & Misc</b>
                                <table class="table">
                                    <thead>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price/Item</th>
                                    <th>Total Price</th>
                                    </thead>
                                    <tbody id="inv_tbl">
                                        @foreach($additional_invs as $inv)
                                            <tr id="inv_row_{{$inv->inventory_id}}">
                                                <td> {{$inv->inventory_name}}</td>
                                                <td>{{$inv->qty}}</td>
                                                <td>{{$inv->rent_price}}</td>
                                                <td><b id="total_inv_{{$inv->inventory_id}}">{{$inv->qty * $inv->rent_price}}</b></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <hr>
                    <center><a class="btn btn-lg btn-primary" href="/home">Confirm Booking</a></center>
                </div>
            </div>
        </div>
@endsection