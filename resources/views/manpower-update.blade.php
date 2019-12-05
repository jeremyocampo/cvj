@extends('layouts.app')

@section('content')
    @include('layouts.headers.inventoryCard1')
    <div class="container-fluid mt--7">
        <div class="card-body">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <form action="/manpowers/{{ $manpower->id }}" method="POST">
                        @csrf
                        @method('PATCH')
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="">Update Manpower Record</h1>
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

                        @if(session()->has('warning'))
                            <br>
                            <div class="alert alert-warning" role="alert">
                                <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                {{ session()->get('warning') }}<br>
                            </div>
                        @endif

                        <div class="row">

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Agency</label>
                                <select name="agency_id" class="form-control" required>
                                    <option value = 0 selected disabled>Please Select agency</option>
                                    @foreach ($agencies as $agency)
                                        <option value="{{ $agency->agency_id }}" {{ $agency->id == $manpower->agency_id ? "Selected" : "" }}>{{ $agency->agency_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="employee_fn" value="{{ $manpower->employee_fn }}" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="employee_ln" value="{{ $manpower->employee_ln }}" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Employee Type</label>
                                <select class="form-control" name="employee_type" required>
                                    <option value="Waiter" {{ $manpower->employee_type === "Waiter" ? "Selected" : "" }}>Waiter</option>
                                    <option value="Host" {{ $manpower->employee_type === "Host" ? "Selected" : "" }}>Host</option>
                                    <option value="Head Waiter" {{ $manpower->employee_type === "Head Waiter" ? "Selected" : "" }}>Head Waiter</option>
                                    <option value="Server" {{ $manpower->employee_type === "Server" ? "Selected" : "" }}>Server</option>
                                    <option value="Logistics" {{ $manpower->employee_type === "Logistics" ? "Selected" : "" }}>Logistics</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required value="{{ $manpower->email }}" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Schedule</label>
                                <select name="schedule_id" class="form-control" required>
                                    <option value = 0 selected disabled>Please Select Schedule</option>
                                    @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule->id }}" {{ $manpower->schedule_id == $schedule->id }}>{{ $schedule->shift_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Contact No</label>
                                <input type="number" class="form-control" step="any" value="{{ $manpower->contact_no }}" name="contact_no" required />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control" rows="4">{{ $manpower->address }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        {{-- @foreach($subcategoryIds as $subcategoryId)
                            <p>{{$subcategoryId}}</p>
                        @endforeach --}}

                        <div class="text-right">

                            {{ Form::submit('Update Record', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('manpowers')}}" class="btn btn-default">Back</a>
                            {{-- {{Form::hidden('_method', 'PUT')}} --}}
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
