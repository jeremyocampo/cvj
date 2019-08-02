@inject('func', 'App\Http\Controllers\EventsCostingController')
@extends('layouts.app', ['title' => __('User Management')])
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
        .input_like{
            background:rgba(0,0,0,0);
            border:none;
            padding: .625rem .75rem;
            text-align:right;
        }
        .prog{
            padding: .625rem .75rem;
            text-align:right;
            margin-top: 0.25vh;
            margin-bottom:0.75vh;
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
                                    @if($budget == null)
                                    <h3 class="mb-0">Create Event Budget for {{$event->event_name}} </h3>
                                    @else
                                    <h3 class="mb-0">Event Budget for {{$event->event_name}} </h3>
                                    @endif
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" style="padding-bottom: 5vh;padding-right: 2vw;min-height: 75vh;">

                        @if($budget==null)
                        <form action="{{ route('post.event_budgets') }}" method="POST" style="padding:10px">
                            <input type="hidden" name="action" value="add">
                            {{csrf_field()}}
                            <button class="btn btn-icon btn-3 btn-secondary" data-toggle="modal" data-target="#exampleModal" type="button">
                                Choose From Budget Templates <i class="fa fa-newspaper-o fa-lg"></i>
                            </button>
                            <div class="row" style="background-color: #f4f5f7;padding: 1.0vw;">
                                <input type="hidden" name="event" value="{{$event_id}}">
                                <div class="col-md-12" >
                                    <div class="row budget_item_rows">
                                        <div id="budget_name_col" class="col-md-6 marg_top">
                                            <label class="txt_right" >Budget Item</label>
                                            <br class="brs"><i class="fa fa-remove fa-lg rm_item" style="display: inline-block" onclick="remove_item(this)"></i>
                                            <input type="text" name="names[]" class="form-control budg_item item_names" style="display: inline-block;width: 90%" placeholder="Item Name" value="">
                                        </div>
                                        <div id="budget_amt_col" class="col-md-6 marg_top">
                                            <label>Budget Amount</label>
                                            <input type="number" name="vals[]" step="any" style="display: inline-block;width: 90%" onchange="calculate_buffer()" class="form-control budg_item item_amts" placeholder="0.0" value="">
                                        </div>
                                    </div>
                                    <button class="btn btn-icon btn-sm btn-primary" style="margin-top: 4vh" onclick="duplicate()" type="button">
                                        Add New Item <i class="fa fa-plus fa-lg"></i>
                                    </button>
                                </div>
                                <br>
                                <div style="margin-top: 2vh">
                                    <br>
                                    <small>Total Buffer Amount</small><br>
                                    <input type="number" name="total_buffer_amount" step="any" style="font-size:14px;display: inline-block;width: 75%;height:20%" class="" placeholder="0.0" value="">
                                    <br>
                                    <small>Recommended Buffer Amount: </small><span class="badge badge-primary" id="buffer_amount">0.0</span>
                                </div>
                            </div>
                            <hr>
                            <center>
                                <button class="btn btn-icon btn-3 btn-primary" onclick="undisable()" type="submit">
                                    Create Budget
                                </button>
                            </center>
                        </form>
                        <script>
                            let edit = false;
                            function choose_template(obj) {
                                let item_names = $(obj).attr("item_names").split().length > 0 ? ($(obj).attr("item_names").split(",")): null;
                                let item_vals = $(obj).attr("item_vals").split().length > 0 ? ($(obj).attr("item_vals").split(",")): null;

                                $("#budget_name_col").empty().append('<label>Budget Item</label>');
                                $("#budget_amt_col").empty().append('<label>Budget Amount</label>');

                                for(i=0;i<item_names.length;i++){
                                    console.log("henl");
                                    if(i !== item_names.length-1){
                                        console.log("pumazuc"+item_names[i]+item_vals[i]);
                                        rm_str = '<br class="brs"><i class="fa fa-remove fa-lg rm_item" style="display: inline-block" onclick="remove_item(this)"></i>  ';
                                        $("#budget_name_col").append(rm_str);
                                        add_str='<input type="text" name="names[]"  class="form-control budg_item item_names" style="display: inline-block;width: 90%" placeholder="Item Name" value="'+item_names[i]+'">';
                                        $("#budget_name_col").append(add_str);
                                        add_str='<input type="number" name="vals[]" onchange="calculate_buffer()" step="any" class="form-control budg_item item_amts" style="display: inline-block" placeholder="0.0" value="'+parseFloat(item_vals[i])+'">';
                                        $("#budget_amt_col").append(add_str);
                                    }
                                }

                                calculate_buffer();
                                $("#modal_close_btn").click();
                            }
                            function remove_item(obj){
                                let bool = confirm("Are you sure?");
                                if (bool){
                                    if($(obj).hasClass("old_item")){
                                        $("#to_delete").val($("#to_delete").val()+","+$(obj).attr("budget_item_id"));
                                    }
                                    let item_index = $(".rm_item").index(obj);
                                    if($(".rm_item").length -1 > 0){
                                        $(".rm_item").get(item_index).remove();
                                        $(".brs").get(item_index).remove();
                                        $(".item_names").get(item_index).remove();
                                        $(".item_amts").get(item_index).remove();
                                    }else{
                                        alert("must atleast have one item!");
                                    }
                                }
                                calculate_buffer();
                            }
                            function duplicate() {
                                rm_str = '<br class="brs"> <i class="fa fa-remove fa-lg rm_item" style="display: inline-block" onclick="remove_item(this)"></i>  ';
                                $("#budget_name_col").append(rm_str);
                                add_str='<input type="text" name="names[]" class="form-control budg_item item_names" style="display: inline-block;width: 90%" placeholder="Item Name" value="">';
                                $("#budget_name_col").append(add_str);
                                add_str='<input type="number" name="vals[]" step="any" onchange="calculate_buffer()" class="form-control budg_item item_amts" style="display: inline-block;width: 90%" placeholder="0.0" value="">';
                                $("#budget_amt_col").append(add_str);
                            }
                            function calculate_buffer(){
                                let total_buffer = 0.0;
                                $(".item_amts").each(function(){
                                    total_buffer = parseFloat(total_buffer) + parseFloat($(this).val());
                                });

                                //$("#buffer_amount").html("");
                                $("#buffer_amount").html(parseFloat(total_buffer*0.15).toFixed(2));
                                console.log(total_buffer);
                            }
                        </script>
                        @else
                            @include('editEventBudget')
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
                                       item_vals='@foreach($budget_template->items as $items){{$items->default_value}}, @endforeach'>
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
@endsection
