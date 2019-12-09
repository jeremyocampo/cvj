@extends('layouts.eventApp')
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
                                var str =  '<option value="'+result.client_id+'" selected>';
                                str += $("#client_name").val();
                                str += '</option>';
                                $('#client_select').append(str);
                                alert('client '+$("#client_name").val()+' added');
                            }});
                    }
                </script>
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
                                <div class="col-xs-2">
                                        &nbsp;&nbsp;
                                </div>
                               
                                </div>
                            </div>
                            <!-- <div class="col text-right">
                                {{-- <a href="inventory/create" class="btn btn-sm btn-primary">Add Item</a> --}}
                                
                            </div> -->

                            <!-- <div class="col text-left">
                                {{-- <div class="row"> --}}
                                    <div class="col-xs-5">
                                {{-- <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here"> --}}
                                <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
                                    </div>
                                    {{-- <div class="col-xs-2">
                                        &nbsp; &nbsp;
                                    </div> --}}
                                    {{-- <div class="col-xs-3">
                                    <button type="button" class="btn btn-md btn-block" onclick="seachTable()">Search</button>
                                    </div> --}}
                                {{-- </div> --}}
                            </div> -->
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
                            {{-- {!! Form::open('action' => ['BookEventController@store', 'method' => 'POST', 'id' => 'bookevent']) !!} --}}
                            {!! Form::open(['action' => 'BookEventController@store', 'method' => 'POST']) !!}
                            {{-- <form action = "BookEventController@store" method = "POST"> --}}
                            {{ csrf_field() }}

                            <div class="col-md-4"> <h4> Event Name <font color="red">*</font></h4>
                                {{ Form::text('eventName', '', ['class' => 'form-control', 'placeholder' => 'Event Name', 'required' => 'true'])}}
                           </div>
                            
                           <div class="col-md-4"> <h4> Event Date <font color="red">*</font></h4>
                                   {{ Form::date('eventDate', '', ['class' => 'form-control', 'placeholder' => 'Date of Event', 'required' => 'true', 'min' => date("Y-m-d H:i:s")]) }} 
                           </div>

                           <div class="col-md-4"> <h4> Event Venue </h4>
                            <select name="eventVenue" class = "form-control" form = "bookevent">
                                <option disabled> - Please Select a Venue - </option>
                                    <option value="01"> CVJ Hall A </option>
                                    <option value="02"> CVJ Hall B </option>
                                    <option value="03"> CVJ Hall C </option>
                                    <option value="04"> CVJ Hall D </option>
                                    <option value="05"> Other Venue </option>
                            </select>
                            </div>
                                   
                           <div class="col-md-4"> <h4> Event Type <font color="red">*</font></h4>
                                   <select name="eventType" class = "form-control" form = "bookevent" onchange="toggle(this.value)">
                                       <option disabled> - Please Select Event Type - </option>
                                           <option value="Wedding"> Wedding </option>
                                           <option value="Birthday"> Birthdays </option>
                                           <option value="Debut"> Baptismal </option>
                                           <option value="Business"> Business </option>
                                           <option value="Corporate"> Corporate </option>
                                           <option value="Others"> Others </option>
                                   </select>
                           </div>
                           
                           {{-- Hidden Div for additional request --}}
                            <div class= "col-md-12 mb-3" id='test' style="display:none">
                                 {{ Form::text('eventType', '', ['class' => 'form-control', 'placeholder' => 'Others: Please Specify', 'required' => 'true'])}}
                            </div>

                            <div class="col-md-4"> <h4> Theme <font color="red">*</font></h4>
                                {{ Form::text('theme', '', ['class' => 'form-control', 'placeholder' => 'Theme', 'required' => 'true'])}}
                            </div>

                            <div class="col-md-4"> <h4> Centerpiece <font color="red">*</font></h4>
                                {{ Form::text('centerpiece', '', ['class' => 'form-control', 'placeholder' => 'Centerpiece', 'required' => 'true'])}}
                            </div>

                            <div class="col-md-4"> <h4> Flowers <font color="red">*</font></h4>
                                {{ Form::text('flowers', '', ['class' => 'form-control', 'placeholder' => 'Flowers', 'required' => 'true'])}}
                            </div>

                            <div class="col-md-4"> <h4> Linen Color <font color="red">*</font></h4>
                                {{ Form::text('linencolor', '', ['class' => 'form-control', 'placeholder' => 'Linen Color', 'required' => 'true'])}}
                            </div>
    
                            <div class="col-md-4"> <h4> Chair <font color="red">*</font></h4>
                                {{ Form::text('chair', '', ['class' => 'form-control', 'placeholder' => 'Chair', 'required' => 'true'])}}
                            </div>
    
                            <div class="col-md-4"> <h4> Table <font color="red">*</font></h4>
                                {{ Form::text('table', '', ['class' => 'form-control', 'placeholder' => 'Table', 'required' => 'true'])}}
                            </div>
    
                            <div class="col-md-4"> <h4> Others 
                                {{ Form::textarea('others', '', ['class' => 'form-control', 'placeholder' => 'Others (Optional)', 'required' => 'true'])}}
                            </div>

                            {{-- by 50s, 60s, 70, 80s etcc.. --}}
                            <div class="col-md-4"> <h4> Total Pax <font color="red">*</font></h4>
                                {{ Form::number('totalPax', '', ['class' => 'form-control', 'placeholder' => 'Total Pax', 'required' => 'true'])}}
                            </div>
    
                            {{-- <div class="col-md-4"> <h4> Package </h4>
                                <select name="package" class = "form-control"> 
                                    <option disabled> - Please Select a Package - </option>
                                    @if (count($packages) > 0)
                                        @foreach($packages as $package)
                                        <option value="{{$package->package_id}}" > {{$package->package_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="col-md-4"> <h4> Price per Head </h4>
                                {{ Form::number('priceHead', '', ['class' => 'form-control', 'placeholder' => 'Price per Head', 'required' => 'true'])}}
                            </div> --}}

                            <br>
                            <div class="col-md-12 mb-3">
                                    <p style="text-align:center">
                                         {{ Form::submit('Next: Add Book Event', ['class' => 'btn btn-success']) }} 
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

    function dropdown_change_listener() {
        let len = $(".js-example-basic-multiple :selected").length;
        if (len >= 5){
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
