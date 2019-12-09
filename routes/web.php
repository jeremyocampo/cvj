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


//Route::get('/', 'PagesController@home');
// Route::get('/about', 'PagesController@about');
// Route::get('/contact', 'PagesController@contact');

// Route::get('/', function () {

//     return view('home', [
//     	'foo' => 'Caterie Yo'
//     ]);
// });

// Route::get('/about', function () {
//     return view('about');
// });

// Route::get('/contact', function () {
//     return view('contact');
// });



// Route::get('/home', 'HomeController@index')->name('home');

	// Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	
	// Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);


// Route::get('/inventory', 'InventoryController@show')->name('inventory');


// Route::get('/inventory', 'InventoryController@index')->name('inventory');

//Jeremy's Routess
// Route::get('', 'InventoryHomeController@index')->name('home');
// Route::get('/', 'InventoryHomeController@index')->name('home');
// Route::get('/home', 'InventoryHomeController@index')->name('home');

Route::get('inventory/return', 'InventoryController@return');
//Route::get('inventory/view/{$id}', 'InventoryController@updateInfo');
Route::get('inventory/view/{$id}', 'InventoryController@updateInfo');
Route::get('inventory/deploy', 'InventoryController@deploy');
// Route::get('inventory/view/{id}', function ($id) {
// 	return redirect()->route( 'inventory.updateInfo' )->with( [ 'id' => $id ] ); 
// });
// Route::get('inventory/view/{id}', function ($id) {
//     return redirect()->route( 'inventory.view' )->with( [ 'id' => $id ] );
// });
Route::resource('inventory','InventoryController');
Route::resource('deploy','DeployInventoryController');
Route::resource('events', 'EventsController');
Route::resource('/roset', 'Roset');
Route::resource('calendar', 'Calendar');

//MARKzs Routes

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
//Gmail API
Route::get('send_mail','MailController@index');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('ingredient', 'IngredientController');
Route::resource('food', 'FoodController');
Route::resource('users', 'ManageUsersController');
Route::resource('employee', 'EmployeeController');
Route::resource('eventreport', 'EventLogisticsReportController');
Route::resource('returnInventory', 'ReturnInventoryController');
Route::resource('manageuser', 'ManageUsersController');

Route::get('admin/routes', 'AdminController@admin')->middleware('admin');

// Route::resource('cal','gCalendarController');
// Route::get('oauth', 'gCalendarController@oauth');
Route::get('list_events', 'EventsController@list_events')->name('list_events');
Route::get('list_packages', 'SelectPackageController@list_packages')->name('list_packages');

Route::get('summary/{event_id}', 'SelectPackageController@summary');

Route::get('client_quotation/{event_id}', 'QuotationController@client_quotation')->name('client_quotation');
Route::get('client_reservation/{event_id}', 'QuotationController@client_reservation')->name('client_reservation');
Route::get('company_quotation/{event_id}', 'QuotationController@company_quotation')->name('company_quotation');
//Dummy Test URLS: For Frontend prototyping
Route::get('test_page1/{event_id}/{package_id?}', 'SelectPackageController@test_page1')->name('test_page1');

Route::get('/home', 'HomeController@index')->name('home');

//Rosette's Routes
Route::resource('bookevent', 'BookEventController');

Route::resource('eventdashboard','EventsHomeDashboard');
Route::resource('confirmevents', 'ConfirmEventsController');

Route::get('confirm_event/{event_id}', 'ConfirmEventsController@confirm_event');

Route::get('date_range', 'DateRangeController@index');

Route::get('bookevent/edit/{event_id}', 'BookEventController@editEventDetails')->name('edit.bookevent');
Route::post('editevent', 'BookEventController@PosteditEventDetails')->name('post.editevent');
Route::get('/export_quotation/{event_id}','QuotationController@export_quotation_pdf');


Route::get('/download/storage/public/{file}', 'FileController@download');
Route::post('change_costing_method', 'QuotationController@change_costing_method')->name('post.costing_method');

Route::post('upload_event_forms', 'FileController@upload_event_forms')->name('file_upload');
//packages routes
Route::get('selectpackages/{event_id}', 'SelectPackageController@index')->name('get.selectpackages');
Route::post('postselectpackages/', 'SelectPackageController@select')->name('post.selectpackages');

Route::get('additional_package/{event_id}/{package_id?}', 'SelectPackageController@additional_package')->name('additional_package');
Route::get('customize_package/{package_id?}', 'SelectPackageController@show')->name('customize_package');
Route::post('customize_package', 'SelectPackageController@create')->name('post.customize_package');
Route::post('create_with_additions', 'SelectPackageController@create_with_additions')->name('post.create_with_additions');

Route::get('edit_event_package/{event_id}', 'SelectPackageController@edit_event_package')->name('get.edit_event_package');
Route::post('edit_event_package/post', 'SelectPackageController@post_edit_event_package')->name('post.edit_event_package');

Route::get('remove_event_package/{event_id}', 'SelectPackageController@destroy')->name('destroy');

//ajax
Route::post('add_client_ajax', 'BookEventController@add_client_ajax')->name('ajax.client_add');


Route::resource('clientregister', 'ClientRegisterController');

Route::resource('addpackages', 'AddPackageController');

Route::resource('inventoryDash', 'InventoryHomeController');

Route::get('/send/email', 'HomeController@mail');

Route::resource('returnInventory','ReturnInventoryController');
Auth::routes();

Route::resource('confirmevents', 'ConfirmEventsController');

Route::resource('expenseReports', 'ExpenseReportsController');
Route::resource('quotationReports', 'QuotationReportsController');

Route::get('qr-code-g', function () {
    \QrCode::size(500)
              ->format('png')
              ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));
      
    return view('qrCode');
});

Route::resource('addpackages', 'BookEventController');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('suppliers', 'SupplierController');
    Route::get('suppliers/{supplier}/state', 'SupplierController@state');
    Route::post('suppliers/{supplier}/contact-person', 'SupplierController@addContact');
    Route::post('suppliers/{supplier}/supplier-item', 'SupplierController@addItem');

    Route::get('email/{order}', 'PurchaseOrderController@email');
    Route::get('receive/{order}', 'PurchaseOrderController@receive');
    Route::resource('purchase-orders', 'PurchaseOrderController');
    Route::get('events', 'ReservationController@getEvent');
    Route::resource('reservations', 'ReservationController');
});