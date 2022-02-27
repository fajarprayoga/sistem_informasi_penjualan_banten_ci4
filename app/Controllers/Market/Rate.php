<?php namespace App\Controllers\Market;
use App\Controllers\BaseController;
use App\Models\Rate_model;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class Rate extends BaseController
{
	public function __construct()
    {
        $this->rate_model = new Rate_model();
		$this->session = session();
	}
    public function index()
    {
        $rates = $this->rate_model->getRate();
        return json_encode($rates);
    }
	public function create()
	{
        $data = [
            'user_id' => $this->session->get('id'),
            'rate_star' => $this->request->getPost('star'),
            'rate_review' => $this->request->getPost('review'),
        ];

        // var_dump($data);
        $rate = $this->rate_model->insertRate($data, $data['user_id']);
        
        return '200';
	}
}
