
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

<div class="container-fluid mt--7">
	<div class="card-body">
		<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="card shadow">

                    <form method="post" action="{{route('post.customize_package')}}">
                        @csrf
						<div class="card-header border-0">
                            <input type="hidden" name="package_id" value="@if($package != null) {{$package->package_id}} @else -1 @endif">
                            <center style="margin-bottom: 4.5vh;"><h2 class="mb-0" >@if($package != null)Edit <b>{{$package->package_name}}</b> @else Create New Package @endif </h2></center>
								<div class="row">
									<div class="col-md-6">
                                        <div class="row" style="margin-bottom: 2.5vh;">
                                            <div class="col-md-4"><label>Package Name</label></div>
                                            <div class="col-md-8"><input name="package_name" class=" form-control" type="text" placeholder="Describe Package" value="{{$package->package_name}}"></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4"><label>Event Type</label></div>
                                            <div class="col-md-8">
                                                <select name = "eventType"  id = "eventType" class = "form-control" required>
                                                    @if($package != null)<option value="{{$package->event_type}}" selected> {{$package->event_type}} </option> @else
                                                        <option disabled selected> - Please Select Event Type - </option> @endif
                                                    <option value="Wedding"> Wedding </option>
                                                    <option value="Birthday"> Birthday </option>
                                                    <option value="Debut"> Debut </option>
                                                    <option value="Business"> Business </option>
                                                    <option value="Corporate"> Corporate </option>
                                                    <option value="Others"> Others </option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4"><label>Suggested Pax</label></div>
                                            <div class="col-md-8">
                                                <select name="suggested_pax" onchange="change_pax(this)" class  = "form-control" >
                                                    @if($package != null)<option value="{{$package->suggested_pax}}" selected> {{$package->suggested_pax}} </option>@endif
                                                    <option value="50"> 50 </option>
                                                    <option value="70"> 70 </option>
                                                    <option value="80"> 80 </option>
                                                    <option value="100"> 100 </option>
                                                    <option value="150"> 150 </option>
                                                    <option value="200"> 200 </option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row" style="margin-top: 2vh">
                                            <div class="col-md-4"><label>Package Description</label></div>
                                            <div class="col-md-8">
                                                <textarea name="package_desc" class="form-control" placeholder="Describe package">@if($package != null){{$package->package_desc}} @endif</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">


                                        <div class="row" style="margin-top: 2vh">
                                            <div class="col-md-4"><label>Package Price</label></div>
                                            <div class="col-md-8"><input name="package_price" class=" form-control" id="package_price" type="number" value="@if($package != null){{$package->price}}@endif"></div>
                                        </div>
                                        <div class="row" style="margin-top: 2vh">
                                            <div class="col-md-4"><label>Markup Percent</label></div>
                                            <div class="col-md-8"><input name="package_markup" class=" form-control" id="markup" style="width: 90%;display: inline" onkeyup="compute_total_package_price()" type="number" value="@if($package != null){{$package->package_desc}}@else 150 @endif"><p style="display: inline">  %</p></div>
                                        </div>
                                        <br>
                                        <div>
                                            <label>Dishes Total: P<span id="food_total_text">...</span></label>
                                        </div>
                                        <div>
                                            <label>Inventory Total: P<span id="inv_total_text">...</span></label>
                                        </div>
                                        <hr style="margin: 0;">
                                        <h4 style="margin-top: 0;">Total Package Suggested Price: <span id="total_package_price"></span></h4>
                                        <!-- <small style="margin-top: 0;" id="perhead"></small> -->

                                    </div>
								</div>
						</div>
						<div class="card-body border-0">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$user_id}}" name="client_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col" style="margin-bottom: 2vh;">
                                            <h3 class="mb-0" style="display: inline">Package Dishes</h3>
                                            <a style="display: inline;color:white" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#dishesModal">+ Add Dishes</a>
                                        </div>
                                        <table class="table">
                                            <thead>
                                            <th>Dish</th>
                                            <th>Price</th>
                                            <th></th>
                                            </thead>
                                            <tbody id="food_tbl">
                                            @if($package != null)
                                                @foreach($package->foods as $food)
                                                    <tr id="food_row_{{$food->item_id}}">
                                                        <input type="hidden" name="chosen_dishes[]" value="{{$food->item_id}}">
                                                        <td><a style="display: inline;color:white" class="food_item btn btn-sm btn-primary"
                                                               data-food="{{$food->item_id}},{{$food->item_name}},{{asset($food->item_image)}},{{$food->unit_cost}}"
                                                               onclick="remove_food(this)">-</a>   {{$food->item_name}}</td>
                                                        <td>{{$food->unit_cost * $package->suggested_pax}} </td>
                                                        <td><img src="{{asset($food->item_image)}}" style="height: 10vh;width: 10vw"></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col" style="margin-bottom: 2vh;">
                                            <h3 class="mb-0" style="display: inline">Package Inventory</h3>
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
                                            @if($package != null)
                                                @foreach($package->inventory as $inv)
                                                    <tr id="inv_row_{{$inv->inventory_id}}">
                                                        <input type="hidden" name="chosen_invs[]" value="{{$inv->inventory_id}}">
                                                        <td><a style="display: inline;color:white" class="btn btn-sm btn-primary"
                                                               data-inv="{{$inv->inventory_id}},{{$inv->inventory_name}},{{$inv->rent_cost}}"
                                                               onclick="remove_inv(this)">-</a>   {{$inv->inventory_name}}</td>
                                                        <td><input name="inv_qty[]" data-rent_cost="{{$inv->rent_cost}}" onchange="compute_total_package_price()" data-inv_id="{{$inv->inventory_id}}" class="inv_qty form-control" style="height:3vh;" value="{{$inv->quantity}}" type="number"></td>
                                                        <td>{{$inv->rent_cost}}</td>
                                                        <td><b id="total_inv_{{$inv->inventory_id}}">{{$inv->quantity * $inv->rent_cost}}</b></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <center>
                                    <button type="submit" class="btn btn-sm btn-primary">Confirm</button>
                                </center>
                        </div>
                    </form>
	  </div>
