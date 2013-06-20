<?php

class PerformanceController extends BaseController {

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

	public function getIndex()
	{
		$top_primary_schools = DB::table('kcpe_results_2011')->orderBy('national', 'asc')->take(10)->get();
		
		$data = array('top_primary_schools' => $top_primary_schools);
		return View::make('home', $data);
	}
	
	public function getPrimarySchool($params)
	{
		$param = explode(':', $params);
		$school_data_2011 = NULL;
		$school_data_2010 = NULL;
		$school_name = NULL;
		$district_name = NULL;
		$county_name = NULL;
		
		
		if ($param[0] == '2011') {
			$school_data_2011 = DB::table('kcpe_results_2011')->where('school_code', $param[1])->take(1)->get();
			$school_data_2010 = DB::table('kcpe_results_2010')->where('school_name', $school_data_2011[0]->school_name)->take(1)->get();
			$school_name = ucwords(strtolower($school_data_2011[0]->school_name));
			$district_name = ucwords(strtolower($school_data_2011[0]->district_name));
			$county_name = ucwords(strtolower($school_data_2011[0]->county_name));
		}
		if ($param[0] == '2010') {
			$school_data_2010 = DB::table('kcpe_results_2010')->where('school_code', $param[1])->take(1)->get();
			$school_data_2011 = DB::table('kcpe_results_2011')->where('school_name', $school_data_2011[0]->school_name)->take(1)->get();
			$school_name = ucwords(strtolower($school_data_2010[0]->school_name));
			$district_name = ucwords(strtolower($school_data_2010[0]->district_name));
			$county_name = ucwords(strtolower($school_data_2010[0]->county_name));
		}
		
		$data = array('school_2011' => $school_data_2011, 'school_2010' => $school_data_2010, 'school_name' => $school_name, 'county_name' => $county_name,  'district_name' => $district_name);
		return View::make('performance_school_primary', $data);
	}

}