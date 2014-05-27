<?php

class TimelinesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$timelines = Timeline::orderBy('id', 'desc')->get();
		return View::make('timelines.index', compact('timelines'));
	}



}
