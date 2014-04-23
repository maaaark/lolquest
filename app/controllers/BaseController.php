<?php

class BaseController extends Controller {
	use Efficiently\AuthorityController\ControllerAdditions;

	protected $layout = 'layouts.master';

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
	
	public function noAccess()
	{
		return View::make('layouts.403');
	}
	
	public function notFound()
	{
		return View::make('layouts.404');
	}

}