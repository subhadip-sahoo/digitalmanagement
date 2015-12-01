<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


//route for location page

Route::model('location', 'App\Location');
/*Route::get('locations/', 'CommonController@locations');
Route::get('/create-location', 'CommonController@createLocation');
Route::get('/edit-location/{location}', 'CommonController@editLocation');
Route::get('/delete-location/{location}', 'CommonController@deleteLocation');
Route::post('/create-location', 'CommonController@handleCreateLocation');
Route::post('/edit-location', 'CommonController@handleEditLocation');
Route::post('/delete-location', 'CommonController@handleDeleteLocation');*/


//route for employee page

Route::model('employee', 'App\Employee');
/*Route::get('employees/', 'CommonController@employees');
Route::get('/create-employee', 'CommonController@createEmployee');
Route::get('/edit-employee/{employee}', 'CommonController@editEmployee');
Route::get('/delete-employee/{employee}', 'CommonController@deleteEmployee');
Route::post('/create-employee', 'CommonController@handleCreateEmployee');
Route::post('/edit-employee', 'CommonController@handleEditEmployee');
Route::post('/delete-employee', 'CommonController@handleDeleteEmployee');*/


//route for receptionist page

Route::model('receptionist', 'App\Receptionist');
/*Route::get('/edit-receptionist/{receptionist}', 'CommonController@editReceptionist');
Route::get('receptionists/', 'CommonController@receptionists');
Route::get('/create-receptionist', 'CommonController@createReceptionist');

Route::get('/delete-receptionist/{receptionist}', 'CommonController@deleteReceptionist');
Route::post('/create-receptionist', 'CommonController@handleCreateReceptionist');
Route::post('/edit-receptionist', 'CommonController@handleEditReceptionist');
Route::post('/delete-receptionist', 'CommonController@handleDeleteReceptionist');*/


//route for visitor type page

Route::model('visitortype', 'App\VisitorType');
/*Route::get('visitortypes/', 'CommonController@visitortypes');
Route::get('/create-visitortype', 'CommonController@createVisitortype');
Route::get('/edit-visitortype/{visitortype}', 'CommonController@editVisitortype');
Route::get('/delete-visitortype/{visitortype}', 'CommonController@deleteVisitortype');
Route::post('/create-visitortype', 'CommonController@handleCreateVisitortype');
Route::post('/edit-visitortype', 'CommonController@handleEditVisitortype');
Route::post('/delete-visitortype', 'CommonController@handleDeleteVisitortype');*/



// connect with corresponding model.
Route::model('visitor', 'App\Visitor');
//route for index page, call index method of controller
//Route::get('visitors/', 'VisitorsController@index');
//route for create visitor page.
/*Route::get('/create-appointment', 'VisitorsController@create');*/
//route for edit visitor page.
//Route::get('/edit-appointment/{visitor}', 'VisitorsController@edit');
//route for delete emplooyee page
/*Route::get('/delete-appointment/{visitor}', 'VisitorsController@delete');
// route for form submission call handleCreate method.
Route::post('/create-appointment', 'VisitorsController@handleCreate');
//route to handle edit form submission
Route::post('/edit-appointment', 'VisitorsController@handleEdit');
//route to handle delete.
Route::post('/delete-appointment', 'VisitorsController@handleDelete');*/

//route for admin page

// connect with corresponding model.
Route::model('site', 'App\Site');
Route::get('admin/', 'CommonController@admincontrol');
Route::get('/edit-siteinfo', 'CommonController@editSiteinfo');
Route::post('/edit-siteinfo', 'CommonController@handleEditSiteinfo'); 

/*Route::get('/tracker', 'TrackerController@index');
// A route group allows us to have a prefix, in this case api
Route::group(array('prefix' => 'api'), function()
{
    Route::resource('time', 'TimeEntriesController');
    Route::resource('visitors', 'VisitorsController');
});*/

use App\Site;
use LaravelCaptcha\Lib\Captcha;
use Jenssegers\Agent\Agent;

