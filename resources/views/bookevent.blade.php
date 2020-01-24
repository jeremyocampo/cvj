@extends('layouts.app')
@section('title', 'BookEvent')

{{-- @include('layouts.headers.pagination') --}}

@section('content')
    @include('layouts.headers.eventsCard')
    <div class="modal fade" id="newUserModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="dishesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dishesModalLabel">Add New Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Client Name</label>
                            <input type="text" name="client_name" id="client_name" value ="" placeholder="e.g: Juan Dela Cruz"  class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="email" value ="" placeholder="e.g: JuanDelaCruz@gmail.com"  class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telephone Number</label>
                            <input type="text" name="tel_no" id="tel_no" value ="" placeholder="e.g: 8011234"  class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" name="mob_no" id="mob_no" value ="" placeholder="e.g: 09171234567"  class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" id="address" value ="" placeholder="e.g: Leon Guinto, Taft Ave., Malate, Manila"  class="form-control">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-small btn-primary" onclick="add_new_client();" data-dismiss="modal">Add Client</button>
                    <button type="button" class="btn btn-small btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <script>
                    function add_new_client(){
                        $.ajax({
                            url: "{{route('ajax.client_add')}}",
                            method: 'POST',
                            data:{
                                'client_name':$("#client_name").val(),
                                'email':$("#email").val(),
                                'tel_no':$("#tel_no").val(),
                                'mob_no':$("#mob_no").val(),
                                'address':$("#address").val(),
                                '_token':'{{csrf_token()}}'
                            },
                            success: function(result){
                                console.log(result);
                                var str =  '<option value="'+result.client_id+'">';
                                str += $("#client_name").val();
                                str += '</option>';
                                $('#client_select').append(str);
                                alert('Client '+$("#client_name").val()+' Added!');
                            }});
                    }
                </script>
            </div>
        </div>
    </div>
    <div class="modal fade" id="empSchedModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="dishesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dishesModalLabel">Employee Shift Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h3 id="shift_lbl"></h3>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Shift Name</th>
                                    <th>In</th>
                                    <th>Out</th>
                                </tr>
                                </thead>
                                <tbody id="shift_tbl">

                                </tbody>
                            </table>
                        </div>
                        <div id="pageNavPosition" style="padding-top: 20px; cursor: pointer;" align="center"></div>
                        <script type="text/javascript">
                            var pager = new Pager('myTable', 5);
                            pager.init();
                            pager.showPageNav('pager', 'pageNavPosition');
                            pager.showPage(1);
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-small btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid mt--7">
        <div class="col-xl-12 mb-5">
            <div class="card shadow" >
                <div class="card-header ">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 col-md-4 mb-3">
                            {!! Form::open(['action' => 'BookEventController@store', 'method' => 'POST']) !!}
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
                                <label class = "form-label" style="display: inline"> Select Client <font color="red">*</font></label>
                                <button type="button"style="border-radius: 50px;display: inline;padding: .75px;margin-bottom: .5rem;"  class="btn btn-primary" data-target="#newUserModal" data-tooltip="eut" data-toggle="modal"><i class="fa fa-user-alt"></i>+</button>

                            </div>
                            <select name = "client_id"  id = "client_select" class = "form-control" required>
                                <option disabled selected> - Please Choose Client - </option>
                                @foreach($clients as $client)
                                    <option value="{{$client->client_id}}"> {{$client->client_name}} </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-md-4 mb-3">
                            <label class = "form-label"> Estimated Attendees <font color="red">*</font></label>
                            <select name = "attendees"  id = "attendees" class = "form-control" required>
                                <option value="50"> 50 </option>
                                <option value="70"> 70 </option>
                                <option value="80"> 80 </option>
                                <option value="100"> 100 </option>
                                <option value="150"> 150 </option>
                                <option value="200"> 200 </option>
                            </select>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class = "form-label"> Event Name <font color="red">*</font></label>
                            {{ Form::text('eventName', '', ['class' => 'form-control', 'placeholder' => 'Event Name', 'required' => 'true'])}}
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class = "form-label"> Event Type <font color="red">*</font></label>
                            <select name = "eventType"  id = "eventType" class = "form-control" required>
                                <option disabled selected> - Please Select Event Type - </option>
                                <option value="Wedding"> Wedding </option>
                                <option value="Birthday"> Birthday </option>
                                <option value="Debut"> Debut </option>
                                <option value="Business"> Business </option>
                                <option value="Corporate"> Corporate </option>
                                <option value="Others"> Others </option>
                            </select>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label class = "datetime"> Event Date <font color="red">*</font></label>
                            {{-- {{ Form::date('eventStartDate', '', ['class' => 'form-control', 'placeholder' => 'Date of Event', 'required' => 'true', 'min' => date("Y-m-d H:i:s")]) }}  --}}
                            <input type="date" min="{{$min_val_date}}" name="eventStartDate" onchange="checkdates()" class="form-control" placeholder="Start date" id="eventStartDate">
                            <p id="invalid_msg" class="small" style="color: #ff5153;display: none;">This date is already overbooked. Please consider booking another day or cancel booking event.</p>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class = "datetime"> Start Time <font color="red">*</font></label>
                                    <input type="time" name="startTime"  class="form-control" id="eventStartTime" required>
                                </div>
                                <div class="col-md-6">
                                    <label class = "datetime"> End Time <font color="red">*</font></label>
                                    <input type="time" name="endTime"  class="form-control"  id="eventEndTime" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label class = "form-label"> Event Theme <font color="red">*</font></label>
                            {{ Form::text('theme', '', ['class' => 'form-control', 'placeholder' => 'Theme', 'required' => 'true'])}}
                        </div>

                        {{-- by 50s, 60s, 70, 80s etcc.. --}}
                        <div class="col-md-4 mb-3">
                            <label class = "form-label"> Is a Holiday<font color="red">*</font></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_holiday" id="exampleRadios1" value="0" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                    No
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_holiday" id="exampleRadios2" value="1">
                                <label class="form-check-label" for="exampleRadios2">
                                    Yes
                                </label>
                            </div>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label class = "form-label"> Venue <font color="red" >*</font></label>
                            <select name="venue" class = "form-control" onchange="venue_select()" id="location" required>
                                <option selected disabled>Please Select Location</option>
                                <option value="CVJ Clubhouse Ground Floor"> CVJ Clubhouse Ground Floor </option>
                                <option value="CVJ Clubhouse Second Floor"> CVJ Clubhouse Second Floor </option>
                                <option value="CVJ Clubhouse Third Floor"> CVJ Clubhouse Third Floor </option>
                                <option value="Off-Premise"> Off-Premise </option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div id="address_div" style="display: none">
                                <label class = "form-label" id="eventvenueL"> Address <font color="red" id="eventvenueA"></font></label>
                                <input type="text" class="form-control" PLACEHOLDER="Venue address" id="eventvenue" name="eventvenue">
                                <p class="small" style="color: #ff8300;">Off-Premise Venues adds a 15 % Service Charge to the total amount due.</p>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3"> <label class = "form-label"> Others </label>
                            {{ Form::textarea('others', '', ['class' => 'form-control', 'placeholder' => 'Others (Optional)'])}}
                        </div>
                        <div class="col-md-4 mb-3" id="emp_col" style="display: none;">
                            <label class = "form-label"> Assign Personnel to Event</label>
                            <select class="js-example-basic-multiple" id="select_emps" onchange="dropdown_change_listener()" name="emps[]" style="width: 100%;" multiple="multiple">
                            </select>
                            <small><br><a href="#" data-target="#empSchedModal"  data-toggle="modal"><i class="fa fa-eye"></i> View Shift Schedule.</a></small>
                            <script>
                                $(document).ready(function() {
                                    $('.js-example-basic-multiple').select2({
                                        //maximumSelectionLength: 10,
                                    });
                                });
                            </script>
                        </div>
                        <br>
                        <div class="col-md-12 mb-3">
                            <b id="warning_div" style="text-align: center;display: none;color: #ff4646"> Unable to proceed to next step. Please resolve the error.</b>
                            <div style="text-align:center;" id="submit_div">
                                <button type="submit" id="sumbit_btn" class="btn btn-success" disabled>Next: Select Packages</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
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
        </div>
    </div>
    </div>
@endsection

@push('js')

<script>

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

        if(start !== null){
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
        disp_personnel_sched(start.value);
        //show avail employees
    }
    function disp_avail_personnel(date){
        $.get("/avail_personnels_on_date/"+date, function(data, status){
            console.log("Data: " + data + "\nStatus: " + status);
            $("#select_emps").empty();
            data.forEach(function(entry) {
                console.log(entry);
                $("#select_emps").append('<option value="'+entry["emp_id"]+'">'+entry["fn"]+' '+entry["ln"]+'</option>');

            });
        });
    }
    function disp_personnel_sched(date){
        $.get("/get_all_personnel_sched_on_date/"+date, function(data, status){
            console.log("helloo: " + data + "\nStatus: " + status);
            $("#shift_tbl").empty();
            var datur = JSON.parse(data);
            $("#shift_lbl").html(datur.date_name + ' Shift');
            var scheds = datur.scheds;
            scheds.forEach(function(entry) {
                var str = '<tr><td>'+entry.name+'</td>';
                str +='<td>'+entry.shift_name+'</td>';
                str += '<td>'+entry.in+'</td><td>'+entry.out+'</td></tr>';
                $("#shift_tbl").append(str);
                console.log(entry);
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