</div>
<script>

    let total_pax = @if($package != null){{$package->suggested_pax}} @else 50 @endif;
    let inv_subtotal = 0;
    let food_subtotal = 0;
    $(document).ready(function () {
        compute_total_package_price();
    });
    /*
    $(".inv_qty").on('change', function () {
        compute_inv_qtys();
        console.log($(".inv_qty"));
    });
    */
    function change_pax(sel) {
        var old_pax = total_pax;
        total_pax = $(sel).val();
        $('.food_price_td').each(function(i, obj) {
            var price_each = parseFloat($(obj).text())/old_pax;
            $(obj).html(total_pax * price_each);
        });
        compute_total_package_price();
    }
    function calibrate_suggested_price(total_package_price) {
       const markup_perc = $("#markup").val()/100;
       let markup_multiplier = 1 + markup_perc;
       return parseFloat(total_package_price * markup_multiplier);
    }
    function select_food(obj) {
        let data_arr = $(obj).attr('data-food').split(',');
        let str ='<tr id="food_row_'+data_arr[0]+'"><input type="hidden" name="chosen_dishes[]" value="'+data_arr[0]+'">';
        str +='<td><a style="display: inline;color:white" class="food_item btn btn-sm btn-primary"';
        str+= ' data-food="'+$(obj).attr('data-food')+'"';
        str+= ' onclick="remove_food(this)">-</a>   '+data_arr[1]+'</td>';
        str+= '<td class="food_price_td">'+(parseFloat(data_arr[3]) * parseFloat(total_pax))+'</td>';
        str+= '<td><img  src="'+data_arr[2]+'" style="height: 10vh;width: 10vw"></td>';
        str +='</tr>';
        $('#food_tbl').append(str);
        $('#mod_food_row_'+data_arr[0]).remove();

        compute_total_package_price();
    }
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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

        $("#total_package_price").html('P '+numberWithCommas(calibrate_suggested_price(parseFloat(inv_subtotal)+parseFloat(food_subtotal))));
        //$("#total_package_price").html('P '+numberWithCommas(calibrate_suggested_price(venue+parseFloat(inv_subtotal)+parseFloat(food_subtotal))));
    }
</script>
@endsection