@inject('func', 'App\Http\Controllers\EventsCostingController')
@extends('layouts.inventoryApp', ['title' => __('User Management')])
@section('content')
    @include('layouts.headers.eventsCard')
    <style>
        .budg_item{
            margin-top:1vh;

            margin-bottom:1vh;
        }
        .marg_top{
            margin-top: 3vh;
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
                                    @if($budget ==null)
                                    <h3 class="mb-0">Create Event Budget for </h3>
                                    @else
                                    <h3 class="mb-0">Event Budget for Event for</h3>
                                    @endif
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" style="padding-bottom: 5vh;padding-right: 2vw;min-height: 75vh;">
                        @if($budget==null)
                        <form action="{{ route('post.event_budgets') }}" method="POST" style="padding:10px">

                            {{csrf_field()}}
                            <button class="btn btn-icon btn-3 btn-secondary" data-toggle="modal" data-target="#exampleModal" type="button">
                                Choose From Budget Template
                            </button>
                            <hr>
                            <div class="row" style="background-color: #f4f5f7;padding: 1.0vw;">
                                <input type="hidden" name="event" value="{{$event_id}}">
                                <div class="col-md-12" >
                                    <div class="row budget_item_rows">
                                        <div id="budget_name_col" class="col-md-4 marg_top">
                                            <label>Budget Item</label>
                                            <input type="text"  step="any" name="names[]" class="form-control budg_item" placeholder="Item Name" value="">

                                        </div>
                                        <div id="budget_desc_col" class="col-md-4 marg_top">
                                            <label>Item Description</label>
                                            <input type="text" name="descs[]" class="form-control budg_item" placeholder="Item Description here" value="">

                                        </div>
                                        <div id="budget_amt_col" class="col-md-4 marg_top">
                                            <label>Budget Amount</label>
                                            <input type="number" name="vals[]" class="form-control budg_item" placeholder="0.0" value="">
                                        </div>
                                    </div>
                                    <button class="btn btn-icon btn-sm btn-primary" style="margin-top: 4vh" onclick="duplicate()" type="button">
                                        Add New Item <i class="fa fa-plus fa-lg"></i>
                                    </button>
                                </div>
                                <br>

                            </div>
                            <hr>
                            <center>
                                <button class="btn btn-icon btn-3 btn-primary" type="submit">
                                    Create Budget
                                </button>
                            </center>
                        </form>
                        @else
                        <form action="{{ route('post.event_budgets') }}" method="POST" style="padding:10px">
                            {{csrf_field()}}
                            <!--
                            <button class="btn btn-icon btn-3 btn-secondary" data-toggle="modal" data-target="#exampleModal" type="button">
                                Edit Budget
                            </button>

                            -->
                            <button class="btn btn-icon btn-3 btn-secondary" onclick="edit_items()" type="button">
                                <i class="fa fa-edit fa-lg"></i>  Edit Budget
                            </button>
                            <hr>
                            <div class="row" style="background-color: #f4f5f7;padding: 1.0vw;">
                                <input type="hidden" name="event" value="{{$event_id}}">
                                <div class="col-md-12" >
                                    <div class="row budget_item_rows">
                                        <div id="budget_name_col" class="col-md-4 marg_top">
                                            <label>Budget Item</label>
                                            @foreach($budget->budget_items as $budget_item)
                                                <br>
                                                <i class="fa fa-plus fa-lg rm_item" style="display: none"></i> <input type="text" style="display: inline-block;width: 90%" name="names[]" class="form-control budg_item" placeholder="Item Name" value="{{$budget_item->item_name}}" disabled>
                                            @endforeach
                                        </div>
                                        <div id="budget_desc_col" class="col-md-4 marg_top">
                                            <label>Item Description</label>
                                            @foreach($budget->budget_items as $budget_item)
                                                <br>
                                                <i class="fa fa-plus fa-lg rm_item" style="display: none"></i> <input type="text" style="display: inline-block;width: 90%" name="descs[]" class="form-control budg_item" placeholder="Item Description here" value="" disabled>
                                            @endforeach
                                        </div>
                                        <div id="budget_amt_col" class="col-md-4 marg_top">
                                            <label>Budget Amount</label>
                                            @foreach($budget->budget_items as $budget_item)
                                                <br>
                                                <i class="fa fa-plus fa-lg rm_item" style="display: none"></i> <input type="number" name="vals[]"  style="display: inline-block;width: 90%" class="form-control budg_item" placeholder="0.0" value="{{$budget_item->budget_amount}}" disabled>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button id="add_item_btn" class="btn btn-icon btn-sm btn-primary" style="margin-top: 4vh;display: none" onclick="duplicate()" type="button">
                                        Add New Item <i class="fa fa-plus fa-lg"></i>
                                    </button>
                                </div>
                                <br>
                            </div>
                            <hr>
                            <center style="display: none" id="saving_btn_div">
                                <button class="btn btn-icon btn-3 btn-primary" type="submit">
                                    Save Budget
                                </button>
                            </center>
                    </form>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        @include('layouts.footers.auth')
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" style="width: 100%" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Budget Templates</h5>
                    <button type="button" class="close" data-dismiss="modal" id="modal_close_btn" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Template Name</th>
                            <th>Items</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($budget_templates as $budget_template)
                            <tr>
                                <td><a href="#" onclick="choose_template(this)" id="budget_template_{{$budget_template->id}}"
                                       item_names='@foreach($budget_template->items as $items){{$items->item_name}}, @endforeach'
                                       item_vals='@foreach($budget_template->items as $items){{$items->default_value}}, @endforeach'
                                    >
                                    {{$budget_template->template_name}}</a></td>
                                <td>{{count($budget_template->items)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        let edit = false;
        function choose_template(obj) {
            let item_names = $(obj).attr("item_names").split().length > 0 ? ($(obj).attr("item_names").split(",")): null;
            let item_vals = $(obj).attr("item_vals").split().length > 0 ? ($(obj).attr("item_vals").split(",")): null;

            $("#budget_name_col").empty().append('<label>Budget Item</label>');
            $("#budget_desc_col").empty().append('<label>Budget Description</label>');
            $("#budget_amt_col").empty().append('<label>Budget Amount</label>');

            for(i=0;i<item_names.length;i++){

                console.log("henl");
                if(i !== item_names.length-1){
                    console.log("pumazuc"+item_names[i]+item_vals[i]);
                    add_str='<input type="text" name="names[]" class="form-control budg_item" placeholder="Item Name" value="'+item_names[i]+'">';
                    $("#budget_name_col").append(add_str);
                    add_str='<input type="text" name="descs[]" class="form-control budg_item" placeholder="Item Description here" value="">';
                    $("#budget_desc_col").append(add_str);
                    add_str='<input type="number" name="vals[]" step="any" class="form-control budg_item" placeholder="0.0" value="'+parseFloat(item_vals[i])+'">';
                    $("#budget_amt_col").append(add_str);
                }
            }
            $("#modal_close_btn").click();
        }
        function duplicate() {
            add_str='<input type="text" name="names[]" class="form-control budg_item" placeholder="Item Name" value="">';
            $("#budget_name_col").append(add_str);
            add_str='<input type="text" name="descs[]" class="form-control budg_item" placeholder="Item Description here" value="">';
            $("#budget_desc_col").append(add_str);
            add_str='<input type="number" name="vals[]" step="any" class="form-control budg_item" placeholder="0.0" value="">';
            $("#budget_amt_col").append(add_str);

        }
        function edit_items(){
            edit = !edit;
            if(edit){
               $("#saving_btn_div").css("display","block");
               $("#add_item_btn").css("display","block");
               $(".remove_item").css("display","block");
               $(".rm_item").css("display","inline-block");
               $(".budg_item").attr("disabled",false)
            }
            else{
                $("#saving_btn_div").css("display","none");
                $("#add_item_btn").css("display","none");
                $(".remove_item").css("display","none");
                $(".rm_item").css("display","none");
                $(".budg_item").attr("disabled",true);

            }
        }
    </script>
@endsection
