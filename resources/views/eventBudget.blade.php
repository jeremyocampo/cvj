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
                                    <h3 class="mb-0">Event Budgets</h3>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" style="padding-bottom: 5vh;padding-right: 2vw">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Template</button>
                        <hr>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Event Start/End</th>
                                <th>Spent Budget/Total Budget</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{$event->event_name}}<br><small><b>Client:</b> {{$event->client_name}}</small></td>
                                    <td><b>{{$event->formatted_day}}</b><br>{{$event->formatted_start}} - {{$event->formatted_end}}
                                    </td>

                                    <td>@if($event->budget_id == null) N/A @else {{number_format($event->total_spent,2)}}  / {{ number_format($event->total_budget,2)}} @endif</td>

                                    <td>
                                        @if( ($event->total_budget - $event->total_spent) >= 0)
                                            <p> Items are in budget.</p>
                                        @else
                                            <b style="color: #ff5658"> Items are overspent. Budget Exceeded.</b>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="/event_budgets/view/{{$event->event_id}}">
                                            @if($event->budget_id == null)
                                                <i class="fa fa-plus fa-lg"></i>
                                                Create Event Budget
                                            @else
                                                <i class="fa fa-eye fa-lg"></i>
                                                View Event Budget
                                            @endif
                                        </a><br>
                                        <!--
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"  onclick="get_avail_personnel({{$event->event_id}})">
                                            <i class="fa fa-plus fa-lg"> </i>
                                            Assign Personnel
                                        </a>
                                        -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>


@endsection