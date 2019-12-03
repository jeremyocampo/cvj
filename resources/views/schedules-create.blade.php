@extends('layouts.app')

@section('content')
    @include('layouts.headers.inventoryCard1')
    <div class="container-fluid mt--7">
        <div class="card-body">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    {!! Form::open(['action' => 'SchedulesController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!}
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="">Add New Schedule</h1>
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
                                <label class="form-label">Shift Name</label>
                                <input type="text" class="form-control" name="shift_name" required />
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Monday Time From</label>
                                <input type="time" class="form-control" name="monday_in_time" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time To</label>
                                <input type="time" class="form-control" name="monday_out_time" required />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tuesday Time From</label>
                                <input type="time" class="form-control" name="tuesday_in_time" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time To</label>
                                <input type="time" class="form-control" name="tuesday_out_time" required />
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Wednesday Time From</label>
                                <input type="time" class="form-control" name="wednesday_in_time" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time To</label>
                                <input type="time" class="form-control" name="wednesday_out_time" required />
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thursday time From</label>
                                <input type="time" class="form-control" name="thursday_in_time" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time To</label>
                                <input type="time" class="form-control" name="thursday_out_time" required />
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Friday Time From</label>
                                <input type="time" class="form-control" name="friday_in_time" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time To</label>
                                <input type="time" class="form-control" name="friday_out_time" required />
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Saturday Time From</label>
                                <input type="time" class="form-control" name="saturday_in_time"  />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time To</label>
                                <input type="time" class="form-control" name="saturday_out_time"  />
                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sunday Time From</label>
                                <input type="time" class="form-control" name="sunday_in_time"  />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time To</label>
                                <input type="time" class="form-control" name="sunday_out_time"  />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Availability</label>
                                <select name="is_available" class="form-control" required>
                                    <option value = 0 selected disabled>Please Select Availability</option>
                                    <option value="0">Not Available</option>
                                    <option value="1">Available</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        {{-- @foreach($subcategoryIds as $subcategoryId)
                            <p>{{$subcategoryId}}</p>
                        @endforeach --}}

                        <div class="text-right">

                            {{ Form::submit('Add Schedule', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('schedules')}}" class="btn btn-default">Back</a>
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
