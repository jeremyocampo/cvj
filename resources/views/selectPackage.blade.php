


@extends('layouts.app')

@section('content')
@include('layouts.headers.inventoryCard1')
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header border-0">
								<div class="row align-items-center">
									<div class="col">
										<h3 class="mb-0">Select Packages</h3>
									</div>
									<div class="col alight-items-right">
										{{-- <h4>Last Replenished: {{$items[0]->last_modified}}</h4> --}}
									</div>
								</div>
								{{-- <div class="row alight-items-right">
									<h4>Last Replenished: {{$items[0]->last_modified}}</h4>
								</div> --}}
						</div>
						<div class="card-body border-0">
                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('success'))
                            <br>
                            <div class="alert alert-success" role="alert">
                                <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                {{ session()->get('success') }}<br>
                            </div>
                        @endif
                        @if(session()->has('deleted'))
                            <br>
                            <div class="alert alert-danger" role="alert">
                                <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                {{ session()->get('deleted') }}<br>
                            </div>
                        @endif
                    </div>
                </div>
								{{--  --}}
                  <div class="accordion mx-auto" id="accordionExample" style="max-width:1400px;">
                      <!-- use mx-auto to center content -->
                  <div class="card">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Package #1
                      </button>
                    </h5>
                  </div>

                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                          Chicken hotdog, Pusit na panis, Masarap na spaghetti, tunaw na ice cream at libreng jollibee
                    </div>
                  </div>
                  </div>
                  

                      
                  </div>
			      </div>
		    </div>
	  </div>
</div>
@endsection
<script>
	// function getTotal(){
	// 	var input = document.getElementById('qty').value;
	// 	var output = document.getElementById('inpQty');
	// 	output.value = input;
	// 	var current = document.getElementById('curQty').value;
	// 	var total = current+input;
	// 	document.getElementById('total').value = total;
	// }

	// $('input').on('keyup input', function () {
	// var actualQty = Number($("#curQty").val().trim());
	// var newQty = Number($("#qty").val().trim());
	// // var shipping = Number($("#shipping").val().trim());

	// var sum = (actual + newQty);
	// var result = sum;
	
	// $("#inpQty").val(result.toFixed(2));

	// });
	function getTotal(){
		var y = document.getElementById("curQty").value;
		var z = document.getElementById("qty").value;

		var x = parseInt(y) + parseInt(z);
		document.getElementById('inpQty').innerHTML = z;
		document.getElementById("total").innerHTML = x;
	}
</script>