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
                                    <h1 class="">Book Event</h1>
                                </div>
                                <div class="col-xs-2">
                                        &nbsp;&nbsp;
                                </div>
                               
                                </div>
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
                            </div>
                        </div>
                            {{-- {!! Form::open('action' => ['BookEventController@store', 'method' => 'POST', 'id' => 'bookevent']) !!} --}}
                            {!! Form::open(['action' => 'BookEventController@store', 'method' => 'POST']) !!}
                            {{-- <form action = "BookEventController@store" method = "POST"> --}}
                            {{ csrf_field() }}

                            <div class="card-body border-0"></div>

                         <div class="row">
                            <div class="col-md-5 mb-3">
                                 <label class = "form-label"> Event Name <font color="red">*</font></label>
                                {{ Form::text('eventName', '', ['class' => 'form-control', 'placeholder' => 'Event Name', 'required' => 'true'])}}
                           </div>

                           <div class="col-md-4 mb-3"> 
                                <label class = "form-label"> Event Type <font color="red">*</font></label>
                                <input list = "eventType" name="eventType" class = "form-control" form = "bookevent" onchange="toggle(this.value)">
                                 <datalist id ="eventType">    
                                    <option disabled> - Please Select Event Type - </option>
                                    <option value="Wedding"> Wedding </option>
                                    <option value="Birthday"> Birthday </option>
                                    <option value="Debut"> Debut </option>
                                    <option value="Business"> Business </option>
                                    <option value="Corporate"> Corporate </option>
                                    <option value="Others"> Others </option>
                                
                            </datalist>
                       </div>

                       {{-- Hidden Div for additional request --}}
                           <div class="col-md-3 mb-3" id='test' style="display:none">
                                 {{ Form::text('eventType', '', ['class' => 'form-control', 'placeholder' => 'Others: Please Specify', 'required' => 'true'])}}
                            </div>

                           <div class="col-md-5 mb-3">
                                <label class = "form-label"> Event Start Date <font color="red">*</font></label>
                                   {{ Form::date('eventDate', '', ['class' => 'form-control', 'placeholder' => 'Date of Event', 'required' => 'true', 'min' => date("Y-m-d H:i:s")]) }} 
                           </div>

                           <div class="col-md-4 mb-3">
                                <label class = "form-label"> Event End Date <font color="red">*</font></label>
                                   {{ Form::date('eventDate', '', ['class' => 'form-control', 'placeholder' => 'Date of Event', 'required' => 'true', 'min' => date("Y-m-d H:i:s")]) }} 
                           </div>
                           
                           
                            {{-- <div class="col-md-3 mb-3"></div>
                            <div class="col-md-3 mb-3"> --}}

                           {{-- <div class="col-md-4"> <h4> Event Venue </h4>
                            <select name="eventVenue" class = "form-control" form = "bookevent">
                                <option disabled> - Please Select a Venue - </option>
                                    <option value="01"> CVJ Hall A </option>
                                    <option value="02"> CVJ Hall B </option>
                                    <option value="03"> CVJ Hall C </option>
                                    <option value="04"> CVJ Hall D </option>
                                    <option value="05"> Other Venue </option>
                            </select>
                            </div> --}}
                            
                            <div class="col-md-5 mb-3">                                
                                <label class = "form-label"> Event Theme <font color="red">*</font></label>
                                {{ Form::text('theme', '', ['class' => 'form-control', 'placeholder' => 'Theme', 'required' => 'true'])}}
                            </div>

                            
                           {{-- by 50s, 60s, 70, 80s etcc.. --}}
                           <div class="col-md-4 mb-3"> 
                               <label class = "form-label"> Total Pax <font color="red">*</font></label>
                               <select name="totalPax" class = "form-control" form = "bookevent">
                                        <option value="01"> 50 </option>
                                        <option value="02"> 80 </option>
                                        <option value="03"> 100 </option>
                                        <option value="04"> more than 100 </option>
                                </select>
                                {{-- {{ Form::number('totalPax', '', ['class' => 'form-control', 'placeholder' => 'Total Pax', 'required' => 'true'])}} --}}
                            </div>
                           

                             
                            

                            <div class="col-md-5 mb-3"> <label class = "form-label"> Others </label>
                                {{ Form::textarea('others', '', ['class' => 'form-control', 'placeholder' => 'Others (Optional)'])}}
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