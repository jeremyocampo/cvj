@extends('layouts.eventApp')
@section('title', 'BookEvent')

{{-- @include('layouts.headers.pagination') --}}

@section('content') 
    @include('layouts.headers.eventsCard')

    <div class="container-fluid mt--7">
            {{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
            <div class="col-xl-12 mb-5">
                <div class="card shadow " >
                    <div class="card-header ">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="row">
                                <div class="col-xs-5">
                                    <h1 class="mb-0">Book Event</h1>
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
                        <div class="row">
                            <div class="col-md-12">
                                @if(session()->has('success'))
                                    <br>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                        {{ session()->get('success') }}<br>
                                    </div>
                                @endif
                            </div>
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