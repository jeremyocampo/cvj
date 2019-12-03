<link href="/assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
@extends('layouts.app')



@section('content')

    <div class="modal fade" id="filesModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="dishesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dishesModalLabel">Event Files</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <form action="/upload_event_forms" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="selected_event_id" name="event_id" value="">
                            <!-- 1 is reservation only, 2 is deposit only, 3 is both.-->
                            <span class="h2 font-weight-bold mb-0">Reservation Form</span><br>
                            <div id="reservation_div">
                                <a href="download" id="reservation_dlink" style="display: none"><i class="ni ni-cloud-download-95"></i> Download Event Reservation Form File</a>
                                <label id="reservation_lbl" class="custom-file-upload" style="color: blue">
                                    <input type="file" name="fileToUpload_reservation" id="res_inp" aria-describedby="fileHelp">
                                    <i class="ni ni-cloud-upload-96"></i> Upload Deposit Reservation Slip
                                </label>
                                <label id="res_file_lb"></label>
                            </div>
                            <hr>
                            <span class="h2 font-weight-bold mb-0">Deposit Form</span><br>
                            <div id="deposit_div">
                                <a href="download" id="deposit_dlink" style="display: none"><i class="ni ni-cloud-download-95"></i> Download Deposit Form</a>
                                <label id="deposit_lbl" class="custom-file-upload" style="color: blue">
                                    <input type="file" name="fileToUpload_deposit" id="dep_inp" aria-describedby="fileHelp">
                                    <i class="ni ni-cloud-upload-96"></i> Upload Deposit Reservation Slip
                                </label>
                                <label id="dep_file_lb"></label>
                            </div>
                            <button type="submit" id="sumbit_upload" style="display: none"></button>
                            <hr>
                            <label>Past Quotations:</label>
                            <div id="quotations" style="padding-left: 3vh;">
                                <a href="download"><i class="ni ni-cloud-download-95"></i> Quotation Version 1</a>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-small btn-primary" onclick="$('#sumbit_upload').click();" data-dismiss="modal">Submit</button>
                    <button type="button" class="btn btn-small btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
            </div>
        </div>
    </div>
    <style>
        .main-content{
            padding-left: 0;
            padding-right: 0;
        }
    </style>

