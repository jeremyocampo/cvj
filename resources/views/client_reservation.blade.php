
@extends('layouts.app')
@section('content')
@include('layouts.headers.inventoryCard1')

<div class="container-fluid mt--7">
    <div class="card-body">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0" style="text-align: right;padding: 1vh;margin:0;">
                    <a class="btn btn-sm btn-primary" onclick="PrintElem('printable')" href="#">
                        Print Reservation <i class="fa fa-print"></i>
                    </a>
                </div>

                <div class="card-body border-0" id="printable">
                    <style type="text/css" media="print">
                        @media print {

                            @page { size: legal}
                        }
                    </style>
                    <center>
                        <img src="{{ asset('argon') }}/img/brand/cvj.png" class="navbar-brand-img img-responsive" alt="..." height="100vh" width="175vw">
                        <br>
                        <div style="display: inline;width: 100%;">
                            <small><b>CVJ Food Catering</b></small><br>
                            <small>2nd Floor CVJ Clubhouse, 870 Eagle Street</small><br>
                            <small>New Marikina Subdivision, Marikina City</small><br>
                            <small>Phone: +639002334125</small>
                        </div>
                    </center>
                    <hr style="border: none; border-bottom: 2px solid #2b2b2b;">
                    <div class="row" style="margin-top: 0vh;">
                        <div class="card-body" style="margin: 0;">
                            <center><b>CONFIRMATION FOR A RESERVATION FOR A FOOD CATERING SERVICE</b><hr style="border: none; border-bottom: 1px solid #2b2b2b;width: 50%">
                            </center>
                            <div style="margin-top:5vh">
                            <br>
                                <label style="width:100%;">
                                    <div style="display:inline-block;width: 15%">Date of Function/Event: </div>
                                    <div style="display:inline-block;width:40%;border-bottom:1px solid #000000; padding-bottom:0px;"><center>{{$event->formatted_day}} </center></div>
                                    <div style="display:inline-block;width: 4%">Day: </div>
                                    <div style="display:inline-block;width:37%;border-bottom:1px solid #000000; padding-bottom:0px;"> <center>{{$event->day_name}}</center></div>
                                </label><br>

                                <label style="width:100%;">
                                    <div style="display:inline-block;width: 5%">Venue: </div>
                                    <div style="display:inline-block;width:52%;border-bottom:1px solid #000000; padding-bottom:0px;"> <center>[{{$event->venue}}] {{$event->event_detailsAdded}}</center></div>
                                    <div style="display:inline-block;width: 18%">Reservation Time: </div>
                                    <div style="display:inline-block;width:21%;border-bottom:1px solid #000000; padding-bottom:0px;"> <center>{{$event->formatted_start}} to {{$event->formatted_end}}</center></div>
                                </label><br>
                                <label style="width:100%;">
                                    <div style="display:inline-block;width: 9%">Occasion: </div>
                                    <div style="display:inline-block;width:24%;border-bottom:1px solid #000000; padding-bottom:0px;"> <center>{{$event->event_type}}</center></div>
                                    <div style="display:inline-block;width: 18%">Catering Package: </div>
                                    <div style="display:inline-block;width:45%;border-bottom:1px solid #000000; padding-bottom:0px;"><center><b>{{$package->package_name}} </b> @if($additional_count != 0) <i>with additions</i> </center>@endif</div>
                                </label><br>

                                <label style="width:100%;">
                                    <div style="display:inline-block;width: 20%">Signatory of Contract:  </div>
                                    <div style="display:inline-block;width:77%;border-bottom:1px solid #000000; padding-bottom:0px;"> {{$client->client_name}}</div>
                                </label><br>

                                <label style="width:100%;">
                                    <div style="display:inline-block;width: 15%">Address: : </div>
                                    <div style="display:inline-block;width:82%;border-bottom:1px solid #000000; padding-bottom:0px;"> {{$client->address}}</div>
                                </label><br>
                                <label style="width:100%;">
                                    <div style="display:inline-block;width: 18%">Contact Number: </div>
                                    <div style="display:inline-block;width:35%;border-bottom:1px solid #000000; padding-bottom:0px;"> <center>{{$client->mob_no}}</center></div>
                                    <div style="display:inline-block;width: 8%">Email: </div>
                                    <div style="display:inline-block;width:35%;border-bottom:1px solid #000000; padding-bottom:0px;">{{$client->email}}</div>
                                </label><br>

                            </div>
                            <br>
                            <label>Note / Terms of Payment</label><br>
                            <!-- Earl Please Encode Terms and Payment here-->
                            <div style="
                                  text-align: justify;
                                  text-justify: inter-word;">
                            <ul>
                                <li>
                                    This form serves an official Confirmation of Reservation by the above client with CVJ FOOD Catering. With this confirmation form, Client is required to pay a reservation fee of Twetnty Thousand Pesos (P20,000.00). Reservation fee is deductible from the total contract price. Likewise, the reservation fee is non-refundable, non-transferable and non-consumable.
                                </li>
                                <li>
                                    Other pertinent event details will be reflected on the Banquet Catering Contract after client finalizes party details. Client is required to finalize event details and sign the contract at least 2 month before the event date. This 50% payment is non-refundable, non-transferable, non-consumable.
                                </li>
                                <li>
                                    Full Payment is settled 1 week before the event date.
                                </li>
                                <li>
                                    Incase of cancellation, the following rules apply:
                                </li>
                            </ul>
                            <ul style="list-style-type: circle;margin-left: 7vw">
                                <li>
                                    If the client decides to cancel reservation for whatever reason – 3 months or more than 2 months before the event date, the Twenty Thousand Pesos (P 20,000.00) reservation fee shall be retained and forfeited in favor of the CVJ Food Catering.
                                </li>
                                <li>
                                    If the client decides to cancel reservation 2 months and or more than 1 month before the event date, a 50% payment (based on the balance amount of the availed package computation after the P 20,000.00 reservation fee) shall be paid by the client (If the client has not yet paid) or shall be retained (If client has settled the amount already) in favor of the CVJ.
                                </li>
                                <li>
                                    If client decides to cancel reservation 1 month and or more than 2 weeks before the event date, a 70% payment (based on the balance amount of the availed package computation after the P 20,000.00 reservation fee) shall be paid by the client (if client has not done payment yet) or shall be retained (if client has settled the amount already) in favor of the CVJ.
                                </li>
                                <li>
                                    If client decides to cancel 2 weeks or less before the event date, the client shall pay for the 80% of the balance amount of the availed package computation after the P 20,000.00 reservation fee.
                                </li>
                                <li>
                                    If the cancellation is made at the date of the event, the client shall pay for the full amount of the contract price.
                                </li>
                            </ul>
                            <!-- -->
                            </div>
                        </div>
                    </div>
                    <hr style="border-top: dotted 1px;">
                    <br>
                    <br>
                    <br style="margin-top:50px;">
                    <label style="width: 100%;margin-top:10vh;margin-bottom: 3vh;">
                        <div style="display:inline-block;width: 25%">Signature of Client </div>
                        <div style="display:inline-block;width: 8%">:</div>
                        <div style="display:inline-block;width:50%;border-bottom:1px solid #000000; padding-bottom:0px;"> </div>
                    </label><br><br>

                    <label style="width: 100%;margin-bottom: 3vh">
                        <div style="display:inline-block;width: 25%">Name in Print </div>
                        <div style="display:inline-block;width: 8%">:</div>
                        <div style="display:inline-block;width:50%;border-bottom:1px solid #000000; padding-bottom:0px;"> </div>
                    </label><br><br>

                    <label style="width: 100%;margin-bottom: 3vh">
                        <div style="display:inline-block;width: 25%">Date </div>
                        <div style="display:inline-block;width: 8%">:</div>
                        <div style="display:inline-block;width:50%;border-bottom:1px solid #000000; padding-bottom:0px;"> </div>
                    </label><br><br>

                    <div class="row" style="margin-top:5vh;width: 100%">
                        <div style="display:inline-block;width: 18%">Prepared By : </div>
                        <div style="display:inline-block;width:35%;border-bottom:1px solid #000000; padding-bottom:0px;"> </div>
                        <div style="display:inline-block;width: 8%"></div>
                        <div style="display:inline-block;width:35%;border-bottom:1px solid #000000; padding-bottom:0px;"></div>
                    </div>
                    <div class="row" style="width: 100%">
                        <div style="display:inline-block;width: 18%"></div>
                        <div style="display:inline-block;width: 35%"><center>CVJ Banquet Coordinator</center></div>
                        <div style="display:inline-block;width: 8%"></div>
                        <div style="display:inline-block;width: 35%"><center>CVJ Operations Manager/Accounting - Finance</center></div>

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