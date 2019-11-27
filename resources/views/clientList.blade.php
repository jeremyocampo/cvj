@extends('layouts.app')

{{-- @include('layouts.headers.pagination') --}}

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="col-xl-12 mb-5">
            <div class="card shadow " >
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="row">
                            <div class="col-xs-5">
                                <h1 class="mb-0">List of Clients</h1>
                            </div>
                            <div class="col-xs-2">
                                    &nbsp;&nbsp;
                            </div>
                            <div class="col-xs-4">
                                <a href="client/create" class="btn btn-sm btn-primary"> + Create Client Reference</a>
                            </div>
                            </div>
                        </div>
                        <div class="col text-right"> </div>
                        <div class="col text-left">
                            <div class="col-xs-5"> 
                                <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if(session()->has('success'))
                                <br>
                                <div class="alert alert-success" role="alert">
                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                    {{ session()->get('success') }}<br>
                                </div>
                            @endif
                            @if(session()->has('deleted'))
                                <br>
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">x</span></button>
                                    {{ session()->get('deleted') }}<br>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                            <thead class="thead-light">
                                <tr>
                                    <th> Client name</th>
                                    <th> Email</th>
                                    <th> Mobile Number</th>
                                    <th> Telephone Number</th>
                                    <th> Address</th>
                                    <th> Last Modified (mm-dd-yy)</th>
                                    <th> Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $i)
                                @if($i->disabled_at == null)
                                <tr>
                                    <td>
                                        <a href="{{ url('client/'.$i->client_id) }}" class="dropdown-item">
                                            {{ $i->client_name }}
                                        </a>
                                    </td>    
                                    <td>{{ $i->email }}</td>
                                    <td>{{ $i->mob_no }}</td>
                                    <td>{{ $i->tel_no }}</td>
                                    <td>{{ $i->address }}</td>
                                    <td>{{ $i->updated_at }}</td>
                                    <td class="popup">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu">
                                                <div class=" dropdown-header noti-title">
                                                    <h6 class="text-overflow m-0">{{ __('Please Select an Action!') }}</h6>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ url('client/'.$i->client_id) }}" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('Edit Client Details') }}</span>
                                                </a>
                                                <a href="" class="dropdown-item" onclick="event.preventDefault();
                                                    document.getElementById('delete-form-{{ $i->client_id }}').submit();">
                                                    <i class="ni ni-fat-remove"></i>
                                                    <span>{{ __('Temporarily Disable Client Reference') }}</span>
                                                    {!! Form::open(['action' => ['ClientController@destroy', $i->client_id], 'method' => 'POST', 'id' => 'delete-form-'.$i->client_id]) !!}
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
                </div>
                <div class="card-footer">
                    <div id="pageNavPosition" style="padding-top: 20px; cursor: pointer;" align="center">
                    </div>
                    <script type="text/javascript">
                        <!--
                        var pager = new Pager('myTable', 5);
                        pager.init();
                        pager.showPageNav('pager', 'pageNavPosition');
                        pager.showPage(1);
                    </script>
                </div>
            </div>
        </div>
        <div class="col-xl-12 mb-5">
            <div class="card shadow " >
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-xs-5">
                                    <h1 class="mb-0">Disabled Clients</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col text-left">
                            <div class="col-xs-5">
                                <input class="form-control" id="myInput" type="search" onkeyup="searchTable()" style="background: transparent;" placeholder="Search Item Here">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                                    <thead class="thead-light">
                                        <tr>
                                            <th> Client name</th>
                                            <th> Email</th>
                                            <th> Mobile Number</th>
                                            <th> Telephone Number</th>
                                            <th> Address</th>
                                            <th> Date Disabled</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $b)
                                        @if($b->disabled_at != null)
                                        <tr>
                                            <td>
                                                <a href="{{ url('client/'.$i->client_id) }}" class="dropdown-item">
                                                    {{ $i->client_name }}
                                                </a>
                                            </td>    
                                            <td>{{ $i->email }}</td>
                                            <td>{{ $i->mob_no }}</td>
                                            <td>{{ $i->tel_no }}</td>
                                            <td>{{ $i->address }}</td>
                                            <td>{{ $i->disabled_at }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div id="pageNavPosition" style="padding-top: 20px; cursor: pointer;" align="center">
                            </div>
                            <script type="text/javascript">
                                <!--
                                var pager = new Pager('myTable', 5);
                                pager.init();
                                pager.showPageNav('pager', 'pageNavPosition');
                                pager.showPage(1);
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
@endsection

@push('js')
    <script>
        $('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');

        function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            document.location.reload(true);
            
            // var restorepage = document.body.innerHTML;
            // var printcontent = document.getElementById().innerHTML;
            // document.body.innerHTML = printcontent;
            // window.print();
            // document.body.innerHTML = restorepage;
        }
    </script>

@endpush