<form action="{{ route('post.event_budgets') }}" method="POST" style="padding:10px">
    {{csrf_field()}}
    <div class="row" style="margin-top: 4vh;margin-bottom: 2vh;">
        <div class="col-md-4">
            @if($event_lock!=false)
                <button class="btn btn-icon btn-3 btn-secondary" id="edit_item_btn" onclick="edit_items()" type="button">
                    <i class="fa fa-edit fa-lg"></i>  Edit Budget
                </button>
            @endif
        </div>
        <div class="col-md-4">
            <center>
                    <h2 class="mb-0">Event Budget for {{$event->event_name}} </h2>
            </center>
        </div>
        <div class="col-md-4">
            <table class="table-bordered" style="padding: 1vh;float:right">
                <tr>
                    <td style="padding: 5px"><b>Event Package Price</b></td>
                    <td style="padding: 5px;padding-left: 20px;padding-right: 10px;">P{{number_format($event->package->price,2)}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px"><b>Total Budget</b></td>
                    <td style="padding: 5px;padding-left: 20px;padding-right: 10px;">P{{number_format($budget->total_budget,2)}}</td>
                </tr>
                <tr>
                    <td style="padding: 5px"><b>Total Spent</b></td>
                    <td style="padding: 5px;padding-left: 20px;padding-right: 10px;">P{{number_format($event->total_spent,2)}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row" style="background-color: #f4f5f7;padding: 1.0vw;">
        <input type="hidden" name="event" value="{{$event_id}}">
        <input type="hidden" name="action" value="update">

        <input type="hidden" name="budget_id" value="{{$budget->id}}">
        <input type="hidden" name="to_delete" id="to_delete" value="">

        <div class="col-md-12" >
            <div class="row budget_item_rows">
                <div id="budget_name_col" class="col-md-2 marg_top">
                    <center><label>Budget Item</label></center>
                    @foreach($budget->budget_items as $budget_item)
                        <i class="brs fa fa-remove fa-lg rm_item old_item" budget_item_id="{{$budget_item->id}}" style="display: none" onclick="remove_item(this)"></i>
                        <input type="text" style="display: inline-block;width: 90%" name="old_names[]" class="input_like item_names budg_item" placeholder="Item Name" value="{{$budget_item->item_name}}" disabled>
                    @endforeach
                </div>
                <div id="budget_prog_col" class="col-md-3 marg_top">
                    <label >Budget Status</label>
                    @foreach($budget->budget_items as $budget_item)
                        <div class="prog">
                            <div class="progress" style="height: 20px" >
                                <div class="progress-bar @if($budget_item->overflow) bg-warning @endif" role="progressbar" style="width: {{($budget_item->actual_amount/$budget_item->budget_amount)*100}}%;"  aria-valuemax="100">{{$budget_item->budget_comp_percentage}}{{($budget_item->actual_amount/$budget_item->budget_amount)*100}}%</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div id="budget_amt_col" class="col-md-2 marg_top">
                    <label>Budget Amount</label>
                    @foreach($budget->budget_items as $budget_item)
                        <input type="number" name="old_vals[]" step="any" style="display: inline-block;" class="item_amts form-control budg_item" placeholder="0.0" value="{{$budget_item->budget_amount}}" disabled>
                    @endforeach
                </div>

                <div id="budget_amt_col" class="col-md-2 marg_top">
                        <label>Total Amount Spent</label>
                        {{-- @foreach($budget->budget_items as $budget_item)
                            <input type="number" name="old_vals[]" step="any" style="display: inline-block;" class="item_amts form-control budg_item" placeholder="0.0" value="{{$budget_item->budget_amount}}" disabled>
                        @endforeach --}}
                        @foreach($budget->budget_items as $budget_item)
                            <input type="number" style="display: inline-block;"  class="form-control budg_item_no_edit" placeholder="0.0" value="{{$budget_item->actual_amount}}" disabled>
                        @endforeach
                    </div>

                <div id="budget_act_col" class="col-md-3 marg_top">
                        <label>Amount Spent</label>
                        @foreach($budget->budget_items as $budget_item)
                            <input type="number" style="display: inline-block;" name="old_acts[]" class="item_acts form-control budg_item" placeholder="0.0" value="0.0">
                        @endforeach
                    </div>
            </div>
            <button id="add_item_btn" class="btn btn-icon btn-sm btn-primary" style="margin-top: 4vh;display: none" onclick="duplicate()" type="button">
                Add New Item <i class="fa fa-plus fa-lg"></i>
            </button>
        </div>
        <br>

        <div style="margin-top: 2vh">
            <br>
            <small>Spent Buffer Amount</small><br>
            <input type="number" name="spent_buffer_amount" step="any" style="font-size:14px;display: inline-block;width: 75%;height:20%" class="" placeholder="0.0" value="{{$budget->spent_buffer}}">
            <br>
            <small>Total Buffer Amount</small><br>
            <input type="number" name="total_buffer_amount" step="any" style="font-size: 14px;display: inline-block;width: 75%;height:20%" class="" placeholder="0.0" value="{{$budget->total_buffer}}">
        </div>

    </div>

    <center id="saving_btn_div" style="margin-top: 3vh">
        <button class="btn btn-icon btn-3 btn-primary" onclick="undisable()" type="button">
            Save Budget
        </button>
        <button id="submit_btn" style="display: none;" type="submit">
        </button>
    </center>

</form>
<script>
    let edit = false;
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
                $(".item_acts").get(item_index).remove();
                $(".item_amts").get(item_index).remove();
            }else{
                alert("must atleast have one item!");
            }
        }
        //calculate_buffer();
    }
    function duplicate() {
        rm_str = '<br class="brs"> <i class="fa fa-remove fa-lg rm_item" style="display: inline-block" onclick="remove_item(this)"></i> ';
        $("#budget_name_col").append(rm_str);
        add_str='<input type="text" name="names[]" class="form-control budg_item item_names" style="display: inline-block;width: 90%" placeholder="Item Name" value="">';
        $("#budget_name_col").append(add_str);
        add_str='<input type="text" name="acts[]" class="form-control budg_item item_acts" placeholder=0.0" value="">';
        $("#budget_act_col").append(add_str);
        add_str='<input type="number" name="vals[]" step="any" class="form-control budg_item item_amts" placeholder="0.0" value="">';
        $("#budget_amt_col").append(add_str);
    }
    function undisable(){
        $(".budg_item").attr("disabled",false);
        $("#submit_btn").click();
    }
    function edit_items(){
        edit = !edit;
        if(edit){
           $("#add_item_btn").css("display","block");
           $(".remove_item").css("display","block");
           $(".rm_item").css("display","inline-block");
           $(".budg_item").attr("disabled",false);
           $(".item_acts").attr("disabled",false);
           $(".item_names").addClass('form-control');
           $(".item_names").removeClass('input_like');
        }
        else{
            $("#add_item_btn").css("display","none");
            $(".remove_item").css("display","none");
            $(".rm_item").css("display","none");
            $(".budg_item").attr("disabled",true);
            $(".item_acts").attr("disabled",false);
            $(".item_names").removeClass('form-control');
            $(".item_names").addClass('input_like');
        }
    }
</script>
