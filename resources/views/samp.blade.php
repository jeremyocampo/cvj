<html>
<body>
    <div style="display: inline;width: 100%;">
        <small><b>CVJ Catering</b></small><br>
        <small>2nd Floor CVJ Clubhouse, 870 Eagle Street</small><br>
        <small>New Marikina Subdivision, Marikina City</small><br>
        <small>Phone: +639002334125</small>
    </div>
    <div>
        <div>
            <center >Client Event Quotation for <b>{{$client->client_name}}</b><br>
                <label> {{$event->formatted_day}} ~ {{$package->suggested_pax}} pax</label><br>
                <label>[{{$event->venue}}] {{$event->event_detailsAdded}} </label><br>
                <label>Event Time: {{$event->formatted_start}} to {{$event->formatted_end}}</label>
            </center>
            <div>
                @if($is_off_premise)
                    (Off-Premise)
                @else
                    (In-Premise)
                @endif
                <br>
                <label>Event Name: <b>{{$event->event_name}}</b></label><br>
                <label>Package Chosen: <b>{{$package->package_name}} </b> @if($additional_count != 0) with additions @endif</label>
            </div>
            <br>
            <u> DISHES </u>
            <br>
            <label>Package Inclusion:</label>
            <ul>
                @foreach($package->foods as $food)
                    <li>{{$food->item_name}}</li>
                @endforeach
            </ul>
            @if($additional_count != 0)
                <i>Additionals:</i>
                <ul>
                    @foreach($additional_dishes as $food)
                        <li>{{$food->item_name}} for {{$package->suggested_pax}} pax- P {{number_format($food->total_price,2)}}</li>

                    @endforeach
                </ul>
            @endif
            <br>
            <u> ITEMS & MISC (SERVICES)</u>
            <br>
            <label>Package Inclusion:</label>
            <ul>
                @foreach($package->inventory as $inv)
                    <li>{{$inv->inventory_name}} [{{$inv->quantity}} PC/S]</li>
                @endforeach
            </ul>
            @if($additional_count != 0)
                <i>Additionals:</i>
                <ul>
                    @foreach($additional_invs as $inv)
                        <li>{{$inv->inventory_name}} [{{$inv->qty}} PC/S] - <small> P{{$inv->rent_price}} per PCS = P {{number_format($inv->qty * $inv->rent_price,2 )}}</small></li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <hr style="border-top: dotted 1px;">
    <div style="text-align: right">
        <div>
            <h4 style="display: inline-block;">Package Price :</h4> <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($package->price,2)}}</b>
        </div>

        @if($additional_count != 0)
            <div>
                <h4 style="display: inline-block;margin-bottom: 0px;margin-top:0px;">Total Additionals :</h4>
                <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($add_dish_total + $add_inv_total,2)}}</b>
            </div>
        @endif
        @if($is_off_premise)
            <div>
                <h4 style="display: inline-block;margin-bottom: 0px;margin-top:0px;">Off-Premise Service Charge (15%) :</h4>
                <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($event->off_premise_amount,2)}}</b>
            </div>
        @endif
        <div>
            <h4 style="display: inline-block;margin-bottom: 0px;margin-top:0px;">VAT Amount (12%) :</h4> <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($event->total_amount_due*.12,2)}}</b>
        </div>
        <br>
        <u>
            <div>
                <span style="display: inline-block;margin-bottom: 0px;margin-top:0px;">Amount Due: PHP</span> <b style="display: inline-block">{{number_format($event->total_amount_due*1.12,2)}}</b>
            </div>
        </u>
    </div>

</body>
</html>