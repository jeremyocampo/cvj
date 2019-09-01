@extends('layouts.eventsApp')
@section('title', 'Register Account')

@section('content') 

@include('layouts.headers.eventmanagement')


<div class = "container-fluid mt--7">
    <div class="card-body">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header boarder-0">
                        @foreach($errors->all() as $error)
                        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                            <span class="badge badge-pill badge-danger ">Error</span>
                                {{ $error }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        @endforeach
                        
                       
                        

                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0"> Client Register </h3>
                        </div>
                    </div>
                    <div class = "card-body border-0"> 
                        {!! Form::open(['action' => 'ClientRegisterController@store', 'method' => 'POST']) !!}
                        {{-- <form action = "BookEventController@store" method = "POST"> --}}
                        {{-- {{ csrf_field() }} --}}
                        
                        <div class= "col-md-12 mb-3"> <h4> First Name <font color="red">*</font></h4>
                             {{ Form::text('clientFName', '', ['class' => 'form-control', 'placeholder' => 'Enter First Name', 'required' => 'true'])}}
                        </div>

                        <div class= "col-md-12 mb-3"> <h4> Last Name <font color="red">*</font></h4>
                            {{ Form::text('clientLName', '', ['class' => 'form-control', 'placeholder' => 'Enter Last Name', 'required' => 'true'])}}
                       </div>

                       <div class= "col-md-12 mb-3"> <h4> Email <font color="red">*</font></h4>
                            {{ Form::email('clientEmail', '', ['class' => 'form-control', 'placeholder' => 'Enter Email', 'required' => 'true'])}}
                       </div>

                       <div class= "col-md-12 mb-3"> <h4> Username <font color="red">*</font></h4>
                            {{ Form::text('client_id', '', ['class' => 'form-control', 'placeholder' => 'Enter Username', 'required' => 'true' ])}}
                       </div>

                       <div class= "col-md-12 mb-3"> <h4> Password <font color="red"> * </font></h4>
                            {{ Form::password('clientPassword', ['id' => 'clientPassword', 'class' => 'form-control', 'placeholder' => 'Enter Password', 'required' => 'true' ])}}
                       </div>
                        
                       <div class= "col-md-12 mb-3"> <h4> Confirm Password <font color="red"> * </font></h4>
                            {{ Form::password('clientPassword_confirmation', ['id' => 'clientPassword_confirmation', 'class' => 'form-control', 'placeholder' => 'Confirm Password', 'required' => 'true'])}}
                        <span id='message'></span>   
                       </div>
                         
                        <div class= "col-md-12 mb-3"> <h4> Tel no <font color="red">*</font></h4>
                            {{ Form::number('telNo', '', ['class' => 'form-control', 'placeholder' => 'Enter Tel Number', 'required' => 'true', 'min' => '1000000', 'max' => '9999999'])}}
                       </div>
                                
                       <div class= "col-md-12 mb-3"> <h4> Fax no</h4>
                            {{ Form::number('faxNo', '', ['class' => 'form-control', 'placeholder' => 'Enter Fax Number (Optional)',  'min' => '1000000', 'max' => '9999999'])}}
                       </div>

                       <div class= "col-md-12 mb-3"> <h4> Mobile no <font color="red">*</font></h4>
                            {{ Form::number('mobileNo', '', ['class' => 'form-control', 'placeholder' => 'Enter Mobile Number', 'required' => 'true', 'min' => '9000000000', 'max' => '9999999999'])}}
                       </div>
                      
                        <div class= "col-md-12 mb-3"> <h4> Address </h4>
                            {{ Form::text('clientAddress', '', ['class' => 'form-control', 'placeholder' => 'Enter Address', 'required' => 'true'])}}
                        </div>
                         
                        <br>
                        <div class="col-md-12 mb-3">
                           <p align = 'center'> {{ Form::submit('Next: Add Book Event', ['class' => 'btn btn-success'])}} </p>
                        </div>

                         {!! Form::close() !!} 
                    </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

$('document').ready(function() {
    $("#clientPassword_confirmation").keyup(function(){
    if (document.getElementById('clientPassword').value ==
        document.getElementById('clientPassword_confirmation').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Passwords match!';
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Password does not match!';
    }
    });

});


</script>
@endsection