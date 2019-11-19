
@extends('layouts.app')
@section('content')
@include('layouts.headers.inventoryCard1')
<style type="text/css" media="print">
    @page{size:auto;margin:5mm}
    @media print {
        @page { margin: 0; }
        body { margin: 1.6cm; }
    }
</style>
<div class="container-fluid mt--7">
    <div class="card-body">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0" style="text-align: right;padding: 1vh;margin:0;">
                    <a class="btn btn-sm btn-primary" onclick="PrintElem('printable')" href="#">
                        Print Quote <i class="fa fa-print"></i>
                    </a>
                </div>

                <div class="card-body border-0" id="printable">
                    <div class="row" style="width: 100%">
                        <div style="display: inline;width: 100%;">
                            <img src="{{ asset('argon') }}/img/brand/cvj.png" style="float:left" class="navbar-brand-img img-responsive" alt="..." height="100vh" width="175vw">

                            <small><b>CVJ Catering</b></small><br>
                            <small>2nd Floor CVJ Clubhouse, 870 Eagle Street</small><br>
                            <small>New Marikina Subdivision, Marikina City</small><br>
                            <small>Phone: +639002334125</small>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 6vh;">
                        <div class="card-body" style="margin: 0;">
                            <center >Quotation for <b>{{$client->client_name}}</b><br>
                                <small> {{$event->formatted_day}} ~ {{$package->suggested_pax}} pax</small><br>
                                <small>[{{$event->venue}}] {{$event->event_detailsAdded}} </small><br>
                                <small>Event Time: {{$event->formatted_start}} to {{$event->formatted_end}}</small>
                            </center>
                            <div style="margin-top:5vh">
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
                                        <li>{{$food->item_name}} - P {{number_format($food->total_price,2)}}</li>

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
                            <h4 style="display: inline-block;margin-bottom: 0.1vh;margin-top:1vh;">Package Price :</h4> <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($package->price,2)}}</b>
                        </div>
                        <div>
                            <h4 style="display: inline-block;margin-bottom: 0.1vh;margin-top:1vh;">Staffing Cost :</h4> <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($staff_cost,2)}}</b>
                        </div>
                        @if($additional_count != 0)
                            <div>
                                <h4 style="display: inline-block;margin-bottom: 0.1vh;margin-top:1vh;">Total Additionals :</h4>
                                <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($event->total_amount_due - $package->price,2)}}</b>
                            </div>
                        @endif
                        @if($is_off_premise)
                            <small>(Off-Premise) + 15% Service Charge</small><br>
                        @endif
                        <br>
                        <u> Amount Due:
                            <div>
                                <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($event->total_amount_due + $staff_cost,2)}}</b>
                            </div>
                        </u>
                    </div>


                </div>
            </div>
        </div>
<script>
    function PrintElem(elem)
    {
        var mywindow = window.open('', 'PRINT', 'height=600,width=800');

        mywindow.document.write('<html>');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('</html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        //mywindow.close();

        return true;
    }
    function printContent(el){
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $(print_content).css('size','auto');
        $(print_content).css('margin','auto');
        ;
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
</script>
@endsection