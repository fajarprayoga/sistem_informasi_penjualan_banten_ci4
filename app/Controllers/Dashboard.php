<?php namespace App\Controllers;

use App\Models\Dashboard_model;

class Dashboard extends BaseController
{
	public function __construct()
    {
		// $this->cek_login();
		$this->dashboard_model = new Dashboard_model();
		// return ' no redirect';
	}
	
	public function index()
	{

		// if($this->cek_login() ==false){
		// 	return redirect()->to('auth/login');
		// }
		$data['total_transaction']	= $this->dashboard_model->getCountTrx();
		$data['total_product']		= $this->dashboard_model->getCountProduct();
		$data['total_category']		= $this->dashboard_model->getCountCategory();
		$data['total_user']			= $this->dashboard_model->getCountUser();
		$data['latest_trx']			= $this->dashboard_model->getLatestTrx();
		$data['status_success']		= $this->dashboard_model->getStatusSuccess();
		$data['status_pending']		= $this->dashboard_model->getStatusPending();
		$data['status_cancel']		= $this->dashboard_model->getStatusCancel();
		$chart['grafik']			= $this->dashboard_model->getGrafik();
		$data['get_grafik']			= count($chart['grafik']);
		// dd(count($this->dashboard_model->getGrafik()));
		echo view('dashboard', $data);
		echo view('_partials/footer', $chart);
    }
    
}