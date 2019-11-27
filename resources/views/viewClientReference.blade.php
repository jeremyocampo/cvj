@extends('layouts.app')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                {!! Form::open(['action' => 'InventoryController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!}
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <h1 class="">Edit Client Reference</h1>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    
                                    <label class="form-labal"><b>Date Created:</b> {{ $date_created }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body border-0">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            <button type = button data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                {{ $error }}
                            <br>
                        </div>
                    @endforeach
                    @if(session()->has('warning'))
                        <br>
                        <div class="alert alert-warning" role="alert">
                            <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                {{ session()->get('warning') }}<br>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Client Name</label>
                            <input type="text" name="client_name" id="client_name" value ="{{ $client->client_name }}" placeholder="example: Juan Dela Cruz" required class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="email" value ="{{ $client->email }}" placeholder="example: JuanDelaCruz@gmail.com" required class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telephone Number</label>
                            <input type="text" name="tel_no" id="tel_no" value ="{{ $client->tel_no }}" placeholder="example: 8011234" required class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" name="mob_no" id="mob_no" value ="{{ $client->mob_no }}" placeholder="emaple: 09171234567" required class="form-control">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" id="address" value ="{{ $client->address }}" placeholder="example: Leon Guinto, Taft Ave., Malate, Manila" required class="form-control">
                        </div>
                        <div class="col-md-3 mb-3"></div>
                    </div>
                </div>
                <div class="card-footer text-muted">
                        <div class="text-right">
                        {{ Form::submit('Submit  Changes', ['class' => 'btn btn-success']) }}
                        <a href="{{ url('client')}}" class="btn btn-default">Back to View Client List</a>
                        </div>
                </div>
                {!! Form::close() !!}
            </div>
		</div>
	</div>
</div>
@endsection

<script>
	function getSelected(){

		// // get references to select list and display text box
		// var sel = document.getElementById('category');
		// var el = document.getElementById('display');

		// function getSelectedOption(sel) {
		// 	var opt;
		// 	for ( var i = 0, len = sel.options.length; i < len; i++ ) {
		// 		opt = sel.options[i];
		// 		if ( opt.selected === true ) {
		// 			break;
		// 		}
		// 	}
		// 	return opt;

		// assign onclick handlers to the buttons
		// document.getElementById('showVal').onclick = function () {
		// 	el.value = sel.value;    
		// }
	}
	$('#selectField').change(function(){
    if($('#selectField').val() == 'N'){
        $('#secondaryInput').hide();
    } else {
        $('#secondaryInput').show();
	}
	});


</script>
