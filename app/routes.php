<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function()
{
	$companies = Company::lists('name','id');
	$places = Places::lists('name','id');
	return View::make('hello')->with(array('places' => $places, 'companies' => $companies));
});

Route::get('/fullreport', 'ReportController@showFullReport');
Route::get('/simplereport', 'ReportController@showReport');


Route::get('/x', function()
{
//	return 'Users!';
	//$answers = Answers::all();
	
	$companyId = Company::where('name', '=', 'Компас')->firstOrFail()->id;
	$forms = Forms::where('company_id', '=', $companyId)->take(999)->get();
	$answers = Answers::whereIn('form_id', $forms)->get();
	$count = Forms::where('company_id', '=', $companyId)->count();
	//return View::make('heelo')->with('forms', $forms);
	//return View::make('hello');
	return View::make('heelo')->with('asnwers', $asnwers);
});

Route::get('users', function()
{
    return 'Users!';
});