<div class=" mt--7" style="padding-right: 0;padding-left:0">
    <div class="card-body" style="padding:0;">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0" style="text-align: left;">
                    <div class="col">
                        <h1 class="mb-0 ">List of Events</h1>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Pending Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Approved Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Calendar of Confirmed Events</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <table class="table  align-items-center  mb-12" id="myTable" >
                                <thead class="thead-light">
                                <tr>
                                    <th> Event Name </th>
                                    <th> Venue </th>
                                    <th> Date/Time </th>

                                    <th> Action </th>
                                    <th> Status </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pendingEvents as $i)
                                    {{-- @if($i->status > 0) --}}
                                    <td> <b>{{ $i->event_name }}</b><br> <small>@if($i->package_name == "n/a") [ No Package Selected ]@else {{$i->package_name}} @endif </small></td>

                                    <td> [{{ $i->venue }}]<br>{{ $i->event_detailsAdded }} </td>
                                        <td>
                                            {{ Carbon\Carbon::parse($i->event_start)->format('F j, Y') }} <br>[
                                            {{ Carbon\Carbon::parse($i->event_start)->format('g:i a') }} -
                                            {{ Carbon\Carbon::parse($i->event_end)->format('g:i a') }}]
                                        </td>
                                        <td class="popup">
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                    Action
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                    <div class=" dropdown-header noti-title">
                                                        <h6 class="text-overflow m-0">{{ __('Event Options:') }}</h6>
                                                    </div>
                                                    <a  class="dropdown-item" href="#"  data-toggle="modal"
                                                        res_dlink="{{$i->reservation_file_path}}" dep_dlink="{{$i->deposit_file_path}}" event_id="{{$i->event_id}}"
                                                        data-quotation=" @foreach($i->quotations as $quotation) {{$quotation->version_num}},{{$quotation->file_path}}; @endforeach "
                                                        onclick="open_files_modal(this);" data-target="#filesModal"><i class="fa fa-eye"></i> View Event Files</a>

                                                    <a href="{{ url('bookevent/edit/'.$i->event_id) }}" class="dropdown-item">
                                                        <i class="fa fa-edit"></i>
                                                        <span>Edit Event</span>
                                                    </a>

                                                    <style>
                                                        input[type="file"] {
                                                            display: none;
                                                        }
                                                        .custom-file-upload {
                                                            border: 1px solid #ccc;
                                                            display: inline-block;
                                                            padding: 6px 12px;
                                                            cursor: pointer;
                                                        }
                                                    </style>
                                                    <div class="dropdown-divider"></div>

                                                    <div class=" dropdown-header noti-title">
                                                        <h6 class="text-overflow m-0">{{ __('Quotation Options:') }}</h6>
                                                    </div>

                                                    @if($i->package_id != null)
                                                    <a href="{{ url('summary/'.$i->event_id) }}" class="dropdown-item">
                                                        <i class="ni ni-single-copy-04"></i>
                                                        <span>Event Summary</span>
                                                    </a>

                                                    <a href="{{ url('client_quotation/'.$i->event_id) }}" class="dropdown-item">
                                                        <i class="ni ni-single-02"></i>
                                                        <span>Client Quotation</span>
                                                    </a>
                                                    <a href="client_reservation/{{$i->event_id}}" class="dropdown-item">
                                                        <i class="ni ni-single-02"></i>
                                                        <span>View Reservation Form</span>
                                                    </a>
                                                    @if($user->userType == 4)
                                                        <a href="{{ url('company_quotation/'.$i->event_id) }}" class="dropdown-item">
                                                            <i class="ni ni-shop"></i>
                                                            <span>Company Quotation</span>
                                                        </a>
                                                    @endif
                                                    <div class="dropdown-divider"></div>

                                                    <div class=" dropdown-header noti-title">
                                                        <h6 class="text-overflow m-0">{{ __('Package Options:') }}</h6>
                                                    </div>

                                                        <a href="{{ url('edit_event_package/'.$i->event_id) }}" class="dropdown-item">
                                                            <i class="ni ni-shop"></i>
                                                            <span>Edit Package</span>
                                                        </a>
                                                        <a href="{{ url('remove_event_package/'.$i->event_id) }}" class="dropdown-item">
                                                            <i class="ni ni-shop"></i>
                                                            <span>Remove Package</span>
                                                        </a>
                                                    @else
                                                        <a href="{{ url('selectpackages/'.$i->event_id) }}" class="dropdown-item">
                                                            <i class="ni ni-shop"></i>
                                                            <span>Add Package</span>
                                                        </a>
                                                    @endif
                                                    <div class="dropdown-divider"></div>
                                                    {{--
                                                    <a href="{{ url('events/'.$i->event_id) }}" class="dropdown-item">
                                                        <i class="ni ni-zoom-split-in"></i>
                                                        < Inc? ><span>{{ __('View Event Details') }}</span>
                                                    </a>
                                                    <a href="{{ url('inventory/create')}}" class="dropdown-item">
                                                        <i class="ni ni-fat-add"></i>
                                                        < Inc > <span>{{ __('Purchase Inventory') }}</span>
                                                    </a>
                                                    <a href="{{ url('outsource/'.$i->event_id)}}" class="dropdown-item">
                                                        <i class="ni ni-fat-add"></i>
                                                        < Inc ><span>{{ __('Outsource Inventory') }}</span>
                                                    </a>
                                                    <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                            document.getElementById('delete-form-{{ $i->event_id }}').submit();">
                                                        <i class="ni ni-fat-remove"></i>
                                                        < Inc ?> <span>{{ __('Remove from Inventory') }}</span>
                                                        {!! Form::open(['action' => ['InventoryController@destroy', $i->event_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->event_id]) !!}
                                                        {{ Form::hidden('_method','DELETE')}}
                                                        {!! Form::close() !!}
                                                    </a>
                                                    --}}
                                                </div>
                                            </div>
                                            {{-- <a class="btn btn-sm btn-primary" href="inventory/{{ $i->itemId }}/edit"> Replenish Item </a> mahaba--}}
                                        </td>
                                        <td> {{-- {{ $i->status_name }} --}}

                                            @if($i->deposit_file_path != null && $i->reservation_file_path != null)
                                                <small> <i style="color:#3dff18" class="fa fa-check-circle"></i> Requirements Fulfilled.</small><br>
                                                <a href="{{ url('confirm_event/'.$i->event_id) }}" > @if($user->userType == 4) [ Click to Confirm Event ] @endif</a>
                                            @endif
                                            @if($i->reservation_file_path == null)
                                                <small> <i style="color:#ff974c" class="ni ni-fat-remove"></i> No Reserve Form Uploaded</small>
                                            @endif
                                            <br>
                                            @if($i->deposit_file_path == null)
                                                <small> <i style="color:#ff974c" class="ni ni-fat-remove"></i> No Deposit Slip Uploaded</small>
                                            @endif

                                        </td>

                                    </tr>
                                    {{-- @endif --}}
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <table class="table  align-items-center  mb-3" id="myTable" >
                                <thead class="thead-light">
                                <tr>
                                    <th>Event Name</th>
                                    <th>Venue</th>
                                    <th> Date/Time </th>

                                    <th>Remarks</th>
                                    <th >Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $i)
                                    @if($i->status < 5)
                                        <tr>
                                            <td> <b>{{ $i->event_name }}</b><br> @if($i->package_name == "n/a") No Package Selected @else {{$i->package_name}} @endif </td>
                                            <td> [{{ $i->venue }}]<br>{{ $i->event_detailsAdded }} </td>
                                            <td>
                                                {{ Carbon\Carbon::parse($i->event_start)->format('F j, Y') }} <br>[
                                                {{ Carbon\Carbon::parse($i->event_start)->format('g:i a') }} -
                                                {{ Carbon\Carbon::parse($i->event_end)->format('g:i a') }}]
                                            </td>
                                            <td> {{ $i->status_name }}</td>
                                            <td class="popup">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                                                        Action
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                        <div class=" dropdown-header noti-title">
                                                            <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                        </div>
                                                        <div class="dropdown-divider"></div>
                                                        <a href="{{ url('events/'.$i->event_id) }}" class="dropdown-item">
                                                            <i class="ni ni-zoom-split-in"></i>
                                                            <span>{{ __('View Event Details') }}</span>
                                                        </a>

                                                        <a href="{{ url('inventory/create')}}" class="dropdown-item">
                                                            <i class="ni ni-fat-add"></i>
                                                            <span>{{ __('Purchse Inventory') }}</span>
                                                        </a>
                                                        <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                                document.getElementById('delete-form-{{ $i->event_id }}').submit();">
                                                            <i class="ni ni-fat-remove"></i>
                                                            <span>{{ __('Remove from Inventory') }}</span>
                                                            {!! Form::open(['action' => ['InventoryController@destroy', $i->event_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->event_id]) !!}
                                                            {{ Form::hidden('_method','DELETE')}}
                                                            {!! Form::close() !!}
                                                        </a>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="col-md-12 mb-3">
                                <iframe src="https://calendar.google.com/calendar/embed?src=cvjcatering.info%40gmail.com&ctz=Asia%2FManila" style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    {{-- <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
            <i class="fas fa-credit-card"></i>
        </div> --}}

        <script>
            $('#res_inp').change(function() {
                var file = $('#res_inp')[0].files[0].name;
                $("#res_file_lb").html(file);
            });
            $('#dep_inp').change(function() {
                var file = $('#dep_inp')[0].files[0].name;
                $("#dep_file_lb").html(file);
            });
            function reset_modal(){
                $("#dep_file_lb").html("");
                $("#res_file_lb").html("");

                $("#reservation_dlink").css("display","none");
                $("#deposit_dlink").css("display","none");

                $("#deposit_lbl").css('display','block');
                $("#reservation_lbl").css('display','block');

                $("#quotations").empty();
            }
            function open_files_modal(obj) {

                $("#selected_event_id").val($(obj).attr("event_id"));
                reset_modal();
                var quot_arr = $(obj).attr('data-quotation').split(';');
                console.log('quot_arr: '+quot_arr);
                if($(obj).attr("res_dlink") !== ""){
                    $("#reservation_lbl").css('display','none');
                    $("#reservation_dlink").css("display","block").attr("href","download/"+$(obj).attr("res_dlink")+"/");
                }
                if($(obj).attr("dep_dlink") !== ""){
                    $("#deposit_lbl").css('display','none');
                    $("#deposit_dlink").css("display","block").attr("href","download/"+$(obj).attr("dep_dlink")+"/");
                }
                for(var i = 0; i < quot_arr.length-1 ;i++){
                    console.log('quot_arr: '+quot_arr);
                    var quot = quot_arr[i].split(',');
                    str = '<a href="download'+quot[1]+'"><i class="ni ni-cloud-download-95"></i> Quotation Version';
                    str += quot[0] + '</a><br>';
                    $("#quotations").append(str);
                }

            }
        </script>
       
       
        @include('layouts.footers.auth')
    
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
