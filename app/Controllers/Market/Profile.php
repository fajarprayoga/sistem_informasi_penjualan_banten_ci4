<?php namespace App\Controllers\Market;
use App\Controllers\BaseController;
use App\Models\Product_model;
use App\Models\User_model;

class Profile extends BaseController
{
	public function __construct()
    {
        $this->user_model = new User_model();
	}

	public function index()
	{
		$data['user'] = $this->user_model->getUser('id', session()->get('id'));
		return view('ui/profile', $data);
	}

	public function Update()
	{
		$validation =  \Config\Services::validation();
		$id = $this->request->getPost('id');

		$data = array(
            'id'       => $this->request->getPost('id'),
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
        );

		if(!empty($this->request->getPost('password') && !empty($this->request->getPost('confirm_password')))){
			$pass['password'] =$this->request->getPost('password');
			$pass['confirm_password'] =$this->request->getPost('confirm_password');
			if($validation->run($pass, 'password_update') == FALSE){
				session()->setFlashdata('inputs', $this->request->getPost());
				session()->setFlashdata('errors', $validation->getErrors());
				return redirect()->to(base_url('market/profile'));
			}else{
				$data['password']=password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
			}
		}

		if($validation->run($this->request->getPost(), 'profile_update') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('market/profile'));
        }else{
			$ubah = $this->user_model->updateProduct($data, $id);
            if($ubah)
            {
                session()->setFlashdata('info', 'Updated User successfully');
                return redirect()->to(base_url('market/profile')); 
            }
		}

		// dd($this->request->getPost());
	}
}
