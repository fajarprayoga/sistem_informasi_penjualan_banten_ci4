<?php namespace App\Controllers\Market;
use App\Controllers\BaseController;
use App\Models\Auth_model;
class Auth extends BaseController
{

	// public function __construct()
    // {
	// 	$session = \Config\Services::session($config);
	// }


	public function cek_login()
	{
		// return view('ui/index');
        return 'Login Dahulu';
	}


	public function register()
    {
		if($this->cek_login() == TRUE){
			return redirect()->to(base_url('dashboard'));
		}
        return view('auth/register');
    }

	//--------------------------------------------------------------------

}
