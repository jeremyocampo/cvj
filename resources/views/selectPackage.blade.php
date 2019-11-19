 
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
                <a id="customize_package_url" href="{{route('additional_package',$event->event_id)}}/" class="btn btn-small btn-success">
                    <i class="fa fa-cart-plus"></i> Choose Package With Additions</a>
                <form action="{{route('post.selectpackages')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$event->event_id}}" name="event_id">
                    <input type="hidden" id="package_id" value="" name="package_id">
                    <button type="submit"  class="btn btn-small btn-primary">
                    <i class="fa fa-cart-arrow-down"></i> Choose Package</button>
                </form>
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
									<div class="col">
										<h3 class="mb-0" style="display: inline">Select Packages</h3>
                                        <a  style="display: inline" class="btn btn-sm btn-primary" href="{{route('customize_package',$event->event_id)}}/">+ Create New Package</a>
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
                            <div class="input-group mb-3" style="width: 35%">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="Number" step="any" id="filter_price" class="form-control" onkeyup="filter_price()" PLACEHOLDER="Place your budget for event here.">
                            </div>
                            <div class="row" id="package_row">
                                @foreach($packages as $package)
                                    @if($package->package_client_id == null or $package->package_client_id == $user_id)
                                            <div class="col-md-4 package_card" style="margin-bottom: 4vh" value="{{$package->price}}">
                                                <div class="card" style="width: 18rem;">
                                                    {{--
                                                    @if($package->package_client_id == $user_id)
                                                        <span class="badge badge-pill badge-success" style="background-color: green;color:white;position:absolute;top:65%;left:50%;">USER CUSTOM PACKAGE</span>
                                                    @endif
                                                    --}}
                                                    <img class="card-img-top" src="{{asset($package->package_img_url)}}" style="height: 25vh;width: 100%vw" alt="">
                                                    <div class="card-body">
                                                        <h3 class="card-title" style="margin-bottom: 0;"><a href="#"
                                                                package-name="{{$package->package_name}}"
                                                                package-id="{{$package->package_id}}"
                                                                data-food="@foreach($package->foods as $food){{$food->item_name}},{{asset($food->item_image)}}|@endforeach"
                                                                data-inventory="@foreach($package->inventory as $inv){{$inv->inventory_name}},{{$inv->quantity}}|@endforeach"
                                                                data-toggle="modal" data-target="#exampleModal" onclick="show_package(this)">{{$package->package_name}}</a></h3>
                                                        <div>
                                                            <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($package->price,2)}}</b>
                                                            <small>~ {{$package->suggested_pax}} pax</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endif
                                @endforeach
                            </div>
		                </div>
	  </div>
</div>
<script>
    let customize_route = '{{route('additional_package',$event->event_id)}}/';
    function show_package(obj) {
        let food_set = $(obj).attr('data-food').split('|');
        let inventory_set = $(obj).attr('data-inventory').split('|');

        $("#package_id").val($(obj).attr('package-id'));
        $("#customize_package_url").attr('href', customize_route + $(obj).attr('package-id'));
        $("#modal_package_title").html($(obj).attr('package-name'));
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
            inv_str += '<td>'+arr2[1]+' PCS</td></tr>';
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
