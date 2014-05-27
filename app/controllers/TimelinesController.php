<?php

class TimelinesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$timelines = Timeline::all();
		return View::make('timelines.index', compact('timelines'));
	}



}
