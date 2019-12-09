@extends('layouts.inventoryApp')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-8 mb-5 mb-xl-0">
				<div class="card shadow">
						{!! Form::open(['action' => 'InventoryController@store', 'method' => 'POST', 'autocomplete' =>'off']) !!}
						<div class="card-header">
								<div class="row align-items-center">
									<div class="col">
										<h1 class="">Add Food to Inventory</h1>
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
								<div class="col-md-8 mb-3">
									<label class="form-label">Food Name</label>
									{{ Form::text('foodName', '',['class' => 'form-control', 'placeholder' => 'Food Name'] )}}
								</div>
								<div class="col-md-4 mb-3">
                                    <label class="form-label">Item Price (Php)</label>
									{{ Form::number('price', '',['class' => 'form-control', 'placeholder' => 'Item Price' , 'type' => 'number' , 'min' => 1 , 'step' => 0.01] )}}
                                </div>
								<div class="col-md-12">
									<div class="set-form">
                                        <table id="myTable" class="table table-bordered">
                                          <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                          </tr>
                                          <tr>
                                            <td>
                                              <textarea name="Question" placeholder="Question" th:field="${questionAnswerSet.question}" id="question" style="resize: none; width: 100%;"></textarea>
                                            </td>
                                            <td>
                                              <textarea name="Answer" placeholder="Answer" th:field="${questionAnswerSet.answer}" id="answer" style="resize: none; width: 100%;"></textarea>
                                            </td>
                                          </tr>
                                        </table>
                                        <div class="col-md-12 mt-3">
                                            <div class="text-center">
                                                <input type="button" id="more_fields" onclick="add_fields();" value="+ Add Row" class="btn btn-secondary" />
                                            </div>
                                        </div>
								</div>
							</div>
						</div>
						<div class="card-footer text-muted">
								{{-- @foreach($subcategoryIds as $subcategoryId)
									<p>{{$subcategoryId}}</p>
								@endforeach --}}

								<div class="text-right">
								
								{{ Form::submit('Add Item', ['class' => 'btn btn-success']) }}
								<a href="{{ url('inventory')}}" class="btn btn-default">Back</a>
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
		}

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

    function add_fields() {    
        document.getElementById("myTable").insertRow(-1).innerHTML = 
        '<tr><td><input class="form-control" name="ingredientName" placeholder="Question" th:field="${questionAnswerSet.question}"></textarea></td><td><input class="form-control" name="quantity" placeholder ="Answer" field="${questionAnswerSet.answer}"></textarea></td ><td><input class="form-control" name="price" placeholder="Price" disabled></td></tr>';
    }


</script>