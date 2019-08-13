<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great! 
|
*/

Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	
// Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

//Jeremy's Routess

// Route::get('inventory/return', 'InventoryController@return');
//Route::get('inventory/view/{$id}', 'InventoryController@updateInfo');
// Route::get('inventory/view/{$id}', 'InventoryController@updateInfo');
// Route::get('inventory/deploy', 'InventoryController@deploy');
Route::resource('inventory','InventoryController');
Route::resource('deploy','DeployInventoryController');
Route::resource('events', 'EventsController');
Route::resource('calendar', 'Calendar');


//Costing
Route::get('event_costing/{event_id}','EventsCostingController@show');
Route::resource('event_costing','EventsCostingController');

//Event Budget Template
Route::get('event_budget_template','EventsBudgetTemplateController@index')->name("event_budget_template");
Route::post('event_budget_template','EventsBudgetTemplateController@store')->name('post.event_budget_template');
//Event Budget
Route::get('event_budgets','EventsBudgetController@index')->name("event_budgets");
Route::get('event_budgets/view/{event_id}','EventsBudgetController@show')->name("get.event_budgets");
Route::post('event_budgets/','EventsBudgetController@create')->name("post.event_budgets");

//Personnel API
Route::get('avail_personnels/{event_id}','EventsBudgetController@get_available_personnel')->name("get.personnels");
Route::get('add_personnel/{emp_id}/{event_id}','EventsBudgetController@save_personnel')->name("get.personnels");

//Gmail API
Route::get('send_mail','MailController@index');
Route::get('email/{send_name}/{send_email}/{subject}','MailController@send_email');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


Route::resource('outsource', 'OutsourcingController');
Route::resource('ingredient', 'IngredientController');
Route::resource('food', 'FoodController');
Route::resource('users', 'UsersController');
Route::resource('employee', 'EmployeeController');
Route::resource('eventreport', 'EventLogisticsReportController');
Route::resource('manageuser', 'ManageUsersController');

Route::get('admin/routes', 'AdminController@admin')->middleware('admin');

// Route::resource('cal','gCalendarController');
// Route::get('oauth', 'gCalendarController@oauth');


//Rosette's Routes
Route::resource('bookevent', 'BookEventController');

Route::get('selectpackages/{event_id}', 'SelectPackageController@index')->name('get.selectpackages');
Route::post('postselectpackages/', 'SelectPackageController@create')->name('post.selectpackages');
Route::get('customize_package/{event_id}/{package_id?}', 'SelectPackageController@index')->name('customize_package');
Route::resource('clientregister', 'ClientRegisterController');

Route::resource('inventoryDash', 'InventoryHomeController');

Route::get('/send/email', 'HomeController@mail');

Route::resource('returnInventory','ReturnInventoryController');
Auth::routes();
