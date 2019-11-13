
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
                                            <small>Event Theme</small>
                                            <label class="form-label">{{$event->theme}}</label>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <small>Event Date</small>
                                            <label class="form-label">
                                                {{$event->formatted_day}} - {{$event->formatted_start}} to {{$event->formatted_end}}
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <small>Attendees Number</small><br>
                                            <label class="form-label">{{$event->totalpax}}</label>
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
                                            <label class="form-label">{{$event->venue}}</label>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                @if($package->package_client_id == $user_id)
                                    <span class="badge badge-pill badge-success" style="background-color: green;color:white;position:absolute;top:65%;left:50%;">USER CUSTOM PACKAGE</span>
                                @endif
                                <img class="card-img-top" src="{{asset($package->package_img_url)}}" style="height: 25vh;width: 100%vw" alt="">
                                <div class="card-body">
                                    <h3 class="card-title" style="margin-bottom: 0;">{{$package->package_name}}</h3>
                                    <div>
                                        <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($package->price,2)}}</b>
                                        <small>~ {{$package->suggested_pax}} pax</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <b>Food</b>
                            <table class="table">
                                <thead>
                                <th>Dish</th>
                                <th>Price</th>
                                <th></th>
                                </thead>
                                <tbody id="food_tbl">
                                @if($package != null)
                                    @foreach($package->foods as $food)
                                        <tr id="food_row_{{$food->item_id}}">
                                            <input type="hidden" name="chosen_dishes[]" value="{{$food->item_id}}">
                                            <td>  {{$food->item_name}}</td>
                                            <td>{{$food->unit_cost * $event->totalpax}} </td>
                                            <td><img src="{{asset($food->item_image)}}" style="height: 10vh;width: 10vw"></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <b>Items</b>

                            <table class="table">
                                <thead>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price/Item</th>
                                <th>Total Price</th>
                                </thead>
                                <tbody id="inv_tbl">
                                @if($package != null)
                                    @foreach($package->inventory as $inv)
                                        <tr id="inv_row_{{$inv->inventory_id}}">
                                            <input type="hidden" name="chosen_invs[]" value="{{$inv->inventory_id}}">
                                            <td> {{$inv->inventory_name}}</td>
                                            <td>{{$inv->quantity}}</td>
                                            <td>{{$inv->rent_cost}}</td>
                                            <td><b id="total_inv_{{$inv->inventory_id}}">{{$inv->quantity * $inv->rent_cost}}</b></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <center><a class="btn btn-lg btn-primary" href="/home">Confirm Booking</a></center>
                </div>
            </div>
        </div>
@endsection