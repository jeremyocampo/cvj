<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventBudget extends Model
{

    public $timestamps = false;
    public $table = 'event_budget';
}
/*
 -- Budget SubItems Create
CREATE TABLE cvjdb.event_budget_item_expense_add
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_budget_item_id INT,
    expense_amount FLOAT,
    file_path TEXT,
    CONSTRAINT event_budget_item_expense_add_event_budget_item_id_fk FOREIGN KEY (event_budget_item_id) REFERENCES event_budget_item (id)
);

create table event_budget_subitem
(
	id int auto_increment
		primary key,
	event_budget_item_id int null,
	item_name text null,
	budget_amount float null,
	actual_amount float null,
	constraint event_budget_subitem_event_budget_item_id_fk
		foreign key (event_budget_item_id) references cvjdb.event_budget_item (id)
)
;

create index event_budget_subitem_event_budget_item_id_fk
	on event_budget_subitem (event_budget_item_id)
;

CREATE TABLE cvjdb.event_budget_subitem_expense_add
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_budget_subitem_id INT,
    expense_amout FLOAT,
    file_path TEXT,
    CONSTRAINT event_budget_subitem_expense_add_event_budget_subitem_id_fk FOREIGN KEY (event_budget_subitem_id) REFERENCES event_budget_subitem (id)
);

*/