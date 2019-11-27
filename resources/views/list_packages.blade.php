 
@extends('layouts.app')
@section('content')
@include('layouts.headers.inventoryCard1')

<div class="modal fade" id="exampleModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70vw;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Package Inclusion:<b id="modal_package_title"></b></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <b>Food</b>
                        <table class="table">
                            <tbody id="food_tbl">
                            <td></td>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <b>Items & Misc</b>
                        <table class="table">
                            <tbody id="item_tbl">
                            <td></td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-small btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">
						<div class="card-header border-0">
								<div class="row align-items-center">
									<div class="col-md-12">
										<h3 class="mb-0" style="display: inline">List of Packages</h3>
                                        @if($user->userType == 4)
                                        <a  style="float:right" class="btn btn-sm btn-primary" href="/">+ Create New Package</a>
									    @endif
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
                                <table class="table  align-items-center  mb-3" id="myTable" >
                                <thead class="thead-light">
                                <tr>
                                    <th> Package Name </th>
                                    <th> Event Type </th>
                                    <th> Suggested Pax </th>
                                    <th> Price </th>
                                    <th> Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($packages as $package)
                                    <tr>
                                        <td>{{$package->package_name}}</td>
                                        <td>{{$package->event_type}}</td>
                                        <td>{{$package->suggested_pax}}</td>
                                        <td>P {{number_format($package->price,2)}}</td>

                                        <td class="popup">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                    Action
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                    <div class=" dropdown-header noti-title">
                                                        <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                    </div>
                                                    <a  class="dropdown-item" href="#"  data-toggle="modal"
                                                        package-name="{{$package->package_name}}"
                                                        package-id="{{$package->package_id}}"
                                                        data-food="@foreach($package->foods as $food){{$food->item_name}},{{asset($food->item_image)}}|@endforeach"
                                                        data-inventory="@foreach($package->inventory as $inv){{$inv->inventory_name}},{{$inv->quantity}},{{$inv->inv_avail}}|@endforeach"
                                                        onclick="show_package(this);" data-target="#exampleModal"><i class="fa fa-eye"></i> View Package</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a href="{{ url('inventory/create')}}" class="dropdown-item">
                                                        <i class="fa fa-edit"></i>
                                                        <span>Edit Package(testing)</span>
                                                    </a>
                                                </div>
                                            </div>
                                            {{-- <a class="btn btn-sm btn-primary" href="inventory/{{ $i->itemId }}/edit"> Replenish Item </a> mahaba--}}
                                        </td>
                                    </tr>


                                @endforeach
                                </tbody>
                            </table>
                            </div>

		                </div>
	  </div>
</div>
<script>
    function show_package(obj) {
        let food_set = $(obj).attr('data-food').split('|');
        let inventory_set = $(obj).attr('data-inventory').split('|');
        $("#package_id").val($(obj).attr('package-id'));
        $("#modal_package_title").html("  "+$(obj).attr('package-name'));
        $("#food_tbl").empty();
        $("#item_tbl").empty();
        for(let i = 0;i<food_set.length-1;i++){
            let arr1 = food_set[i].split(',');

            let food_str = '<tr><td>'+arr1[0]+'</td>';
            food_str += '<td> <img  src="'+arr1[1]+'" style="height: 10vh;width: 10vw"></td></tr>';
            $("#food_tbl").append(food_str);

        }
        for(let i = 0;i<inventory_set.length-1;i++){
            let arr2 = inventory_set[i].split(',');
            let inv_str = '<tr><td>'+arr2[0]+'</td>';
            inv_str += '<td>'+arr2[1]+' PCS';
            console.log(arr2[0]+":"+arr2[2]);
            if(parseInt(arr2[2]) === 0){
                console.log('entered?');
                inv_str +=' <span class="badge badge-danger">Insufficient Materials</span></td></tr>';
            }
            else{
                inv_str += '</td></tr>';
            };
            $("#item_tbl").append(inv_str);
        }
    }
    function filter_price() {
        // Declare variables
        let input = document.getElementById('filter_price');
        let packages = $(".package_card");
        if(input.value !== ""){
            let filter = parseFloat(input.value).toFixed(2);
            console.log("filter_price: "+filter);
            // Loop through all list items, and hide those who don't match the search query
            for (let i = 0; i < packages.length; i++) {
                let price_val = parseFloat(packages[i].getAttribute("value")).toFixed(2);

                console.log(price_val);
                if (parseFloat(price_val) <= parseFloat(filter)) {
                    packages[i].style.display = "block";
                } else {
                    packages[i].style.display = "none";
                }
            }
        }
        else{
            $(".package_card").each(function () {
                $(this).css("display","block")
            });
        }

    }
</script>
@endsection
