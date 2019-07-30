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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


Route::resource('outsource', 'OutsourcingController');
Route::resource('ingredient', 'IngredientController');
Route::resource('food', 'FoodController');
Route::resource('users', 'ManageUsersController');
Route::resource('employee', 'EmployeeController');
Route::resource('eventreport', 'EventLogisticsReportController');
Route::resource('returnInventory', 'ReturnInventoryController');
Route::resource('manageuser', 'ManageUsersController');

Route::get('admin/routes', 'AdminController@admin')->middleware('admin');


// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/google-calendar/connect', 'GoogleCalendarController@connect');
// Route::post('/google-calendar/connect', 'GoogleCalendarController@store');
// Route::get('get-resource', 'GoogleCalendarController@getResources');


Route::resource('cal','gCalendarController');
Route::get('oauth', 'gCalendarController@oauth');



