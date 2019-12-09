@inject('func', 'App\Http\Controllers\EventsCostingController')
@extends('layouts.app', ['title' => __('User Management')])
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
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Event Start/End</th>
                                <th>Spent Budget/Total Budget</th>
                                <th>Assigned Personnel</th>
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
                                        @if($event->personnels == null) N/A
                                        @else
                                            @foreach($event->personnels as $personnel)
                                                {{$personnel->employee_FN}} {{$personnel->employee_LN}}<br>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if( ($event->total_budget - $event->total_spent) >= 0)
                                            <p> Items are in budget.</p>
                                        @else
                                            <p> Items are overspent.</p>
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
                                        <a href="#" data-toggle="modal" data-target="#exampleModal"  onclick="get_avail_personnel({{$event->event_id}})">
                                            <i class="fa fa-plus fa-lg"> </i>
                                            Assign Personnel
                                        </a>
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
    <!--
    <script>
        let subtotal = 0;
        compute_expense();
        compute_net_profit();

        function compute_expense(){
            subtotal = 0;
            $(".cost_item").each(function() {
                subtotal += parseFloat($(this).val());
            });
            console.log(subtotal);
            $("#budget_subtotal").html("P"+parseFloat(subtotal).toFixed(2));
        }
        $('.cost_item').keyup(function(){
            compute_expense();
            compute_net_profit();
        });
        function compute_net_profit() {
            $("#net_profit").html((price-subtotal).toFixed(2));
        }

    </script>
    -->
    <script>
        let personnel_assigned_ids = [@foreach($event->personnels as $personnel)'{{$personnel->employee_id}}',@endforeach];
        let all_personnel = [@foreach($all_personnels as $personnel)'{{$personnel->employee_id}}',@endforeach];
        function get_avail_personnel(event_id){
            $.get("/avail_personnels/"+event_id, function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);
                $("#personnel_table").empty().append("<tr><th>First Name</th><th>Last Name</th></tr>");

                data.forEach(function(entry) {
                    console.log(entry);
                    $("#personnel_table").append('<tr>');
                    $("#personnel_table").append('<td><a href="add_personnel/'+entry["emp_id"]+'/'+event_id+'/">'+entry["fn"]+'</a></td>');
                    $("#personnel_table").append('<td>'+entry["ln"]+'</td>');
                    $("#personnel_table").append('</tr>');
                });
            });
        }
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                    {{csrf_field()}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Employee to Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                            <small>Displaying Available Employees for this event.</small>
                            <table class="table-bordered table" id="personnel_table">
                                <tr>
                                    @foreach($all_personnels as $personnel)
                                        <td>{{$personnel->employee_FN}}</td>
                                        <td>{{$personnel->employee_LN}}</td>
                                    @endforeach
                                </tr>
                            </table>
                        <hr>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </div>
    </div>
@endsection