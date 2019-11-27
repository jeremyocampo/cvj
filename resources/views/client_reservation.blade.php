
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
                        Print Reservation <i class="fa fa-print"></i>
                    </a>
                </div>

                <div class="card-body border-0" id="printable">
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
                    <hr style="height: 5px">
                    <div class="row" style="margin-top: 0vh;">
                        <div class="card-body" style="margin: 0;">
                            <center><b>CONFIRMATION FOR A RESERVATION FOR A FOOD CATERING SERVICE</b><hr style="width: 50%">
                            </center>
                            <div style="margin-top:5vh">
                            <br>
                                <label style="width:100%"> Date of Function/Event: <u>{{$event->formatted_day}} ({{$event->formatted_start}} to {{$event->formatted_end}})</u></label><br>
                                <label><u>[{{$event->venue}}] {{$event->event_detailsAdded}}</u></label><br>
                                <label>Event/Occasion: {{$event->event_name}}</label><br>
                                <label>Name of Party: {{$event->event_type}}</label><br>
                                <label>Catering Package: <b>{{$package->package_name}} </b> @if($additional_count != 0) <i>with additions</i> @endif</label><br>
                                <label>Number of Reservation: {{$package->suggested_pax}} pax</label><br>
                                <label>Signatory of Contract: {{$client->client_name}}</label><br>
                                <label>Address: {{$client->address}}</label><br>
                                <label>Contact Number: {{$client->mob_no}}</label><br>
                                <label>Email: {{$client->email}}</label><br>
                            </div>
                            <br>
                            <label>Note / Terms of Payment</label><br>
                            <!-- Earl Please Encode Terms and Payment here-->
                            <ul>
                                <li>Etits</li>
                                <li>Etits</li>
                                <li>Etits</li>
                                <li>In Case of cancellation please contact ..</li>
                            </ul>
                            <!-- -->
                        </div>
                    </div>
                    <hr style="border-top: dotted 1px;">
                    <small><i><fill here></i></small><br>
                    <label>Conforme / Signature of Client: _____________________________________</label><br>
                    <label>Name in Print: __________________________________________________</label><br>
                    <label>Date:               _________________________________________________________ </label>
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