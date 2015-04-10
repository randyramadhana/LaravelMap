<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('new');
	}

	public function attach()
	{
		if (Input::hasFile('attach')) {
			$file = Input::file('attach');
			$handle = fopen($file, 'r');
			$head = fgetcsv($handle);
			fgetcsv($handle); //blank line
			while (($data = fgetcsv($handle)) !== FALSE)
			{
			 	$column = array_combine($head, $data);
			 	$location = Location::create(array('name' => $column['Nama Lokasi'], 'level' => $column['Level'], 'polygonal_coordinates' => $column['Polygon XML']));
			}
		}
		return View::make('map');
	}

	public function deleteAll() {
		Location::truncate();
		Marker::truncate();
		return View::make('new');
	}

}
