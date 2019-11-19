
@extends('layouts.app')
@section('content')
@include('layouts.headers.inventoryCard1')

<div class="modal fade" id="dishesModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="dishesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dishesModalLabel">Dishes Table</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" >
                    <b>Food</b>
                    <table class="table">
                        <thead>
                            <th></th>
                            <th></th>
                            <th>Name</th>
                        </thead>
                        <tbody id="mod_food_tbl">
                        @foreach($avail_foods as $avail_food)
                            <tr id="mod_food_row_{{$avail_food->item_id}}">
                                <td><a style="display: inline;color:white"
                                       data-food="{{$avail_food->item_id}},{{$avail_food->item_name}},{{asset($avail_food->item_image)}},{{$avail_food->unit_cost}}"
                                       class="btn btn-sm btn-primary" onclick="select_food(this)"> + </a></td>
                                <td><img  src="{{asset($avail_food->item_image)}}" style="height: 10vh;width: 10vw"></td>
                                <td>{{$avail_food->item_name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-small btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="invModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="invModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dishesModalLabel">Inventory Table</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <b>Items</b>
                    <table class="table">
                        <thead>
                        <th></th>
                        <th>Name</th>
                        <th>Cost/Unit</th>
                        </thead>
                        <tbody id="mod_inv_tbl">
                        @foreach($avail_invs as $avail_inv)
                            <tr id="mod_inv_row_{{$avail_inv->inventory_id}}">
                                <td><a style="display: inline;color:white"
                                       data-inv="{{$avail_inv->inventory_id}},{{$avail_inv->inventory_name}},{{$avail_inv->rental_cost}}"
                                       class="btn btn-sm btn-primary" onclick="select_inv(this)"> + </a></td>
                                <td>{{$avail_inv->inventory_name}}</td>
                                <td>{{$avail_inv->rental_cost}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-small btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="pckModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="invModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="pckModalLabel">Package Inclusion</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom: 2.5vh">
                    <h3 class="modal-title" id="pckModalLabel">{{$package->package_name}}</h3>
                    <h5 class="modal-title" id="pckModalLabel">[{{$event->venue}}] {{$event->event_detailsAddded}}</h5>

                    <h5 class="modal-title" id="pckModalLabel">~ {{$event->suggested_pax}} pax</h5>
                    <hr style="text-align: left;width: 35%;margin-left: 0;margin-top: 5px;margin-bottom: 5px;">
                    <h4 class="modal-title" id="pckModalLabel" style="color: #ff8d00">₱ {{number_format($package->price,2)}}</h4>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b>Food</b>
                        <table class="table">
                            <thead>
                            <th>Name</th>
                            </thead>
                            <tbody id="mod_food_tbl">
                            @if($package != null)
                                @foreach($package->foods as $food)
                                    <tr>
                                        <td>{{$food->item_name}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <b>Items & Misc</b>
                        <table class="table">
                            <thead>
                            <th>Name</th>
                            <th>Quantity</th>
                            </thead>
                            <tbody id="pck_inv_tbl">
                            @if($package != null)
                                @foreach($package->inventory as $inv)
                                    <tr>
                                        <td>{{$inv->inventory_name}}</td>
                                        <td>{{$inv->quantity}} </td>
                                    </tr>
                                @endforeach
                            @endif
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

                    <form method="post" action="{{route('post.create_with_additions')}}">

						<div class="card-header border-0">
                            <center style="margin-bottom: 5.5vh;"><h2 class="mb-0" >Input Additionals</h2></center>
								<div class="row">
									<div class="col-md-6">
                                        <div class="row" style="margin-bottom: 2.5vh;">
                                            <div class="col-md-4"><label>Package Chosen: </label></div>
                                            <div class="col-md-8">
                                                <span data-toggle="modal" data-target="#pckModal">
                                                    <a href="#" data-toggle="tooltip"  data-placement="top" title="View Package Inclusions"> <i class="fa fa-eye"></i> {{$package->package_name}}</a></div>
                                                </span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><label>Package Price: </label></div>
                                            <div class="col-md-8"><b>₱ {{number_format($package->price,2)}}</b></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label>Additional Dishes Total: P<span id="food_total_text">...</span></label>
                                        </div>
                                        <div>
                                            <label>Additional Items & Misc Total: P<span id="inv_total_text">...</span></label>
                                        </div>
                                        <hr style="margin: 0;">
                                        <h3 style="margin-top: 0;">Total Amount: <span id="total_package_price"></span></h3>
                                    </div>
								</div>
						</div>
						<div class="card-body border-0">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$event->event_id}}" name="event_id">
                                <input type="hidden" value="{{$user_id}}" name="client_id">
                                <input type="hidden" value="{{$venue_price}}" name="venue_price">
                                <input type="hidden" value="{{$package->package_id}}" name="package_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col" style="margin-bottom: 2vh;">
                                            <h3 class="mb-0" style="display: inline">Additional Dishes</h3>
                                            <a style="display: inline;color:white" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#dishesModal">+ Add Dishes</a>
                                        </div>
                                        <table class="table">
                                            <thead>
                                            <th>Dish</th>
                                            <th>Price</th>
                                            <th></th>
                                            </thead>
                                            <tbody id="food_tbl">

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col" style="margin-bottom: 2vh;">
                                            <h3 class="mb-0" style="display: inline">Additional Items & Misc</h3>
                                            <a  style="display: inline;color:white" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#invModal">+ Add Items</a>
                                        </div>
                                        <table class="table">
                                            <thead>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Price/Item</th>
                                            <th>Total Price</th>
                                            </thead>
                                            <tbody id="inv_tbl">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <center>
                                    <button type="submit" id="sumbit_btn" class="btn btn-primary" disabled>Submit</button>
                                </center>
                        </div>
                    </form>
	  </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
        <script>
            let total_pax = 50 {{--#where to get number of attendees?  @if($package != null) {{$package->price}} @else 50 @endif --}};
            let package_price = {{$package->price}};
            let inv_subtotal = 0;
            let food_subtotal = 0;
            $(document).ready(function () {
                compute_total_package_price();
            });
            function checkSubtotals() {
                if (parseFloat(inv_subtotal)===0 && parseFloat(food_subtotal)===0){
                    $("#sumbit_btn").attr("disabled",true);
                }
                else{
                    $("#sumbit_btn").attr("disabled",false);
                }
            }
            function select_food(obj) {
                let data_arr = $(obj).attr('data-food').split(',');
                let str ='<tr id="food_row_'+data_arr[0]+'"><input type="hidden" name="chosen_dishes[]" value="'+data_arr[0]+'">';
                str +='<td><a style="display: inline;color:white" class="food_item btn btn-sm btn-primary"';
                str+= ' data-food="'+$(obj).attr('data-food')+'"';
                str+= ' onclick="remove_food(this)">-</a>   '+data_arr[1]+'</td>';
                str+= '<td>'+(parseFloat(data_arr[3]) * parseFloat(total_pax))+'</td>';
                str+= '<td><img  src="'+data_arr[2]+'" style="height: 10vh;width: 10vw"></td>';
                str +='</tr>';
                $('#food_tbl').append(str);
                $('#mod_food_row_'+data_arr[0]).remove();

                compute_total_package_price();
            }
            function select_inv(obj) {
                let data_arr = $(obj).attr('data-inv').split(',');
                let str ='<tr id="inv_row_'+data_arr[0]+'"><input type="hidden" name="chosen_invs[]" value="'+data_arr[0]+'">';
                str +='<td><a style="display: inline;color:white" class=" btn btn-sm btn-primary"';
                str+= ' data-inv="'+$(obj).attr('data-inv')+'"';
                str+= ' onclick="remove_inv(this)">-</a>   '+data_arr[1]+'</td>';
                str+= '<td><input name="inv_qty[]"  data-rent_cost="'+data_arr[2]+'" data-inv_id="'+data_arr[0]+'" onchange="compute_total_package_price()" class="inv_qty form-control" style="height:3vh;" value="1" type="number"></td>';
                str+= '<td>'+data_arr[2]+'</td><td><b id="total_inv_'+data_arr[0]+'">'+data_arr[2]+'</td>';
                str +='</tr>';
                $('#inv_tbl').append(str);
                $('#mod_inv_row_'+data_arr[0]).remove();

                compute_total_package_price();
            }
            function remove_food(obj) {
                let data_arr = $(obj).attr('data-food').split(',');

                let str ='<tr id="mod_food_row_'+data_arr[0]+'">';
                str +='<td><a style="display: inline;color:white" class="btn btn-sm btn-primary"';
                str+= ' data-food="'+$(obj).attr('data-food')+'"';
                str+= ' onclick="select_food(this)"> + </a></td>';
                str+= '<td><img  src="'+data_arr[2]+'" style="height: 10vh;width: 10vw"></td>';
                str+= '<td>  '+data_arr[1]+'</td>';
                str +='</tr>';
                $('#mod_food_tbl').append(str);
                $('#food_row_'+data_arr[0]).remove();

                compute_total_package_price();
            }
            function remove_inv(obj) {
                let data_arr = $(obj).attr('data-inv').split(',');
                console.log("wackerty: "+data_arr);
                let str ='<tr id="mod_inv_row_'+data_arr[0]+'">';
                str +='<td><a style="display: inline;color:white" class="btn btn-sm btn-primary"';
                str+= ' data-inv="'+$(obj).attr('data-inv')+'"';
                str+= ' onclick="select_inv(this)"> + </a></td>';
                str+= '<td>'+data_arr[1]+'</td>';
                str+= '<td>'+data_arr[2]+'</td>';
                str +='</tr>';
                $('#mod_inv_tbl').append(str);
                $('#inv_row_'+data_arr[0]).remove();

                compute_total_package_price();
            }
            function compute_inv_qtys(){
                inv_subtotal = 0;
                $(".inv_qty").each(function () {
                    let tot = (parseFloat($(this).val()) * parseFloat($(this).attr('data-rent_cost')));
                    $('#total_inv_'+$(this).attr('data-inv_id')).html(parseFloat(tot).toFixed(2));
                    inv_subtotal = parseFloat(inv_subtotal) + tot;
                });
                $("#inv_total_text").html(parseFloat(inv_subtotal).toFixed(2));

            }
            function compute_food_total(){
                food_subtotal = 0;
                $(".food_item").each(function () {
                    let data_arr = $(this).attr('data-food').split(',');
                    food_subtotal = parseFloat(food_subtotal) + (parseFloat(data_arr[3]) * parseFloat(total_pax));
                });
                $("#food_total_text").html(parseFloat(food_subtotal).toFixed(2));

            }
            function calibrate_pax(obj) {
                if($(obj).val()<50){
                    alert('Minimum pax is for 50 persons.');
                    $(obj).val(50);
                }
                total_pax = $(obj).val();
                compute_total_package_price();
            }
            function compute_total_package_price(){
                compute_inv_qtys();
                compute_food_total();
                $("#total_package_price").html('P'+formatNumber(package_price+parseFloat(inv_subtotal)+parseFloat(food_subtotal)));
                checkSubtotals();
            }
            function formatNumber(num) {
                return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
            }
        </script>
@endsection