@extends('layouts.app')

{{-- @include('layouts.headers.pagination') --}}

@section('content')
    @include('layouts.headers.inventoryCard')

    <div class="container-fluid mt--7">
        {{-- <div class="col-xl-8 mb-5 mb-xl-0"> --}}
        <div class="col-xl-12 mb-5">
            <div class="card shadow " >
                <div class="card-header ">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="row">
                                <div class="col-xs-5">
                                    <h1 class="mb-0">Dish List</h1>
                                </div>
                                <div class="col-xs-2">
                                    &nbsp;&nbsp;
                                </div>
                                <div class="col-xs-4">
                                    <a href="dishes/create" class="btn btn-sm btn-primary"> + Add Item</a>
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
                        <!-- Projects table -->

                        <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">
                            <thead class="thead-light">
                            <tr>
                                <th >Item</th>
                                {{-- <th >Stock Keeping Unit(SKU)</th> --}}
                                <th >Item Image</th>
                                <th>Dish</th>
                                <th>Category</th>
                                <th >Quantity</th>
                                <th >Unit Cost</th>
                                <th >Expense</th>
                                <th >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            ?>
                            @foreach ($dishes as $dish)
                                <tr>

                                    <td>
                                        {{ $dish->item->item_name }}
                                    </td>
                                    <td>
                                        <img src="{{ asset($dish->item->item_image) }}" style="max-width: 120px" />
                                    </td>
                                    <td>{{ $dish->dish_name }}</td>
                                    <td> {{ $dish->dish_category }}</td>
                                    <td>{{ $dish->quantity }}</td>
                                    <td>{{ $dish->unit_cost }}</td>
                                    <td>{{ $dish->unit_expense }}</td>
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
                                                <a href="{{ url('recover-dish/'.$dish->id) }}" class="dropdown-item">
                                                    <i class="ni ni-zoom-split-in"></i>
                                                    <span>{{ __('Enable Dish') }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div id="pageNavPosition" style="padding-top: 20px; cursor: pointer;" align="center"></div>
                    <script type="text/javascript">
                        <!--
                        var pager = new Pager('myTable', 5);
                        pager.init();
                        pager.showPageNav('pager', 'pageNavPosition');
                        pager.showPage(1);
                    </script>
                </div>
            </div>
            <!--pagination-->

            <!--pagination-->

        </div>


        {{-- <div class="col-xl-12 mb-5">
            <div class="card shadow " >
                    <div class="card-body">
                            <div class="table-responsive mb-3">
                                <!-- Projects table -->
                                <table class="table table-bordered align-items-center table-flush mb-4" id="myTable">

                                </table>
                            </div>
                    </div>
            </div>
        </div> --}}
        {{--    @include('layouts.footers.auth')--}}
    </div>
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

        }
    </script>

@endpush
