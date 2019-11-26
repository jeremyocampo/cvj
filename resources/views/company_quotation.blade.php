
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
                        <select style="width: 25%;" id = "eventType">
                            <option value="Wedding"> Analogous Cost Estimation </option>
                            <option value="Birthday"> Parametric Cost Estimation </option>
                            <option value="Others"> Others </option>
                        </select>
                    </div>

                    <div class="card-body border-0" id="printable">
                        <style>
                            .th_tbl{
                                text-align: left;
                            }
                            .squam_tbl{
                                padding: 5px;
                            }
                            .col_3{
                                width: 40%;
                            }
                            .col_2{

                                width: 30%;
                            }
                            .col_1{

                                width: 30%;
                            }
                            .col_4_itm{
                                width: 30%;
                            }
                            .col_3_itm{
                                 width: 20%;
                            }
                            .col_2_itm{

                                width: 20%;
                            }
                            .col_1_itm{

                                width: 30%;
                            }
                            .total_row{
                                border-top: 1px dashed;
                            }
                        </style>
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
                                <center >Company Event Quotation for <b>{{$client->client_name}}</b><br>
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
                                <u> COST TO PRODUCE DISHES: </u>
                                <br>
                                <table style="border:none; width: 100%;">
                                    <tr class="th_tbl">
                                        <th class="col_1_itm squam_tbl">Dish</th>
                                        <th class="col_2_itm squam_tbl">Expense Per Piece</th>
                                        <th class="col_3_itm squam_tbl">Quantity</th>
                                        <th class="col_4_itm squam_tbl">Total</th>
                                    </tr>
                                @foreach($additional_dishes as $food)
                                    <tr>
                                        <td class="col_1_itm squam_tbl">{{$food->item_name}}</td>
                                        <td class="col_2_itm squam_tbl">P{{$food->unit_expense}}</td>
                                        <td class="col_3_itm squam_tbl">{{$package->suggested_pax}} PCS</td>
                                        <td class="col_4_itm squam_tbl">P{{number_format($food->unit_expense * $package->suggested_pax,2)}}</td>
                                    </tr>
                                   {{-- <li>{{$food->item_name}} :  {{$food->unit_expense}} per piece x {{$package->suggested_pax}} pcs  = <b>P {{number_format($food->total_price,2)}}</b></li>
                                   --}}
                                @endforeach

                                    <tr>
                                        <td class="col_1_itm squam_tbl total_row"><b>TOTAL COST</b></td>
                                        <td class="col_2_itm squam_tbl total_row"></td>
                                        <td class="col_3_itm squam_tbl total_row"></td>
                                        <td class="col_4_itm squam_tbl total_row"><b><u>P {{number_format($total_dish_cost,2)}}</u></b></td>
                                    </tr>
                                </table>

                                <br>
                                <u> COST TO ITEMS & MISC (SERVICES) IN HOUSE</u>
                                <br>
                                <table style="border:none; width: 100%;">
                                    <tr class="th_tbl">
                                        <th class="col_1_itm squam_tbl">Item/Service</th>
                                        <th class="col_2_itm squam_tbl">Expense Per Piece</th>
                                        <th class="col_3_itm squam_tbl">Quantity</th>
                                        <th class="col_4_itm squam_tbl">Total</th>
                                    </tr>
                                    @foreach($additional_invs as $inv)
                                     {{--    <li>{{$inv->inventory_name}} : P{{number_format($inv->unit_expense,1)}} per piece x {{$inv->qty}}  pcs = <b>P {{number_format($inv->qty * $inv->unit_expense,2 )}}</b></li>
                                     --}}
                                    <tr>
                                        <td class="col_1_itm squam_tbl">{{$inv->inventory_name}}</td>
                                        <td class="col_2_itm squam_tbl">P{{number_format($inv->unit_expense,1)}}</td>
                                        <td class="col_3_itm squam_tbl">{{$inv->qty}} PCS</td>
                                        <td class="col_4_itm squam_tbl">P {{number_format($inv->qty * $inv->unit_expense,2 )}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="col_1_itm squam_tbl total_row"><b>TOTAL COST</b></td>
                                        <td class="col_2_itm squam_tbl total_row"></td>
                                        <td class="col_3_itm squam_tbl total_row"></td>
                                        <td class="col_4_itm squam_tbl total_row"><u><b>P {{number_format($total_inv_cost,2)}}</b></u></td>
                                    </tr>
                                </table>
                                <br>
                                <u> LABOR COST FOR EVENT STAFFING</u>
                                <small>(is just trial for now)</small>
                                <br>
                                <table style="border:none; width: 100%;">
                                    <tr class="th_tbl">
                                        <th class="col_1 squam_tbl">Employee ID</th>
                                        <th class="col_2 squam_tbl">Name</th>
                                        <th class="col_3 squam_tbl">Daily Rate</th>
                                    </tr>
                                    @foreach($staffs as $staff)
                                        <tr>
                                            <td class="col_1 squam_tbl">{{$staff['employee_id']}}</td>
                                            <td class="col_2 squam_tbl">{{$staff['employee_FN'] }} {{$staff['employee_LN']}}</td>
                                            <td class="col_3 squam_tbl">P 800.0</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="col_1 squam_tbl total_row"><b>TOTAL COST</b></td>
                                        <td class="col_2 squam_tbl total_row"></td>
                                        <td class="col_3 squam_tbl total_row"><u><b>P {{number_format($staff_cost)}}</b></u></td>
                                    </tr>
                                </table>
                                {{--
                                <hr style="width: 50%;margin-right:10vw;margin-bottom: 1px;margin-top: 1px;">
                                <div style="text-align: right;margin-right:12vw;">
                                    <h4 style="display: inline-block;margin-bottom: 0.1vh;margin-top:1vh;">Staffing Cost :</h4> <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($staff_cost,2)}}</b>
                                </div>
                                 --}}
                                <br>
                                <u> COST FOR OUTSOURCED SERVICES </u>
                                <small>(is just trial for now)</small>
                                <br>
                                <table style="border:none; width: 100%;">
                                    <tr class="th_tbl">
                                        <th class="col_1 squam_tbl">Outsourced Item</th>
                                        <th class="col_2 squam_tbl">Quantity</th>
                                        <th class="col_3 squam_tbl">Total Cost</th>
                                    </tr>
                                    <tr>
                                        <td class="col_1 squam_tbl">Ice Scultpure</td>
                                        <td class="col_2 squam_tbl">10</td>
                                        <td class="col_3 squam_tbl">1500</td>
                                    </tr>
                                    <tr>
                                        <td class="col_1 squam_tbl">Tender Juicy Hatdog</td>
                                        <td class="col_2 squam_tbl">18</td>
                                        <td class="col_3 squam_tbl">900</td>
                                    </tr>
                                    <tr>
                                        <td class="col_1 squam_tbl total_row"><b>TOTAL COST</b></td>
                                        <td class="col_2 squam_tbl total_row"></td>
                                        <td class="col_3 squam_tbl total_row"><u><b>900</b></u></td>
                                    </tr>
                                </table>
                                <br>
                                <u> Extras </u>
                                <small>(is just trial for now)</small>
                                <ul>
                                    <li>Off-Premise Logistics Fee : P <b>{{number_format($extra_cost,2)}}</b></li>
                                </ul>
                                @if($is_off_premise)
                                    <u> Extras </u>
                                    <small>(is just trial for now)</small>
                                    <ul>
                                        <li>Off-Premise Logistics Fee : P <b>{{number_format($extra_cost,2)}}</b></li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <hr style="border-top: dotted 1px;">
                        <div style="text-align: right">
                            <div>
                                <h4 style="display: inline-block;margin-bottom: 0.1vh;margin-top:1vh;">Dish Cost :</h4> <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($total_dish_cost,2)}}</b>
                            </div>
                            <div>
                                <h4 style="display: inline-block;margin-bottom: 0.1vh;margin-top:1vh;">Services Cost :</h4> <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($total_inv_cost,2)}}</b>
                            </div>
                            <div>
                                <h4 style="display: inline-block;margin-bottom: 0.1vh;margin-top:1vh;">Outsourcing Cost :</h4> <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($total_outsource_cost,2)}}</b>
                            </div>
                            <div>
                                <h4 style="display: inline-block;margin-bottom: 0.1vh;margin-top:1vh;">Staffing Cost :</h4> <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($staff_cost,2)}}</b>
                            </div>
                            @if($is_off_premise)

                                <div>
                                    <h4 style="display: inline-block;margin-bottom: 0.1vh;margin-top:1vh;">Logistics Cost :</h4> <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($extra_cost,2)}}</b>
                                </div>
                            @endif
                            <br>
                            <u> Amount Due:
                                <div>
                                    <span style="display: inline-block">PHP</span> <b style="display: inline-block">{{number_format($total_cost,2)}}</b>
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