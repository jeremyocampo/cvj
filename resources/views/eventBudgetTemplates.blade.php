@inject('func', 'App\Http\Controllers\EventsCostingController')
@extends('layouts.inventoryApp', ['title' => __('User Management')])
@section('content')
    @include('layouts.headers.eventsCard')
    <style>
        .cost_item{
            height:80%;
        }
    </style>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <center>
                                    <h3 class="mb-0">View Budget Templates</h3>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" style="padding-bottom: 5vh;padding-right: 2vw">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Template</button>
                        <hr>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Template Name</th>
                                <th>Number Of Items</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($budget_templates as $budget_template)
                                <tr>
                                    <td>{{$budget_template->template_name}}</td>
                                    <td>{{count($budget_template->event_budget_template_item)}}</td>
                                    <td>
                                        <button class="btn btn-icon btn-3 btn-primary" type="button">
                                            <i class="fa fa-edit fa-lg"></i>
                                        </button>
                                        <button class="btn btn-icon btn-3 btn-danger" type="button">

                                            <i class="fa fa-remove fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                @foreach($budget_template->event_budget_template_item as $budget_template_item)

                                    <input type="hidden" id="hidden_budget_item_{{$budget_template->id}}"
                                        item-name="{{$budget_template_item->template_name}}"
                                        default-value="{{$budget_template_item->default_value}}"
                                    >
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        @include('layouts.footers.auth')
    </div>
    <!--
    <script>
        let subtotal = 0;
        compute_expense();
        compute_net_profit();

        function compute_expense(){
            subtotal = 0;
            $(".cost_item").each(function() {
                subtotal += parseFloat($(this).val());
            });
            console.log(subtotal);
            $("#budget_subtotal").html("P"+parseFloat(subtotal).toFixed(2));
        }
        $('.cost_item').keyup(function(){
            compute_expense();
            compute_net_profit();
        });
        function compute_net_profit() {
            $("#net_profit").html((price-subtotal).toFixed(2));
        }

    </script>
    -->
    <script>
        let curr_row_nums = 0;
        function duplicate() {
            $("#item_table").append('<tr id="children_row">'+
                '<td><input name="item_name[]" type="text" class="form-control" placeholder="Item Name"></td>'+
                '<td><input name="default_value[]" type="number" class="form-control cost_item" value="0.0"></td></tr>');
        }
    </script>
    <div class="modal fade" id="exampleModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('post.event_budget_template') }}">
                    {{csrf_field()}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Budget Template</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12" style="background-color: #f4f5f7;padding: 1.5vw;">
                            <label>Template Name: </label>
                            <input name="template_name" type="text" class="form-control" placeholder="Enter Template Name.">
                            <table style="width:100%" id="item_table">
                                <tr>
                                    <th>Item Name</th>
                                    <th>Default Value</th>
                                </tr>
                                <tr id="mother_row">
                                    <td><input name="item_name[]" type="text" class="form-control" placeholder="Item Name"></td>
                                    <td><input name="default_value[]" type="number" class="form-control cost_item" value="0.0"></td>
                                </tr>
                            </table>
                        <hr>
                        <button class="btn btn-icon btn-3 btn-primary" onclick="duplicate()" type="button">
                            <i class="fa fa-plus fa-lg"></i>
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                </form>
            </div>
        </div>
    </div>
@endsection