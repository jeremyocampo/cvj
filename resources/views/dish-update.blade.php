@extends('layouts.app')

@section('content')
    @include('layouts.headers.inventoryCard1')
    <div class="container-fluid mt--7">
        <div class="card-body">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <form method="POST" action="/dishes/{{ $dish->id }}">
                        @csrf
                        @method('PATCH')
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="">Update Item to Dishes</h1>
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
                                <label class="form-label">Item</label>
                                <select name="item_id" class="form-control" required>
                                    <option value = 0 selected disabled>Please Select an Item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->item_id }}" {{ $dish->item_id == $item->id ? "Selected" : "" }}>{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Dish Name</label>
                                <input type="text" class="form-control" name="dish_name" value="{{ $dish->dish_name }}" required />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Category</label>
                                <select name="dish_category" class="form-control" required>
                                    <option value = 0 selected disabled>Please Select a Category</option>
                                    <option value="Appetizer" {{ $dish->dish_category == "Appetizer" ? "Selected" : "" }}>Appetizer</option>
                                    <option value="Main Course"  {{ $dish->dish_category == "Main Course" ? "Selected" : "" }}>Main Course</option>
                                    <option value="Dessert"  {{ $dish->dish_category == "Dessert" ? "Selected" : "" }}>Dessert</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" step="any" name="quantity" value="{{ $dish->quantity }}" required />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Unit Cost</label>
                                <input type="number" class="form-control" step="any" name="unit_cost" value="{{ $dish->unit_cost }}" required />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Unit Expense</label>
                                <input type="number" step="any" class="form-control" name="unit_expense" value="{{ $dish->unit_expense }}" required />
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        {{-- @foreach($subcategoryIds as $subcategoryId)
                            <p>{{$subcategoryId}}</p>
                        @endforeach --}}

                        <div class="text-right">

                            {{ Form::submit('Update Item', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('dishes')}}" class="btn btn-default">Back</a>
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