Route::get('/home', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		$agent = new Agent();
		if($agent->isMobile() && Auth::user()->role_id == 3){
			return view('createappointment');
		}else{
			return view('welcome');
		}
	}else{
		return view('auth/login'); 
	}
});
Route::get('/', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		$agent = new Agent();
		if($agent->isMobile() && Auth::user()->role_id == 3){
			return view('createappointment');
		}else{
			return view('welcome');
		}
	}else{
		return view('auth/login'); 
	}
});
Route::get('settings/', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		return view('settings');
	}else{
		return view('auth/login'); 
	}
});
Route::get('locations/', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		return view('locations');
	}else{
		return view('auth/login'); 
	}
});
Route::get('visitortypes/', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		return view('visitortypes');
	}else{
		return view('auth/login'); 
	}
});
Route::get('employees/', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		return view('employees');
	}else{
		return view('auth/login'); 
	}
});
Route::get('receptionists/', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		return view('receptionists');
	}else{
		return view('auth/login'); 
	}
});
Route::get('reports/', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		return view('reports');
	}else{
		return view('auth/login'); 
	}
});

Route::get('create-appointment/', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		return view('createappointment');
	}else{
		return view('auth/login'); 
	}
});

Route::get('create-appointment/{id}', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		return view('createappointment');
	}else{
		return view('auth/login'); 
	}
});

Route::get('visitors/', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		return view('visitors');
	}else{
		return view('auth/login'); 
	}
});

Route::get('all-admin/', function()
{
	View::share ( array('site'=> Site::all()->first(),'captcha' => (new Captcha)->html()) );	
	if(Auth::check())
	{	
		return view('alladmin');
	}else{
		return view('auth/login'); 
	}
});

// API ROUTES ==================================  
Route::group(array('prefix' => 'api'), function() {
	Route::resource('welcome', 'CommonController@index');
	
	Route::resource('settings', 'CommonController@settings');
	Route::post('settings/update/{userdate}', 'CommonController@updateuser');
	
	Route::post('locations/create', 'LocationController@create'); 
	Route::post('locations/update/{location}', 'LocationController@update'); 
	Route::resource('locations', 'LocationController');
	
	Route::post('visitortypes/create', 'VisitortypeController@create'); 
	Route::post('visitortypes/update/{visitortype}', 'VisitortypeController@update'); 
	Route::resource('visitortypes', 'VisitortypeController');
	
	Route::post('alladmin/create', 'AlladminController@create'); 
	Route::post('alladmin/update/{alladmin}', 'AlladminController@update'); 
	Route::resource('alladmin', 'AlladminController');
	
	Route::post('employees/create', 'EmployeeController@create'); 
	Route::post('employees/update/{employee}', 'EmployeeController@update'); 
	Route::get('importemployees/', 'EmployeeController@importUserList');
	Route::get('employees/destroyall', 'EmployeeController@destroyall'); 
	Route::resource('employees', 'EmployeeController');
	
	Route::post('receptionists/create', 'ReceptionistController@create'); 
	Route::post('receptionists/update/{receptionist}', 'ReceptionistController@update'); 
	Route::post('receptionists/upload', 'ReceptionistController@upload'); 
	Route::resource('receptionists', 'ReceptionistController');
	
	Route::resource('reports', 'CommonController@reports');
	Route::get('filterreports/{reportdata}', 'CommonController@filterreports');
	
	Route::get('createappointment/{id}', 'VisitorsController@show');
	Route::post('updateappointment/{visitor}', 'VisitorsController@update'); 
	Route::get('gethostname/{id}', 'VisitorsController@getHostName'); 
	Route::post('create-appointment', 'VisitorsController@handleCreate'); 
	Route::post('edit-appointment', 'VisitorsController@handleEdit'); 
	Route::post('createimage', 'VisitorsController@createimage');
	Route::resource('createappointment', 'VisitorsController@create');
	Route::get('statuschange/{vdata}', 'VisitorsController@statuschange');
	Route::get('resetvisitor', 'VisitorsController@resetvisitor');
	
	Route::get('visitors/', 'VisitorsController@index');
	Route::resource('visitors', 'VisitorsController');
});
