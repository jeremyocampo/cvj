@extends('layouts.app')
@section('title', 'BookEvent')

{{-- @include('layouts.headers.pagination') --}}

@section('content')
    @include('layouts.headers.eventsCard')

    <div class="container-fluid mt--7">
        <div class="col-xl-12 mb-5">

            <form action="{{route('post.editevent')}}" method="POST">
                @csrf
            <div class="card shadow" >
                <div class="card-header ">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-md-4 mb-3">
                            <input type="hidden" name="event_id" value="{{$event->event_id}}">
                            <h1 class="">Book Event <br> </h1>
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
                            @if(session()->has('error'))
                                <br>
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                    {{ session()->get('error') }}<br>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body border-0">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <button type = button data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                            {{ $error }}<br>
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <div>
                            <label class = "form-label" style="display: inline"> Client Name <font color="red">*</font></label>
                            </div>
                            <input type="text"  class="form-control"  readonly value="{{$client->client_name}}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class = "form-label"> Estimated Attendees <font color="red">*</font></label>
                            <select name = "attendees"  id = "attendees" class = "form-control" required>
                                <option value="{{$event->totalpax}}" selected> {{$event->totalpax}} </option>
                                <option value="50"> 50 </option>
                                <option value="70"> 70 </option>
                                <option value="80"> 80 </option>
                                <option value="100"> 100 </option>
                                <option value="150"> 150 </option>
                                <option value="200"> 200 </option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label style="color: #7c7c7c" class = "form-label"> Change Warning <font color="#adff2f">*</font></label><br>
                            <small style="color: #7c7c7c"> Event's Chosen Package maybe discarded if <b>Estimated Attendees</b> is changed.</small>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class = "form-label"> Event Name <font color="red">*</font></label>
                            <input type="text"  name="eventName" class="form-control"  required value="{{$event->event_name}}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class = "form-label"> Event Type <font color="red">*</font></label>
                            <select name = "eventType"  id = "eventType" class = "form-control" required>
                                <option value="{{$event->event_type}}" selected> {{$event->event_type}} </option>
                                <option value="Wedding"> Wedding </option>
                                <option value="Birthday"> Birthday </option>
                                <option value="Debut"> Debut </option>
                                <option value="Business"> Business </option>
                                <option value="Corporate"> Corporate </option>
                                <option value="Others"> Others </option>
                            </select>
                        </div>

                        <div class="col-md-3 mb-2">
                            <label style="color: #7c7c7c" class = "form-label"> Change Warning <font color="#adff2f">*</font></label><br>
                            <small style="color: #7c7c7c"> Event's Chosen Package maybe discarded if <b>Event Type</b> is changed.</small>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label class = "datetime"> Event Date <font color="red">*</font></label>
                           <!--
                            <input type="date" min="{{$min_val_date}}" name="eventStartDate" onchange="checkdates()" value="{{$event_day}}" class="form-control" placeholder="Start date" id="eventStartDate">
                            -->
                            <input type="date" name="eventStartDate" onchange="checkdates()" value="{{$event_day}}" class="form-control" placeholder="Start date" id="eventStartDate">

                            <p id="invalid_msg" class="small" style="color: #ff5153;display: none;">This date is already overbooked. Please consider booking another day or cancel booking event.</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class = "datetime"> Start Time <font color="red">*</font></label>
                                    <input type="time" name="startTime" value="{{$start_time}}" class="form-control" id="eventStartTime" required>
                                </div>
                                <div class="col-md-6">
                                    <label class = "datetime"> End Time <font color="red">*</font></label>
                                    <input type="time" name="endTime"  value="{{$end_time}}" class="form-control"  id="eventEndTime" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label class = "form-label"> Event Theme <font color="red">*</font></label>
                            <input type="text"  class="form-control" name="theme" value="{{$event->theme}}" required>

                        </div>

                        {{-- by 50s, 60s, 70, 80s etcc.. --}}
                        <div class="col-md-4 mb-3">
                            <label class = "form-label"> Is a Holiday<font color="red">*</font></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_holiday" id="exampleRadios1" value="0" @if($event->is_holiday ==0) checked @endif>
                                <label class="form-check-label" for="exampleRadios1">
                                    No
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_holiday" id="exampleRadios2" value="1" @if($event->is_holiday !=0) checked @endif>
                                <label class="form-check-label" for="exampleRadios2">
                                    Yes
                                </label>
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label class = "form-label"> Venue <font color="red" >*</font></label>
                            <select name="venue" class = "form-control" onchange="venue_select()" id="location" required>
                                <option value="{{$event->venue}}">{{$event->venue}}</option>
                                <option value="CVJ Clubhouse Ground Floor"> CVJ Clubhouse Ground Floor </option>
                                <option value="CVJ Clubhouse Second Floor"> CVJ Clubhouse Second Floor </option>
                                <option value="CVJ Clubhouse Third Floor"> CVJ Clubhouse Third Floor </option>
                                <option value="Off-Premise"> Off-Premise </option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">

                            <div id="address_div" @if($event->venue != 'Off-Premise') style="display: none" @endif>
                                <label class = "form-label" id="eventvenueL"> Address <font color="red" id="eventvenueA"></font></label>
                                <input type="text" class="form-control" PLACEHOLDER="Venue address" id="eventvenue" value="{{$event->event_detailsAdded}}" name="eventvenue">
                                <p class="small" style="color: #ff8300;">Off-Premise Venues adds a 15 % Service Charge to the total amount due.</p>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3"> <label class = "form-label"> Others </label>
                            <textarea name="others" class="form-control" >{{$event->others}}</textarea>
                        </div>
                        <div class="col-md-4 mb-3" id="emp_col" style="display: block;">
                            <label class = "form-label"> Assign Personnel to Event</label>
                            <select class="js-example-basic-multiple" id="select_emps" onchange="dropdown_change_listener()" name="emps[]" style="width: 100%" multiple="multiple">
                                @foreach($emps_selected as $emp)
                                    <option value="{{$emp->employee_id}}" selected>{{$emp->employee_FN}} {{$emp->employee_LN}}</option>
                                @endforeach
                                    @foreach($other_emps as $emp)
                                        <option value="{{$emp->employee_id}}">{{$emp->employee_FN}} {{$emp->employee_LN}}</option>
                                    @endforeach
                            </select>
                            <small>Minimum of 5 personnel in an event.</small>
                            <script>
                                $(document).ready(function() {
                                    $('.js-example-basic-multiple').select2({
                                        //maximumSelectionLength: 10,
                                    });
                                });
                                dropdown_change_listener();
                            </script>
                        </div>
                        <br>
                        <div class="col-md-12 mb-3">
                            <b id="warning_div" style="text-align: center;display: none;color: #ff4646"> Unable to proceed to next step. Please resolve the error.</b>
                            <div style="text-align:center;" id="submit_div">
                                <button type="submit" id="sumbit_btn" class="btn btn-success">Confirm Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    function toggle(x){
                        if(x=="Others"){
                            var test=document.getElementById('test');
                            test.style.display="block";
                        }
                    }
                </script>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')

