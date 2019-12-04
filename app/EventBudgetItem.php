<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventBudgetItem extends Model
{
    public $timestamps = false;
    public $table = 'event_budget_item';

    public function get_analogous_item($event_id){
        $a_budget = EventBudget::where('event_id','=',$event_id)->first();
        $budget_itm = EventBudgetItem::where('event_budget_id','=',$a_budget->id)->where('item_name')->first();
        return $budget_itm;
    }
    public function add_expense($file_path,$amount){
        $exp = new EventBudgetItemExpenseAdd();
        $exp->event_budget_item_id = $this->id;
        $exp->file_path = $file_path;
        $exp->expense_amount = $amount;
        $exp->save();
        return true;
    }

}