@extends('layouts.app')

@section('content')
    @include('layouts.headers.inventoryCard')

    <div class="container-fluid mt--7">
    <div class="col-xl-12 mb-5">
        <div class="card shadow " >
            <div class="card-header ">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="row">
                        <div class="col-xs-5">
                            <h1 class="mb-0">Expense Reports</h1>
                        </div>
                        <div class="col-xs-2">
                                &nbsp;&nbsp;
                        </div>
                        </div>
                    </div>
                    <div class="col text-right"> </div>
                    <div class="col text-left">
                        <div class="col-xs-5"> 
                            <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
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
                <!-- Projects table -->
                
                <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                    <thead class="thead-light">
                        <tr>
                            <th >Event name</th>
                            {{-- <th >Stock Keeping Unit(SKU)</th> --}}
                            <th >Event Type</th>
                            <th>Package</th>
                            <th>Total Expenses</th>
                            <th >Total Cost</th>
                            <th >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $i)
                            {{-- @if() --}}
                            <tr>
                                <td>{{$i->event_name}}</td>
                                <td>{{$i->event_type}}</td>
                                <td>{{$i->package_name}}</td>
                                <td></td>
                                <td>{{$i->total_amount_due}}</td>
                                <td><button class="form-control" type="button">Action</button></td>
                            </tr>
                            {{-- @endif --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <div class="card-footer">
                    
            </div>
        </div>
    </div>
</div>


@endsection





@push('js')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    {{-- DATA TABLES START --}}
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

        <link rel="stylesheet" type="text/css" href=". /resources/DataTables/datatables.min.css"/>
        <script type="text/javascript" src=". /resources/DataTables/datatables.min.js"></script>
    {{-- DATA TABLES END --}}
    
    <script>
        $('.table-responsive tbody tr').slice(-2).find('.dropdown').addClass('dropup');

        function printContent(el){
            var restorepage = $('body').html();
            var printcontent = $('#' + el).clone();
            $('body').empty().html(printcontent);
            window.print();
            $('body').html(restorepage);
            document.location.reload(true);
        }
    </script>

    <script type="text/javascript">
        $(function() {
        
            var start = moment().subtract(29, 'days');
            var end = moment();
        
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
        
            cb(start, end);
        
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        } );
    </script>

@endpush