<script>
    var event_day = '{{$event_day}}';
    function dropdown_change_listener() {
        let len = $(".js-example-basic-multiple :selected").length;
        if (len >= 2){
            $("#sumbit_btn").attr("disabled",false);
        }
        else{
            $("#sumbit_btn").attr("disabled",true);
        }
        console.log(len);
    }
    function venue_select(){
        if($("#location").val() === "Off-Premise"){
            $("#address_div").css("display","block");
        }
        else{
            $("#address_div").css("display","none");
        }
    }
    function checkdates(){
        //check if 2 months before curr date?
        //if 2 dates are not null, check AJAX
        var start = document.getElementById('eventStartDate');

        if(start !== null && start.value !== event_day){
            console.log(start.value);
            console.log($("#eventStartTime").val());
            console.log($("#eventEndTime").val());
            //alert("batang pasaway");
            $.ajax({
                url: "/check_valid_date/"+start.value,
                method: 'get',
                success: function(result){
                    console.log(result);
                    if(result.valid === false){
                        $("#invalid_msg").css("display","block");
                        $("#warning_div").css("display","block");
                        $("#eventStartDate").css("border-color","#ff4646");
                        $("#submit_div").css("display","none");
                    }
                    else{
                        $("#submit_div").css("display","block");
                        $("#invalid_msg").css("display","none");
                        $("#warning_div").css("display","none");
                        $("#eventStartDate").css("border-color","#cad1d7");
                    }
                }});
            $("#emp_col").css("display","block");
        }
        disp_avail_personnel(start.value);
        //show avail employees
    }
    function xd_disp_avail_personnel(date){
        $.get("/avail_personnels_on_date/"+date, function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            $("#select_emps").empty();
            data.forEach(function(entry) {
                console.log(entry);
                $("#select_emps").append('<option value="'+entry["emp_id"]+'">'+entry["fn"]+' '+entry["ln"]+'</option>');

            });
        });
    }
    /*
     $(document).ready(function(){
     var sel = document.getElementById("location");
     var text = document.getElementById("eventvenue");
     var text1 = document.getElementById("eventvenueL");
     var text2 = document.getElementById("eventvenueA");
     text.hidden = (sel.value != "4");
     text1.hidden = (sel.value != "4");
     text2.hidden = (sel.value != "4");
     text1.disabled = (sel.value != "4");
     text2.disabled = (sel.value != "4");
     sel.disabled = (text.value != '');

     var start = document.getElementById('eventStartDate');
     var end = document.getElementById('eventEndDate');

     start.onchange = function(){
     end.value = start.value;
     };
     // start.onkeydown = function(){
     //     end.value = start.value;
     // };


     sel.onchange = function(e) {
     text.hidden = (sel.value != "4");
     text1.hidden = (sel.value != "4");
     text2.hidden = (sel.value != "4");
     text.disabled = (sel.value != "4");
     text1.disabled = (sel.value != "4");
     text2.disabled = (sel.value != "4");
     };

     text.oninput = function(e){
     sel.disabled = (text.value != '');
     }
     });
     */
</script>

@endpush