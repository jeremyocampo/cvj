@extends('layouts.app')
@section('title', 'BookEvent')

{{-- @include('layouts.headers.pagination') --}}

@section('content') 
    @include('layouts.headers.eventsCard')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <div class="container-fluid mt--7">
            {{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
            <div class="col-xl-12 mb-5">
                <div class="card shadow " >
                    <div class="card-header ">
                        {{-- <div class="row align-items-center"> --}}
                            <div class="row">
                            
                                <div class="col-xs-12 mb-3">
                                    <h1 class="">Book Event <br> </h1>
                                </div>
                                <div class="col-xs-2">
                                    <p>for {{ $client[0]->client_name }}</p>
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
                            {{-- {!! Form::open('action' => ['BookEventController@store', 'method' => 'POST', 'id' => 'bookevent']) !!} --}}
                            {!! Form::open(['action' => 'BookEventController@store', 'method' => 'POST']) !!}
                            {{-- <form action = "BookEventController@store" method = "POST"> --}}
                            {{-- {{ csrf_field() }} --}}
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
                                 <label class = "form-label"> Event Name <font color="red">*</font></label>
                                {{ Form::text('eventName', '', ['class' => 'form-control', 'placeholder' => 'Event Name', 'required' => 'true'])}}
                           </div>

                           <div class="col-md-4 mb-3"> 
                                <label class = "form-label"> Event Type <font color="red">*</font></label>
                                <select name = "eventType"  id = "eventType" class = "form-control">
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
                               <input type="date" name="eventStartDate" onchange="checkdates()" class="form-control" placeholder="Start date" id="eventStartDate">
                               <p id="invalid_msg" class="small" style="color: #ff5153;display: none;">This date is already overbooked. Please consider booking another day or cancel booking event.</p>
                           </div>

                           <div class="col-md-4 mb-3">
                               <div class="row">
                                   <div class="col-md-6">
                                    <label class = "datetime"> Start Time <font color="red">*</font></label>
                                       <input type="time" name="startTime" onchange="checkdates()" class="form-control" id="eventStartTime">
                                   </div>
                                   <div class="col-md-6">
                                       <label class = "datetime"> End Time <font color="red">*</font></label>
                                       <input type="time" name="endTime" onchange="checkdates()" class="form-control"  id="eventEndTime">
                                   </div>
                               </div>
                           </div>
            
                            <div class="col-md-5 mb-3">                                
                                <label class = "form-label"> Event Theme <font color="red">*</font></label>
                                {{ Form::text('theme', '', ['class' => 'form-control', 'placeholder' => 'Theme', 'required' => 'true'])}}
                            </div>

                           {{-- by 50s, 60s, 70, 80s etcc.. --}}
                           <div class="col-md-4 mb-3"> 
                               <label class = "form-label"> Number of Attendees <font color="red">*</font></label>
                               <select name="totalPax" class = "form-control" >
                                    <option selected disabled>Please Select Number of Attendees</option>
                                    <option value=50> 50 </option>
                                    <option value=80> 80 </option>
                                    <option value=100> 100 </option>
                                    <option value=101> more than 100 </option>
                                </select>
                            </div>

                            <div class="col-md-5 mb-3"> 
                                <label class = "form-label"> Venue <font color="red" >*</font></label>
                                <select name="venue" class = "form-control" onchange="venue_select()" form = "bookevent" id="location" value="0">
                                     <option value="0" selected disabled>Please Select Location</option>
                                         <option value="CVJ Clubhouse Ground Floor"> CVJ Clubhouse Ground Floor </option>
                                         <option value="CVJ Clubhouse Second Floor"> CVJ Clubhouse Second Floor </option>
                                         <option value="CVJ Clubhouse Third Floor"> CVJ Clubhouse Third Floor </option>
                                         <option value="4"> Off-Premise </option>
                                 </select>
                             </div>
                            <div class="col-md-4 mb-3">
                                    <div id="address_div" style="display: none">
                                        <label class = "form-label" id="eventvenueL"> Address <font color="red" id="eventvenueA"></font></label>
                                        {{ Form::text('eventvenue', '', ['class' => 'form-control', 'placeholder' => 'Venue Address', 'required' => 'false', 'id' => 'eventvenue'])}}
                                    </div>
                            </div>
                            <div class="col-md-5 mb-3"> <label class = "form-label"> Others </label>
                                {{ Form::textarea('others', '', ['class' => 'form-control', 'placeholder' => 'Others (Optional)'])}}
                            </div>
                            <br>

                            <div class="col-md-12 mb-3">
                                    <b id="warning_div" style="text-align: center;display: none;color: #ff4646"> Unable to proceed to next step. Please resolve the error.</b>
                                    <p style="text-align:center" id="submit_div">
                                         {{ Form::submit('Next: Select Packages', ['class' => 'btn btn-success']) }} 
                                    </p>
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
    function venue_select(){
        if($("#location").val() === "4"){
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

        if(start !== null && $("#eventStartTime").val() !== "" && $("#eventEndTime").val() !== ""){
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

        }
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