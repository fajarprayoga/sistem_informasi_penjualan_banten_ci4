<?php namespace App\Controllers\Market;
use App\Controllers\BaseController;
class Home extends BaseController
{
	public function index()
	{
		return view('ui/home');
	}

	public function account_number()
	{
		return view('ui/account_number');
	}

	public function term_and_service()
	{
		return view('ui/term_service');
	}

}
