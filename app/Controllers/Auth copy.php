<?php namespace App\Controllers;
 
use App\Models\Auth_model;
use App\Models\User_model;
 
class Auth extends BaseController
{
    protected $helper = [];

    public function __construct()
    {
        helper(['form']);
        $this->cek_login();
        $this->auth_model = new Auth_model();
        // $session = session();
	}
    
    public function index()
    {
        // if($this->cek_login() == TRUE){
		// 	return redirect()->to(base_url('/dashboard'));
		// }
        echo view('auth/login');
    }

    public function login()
    {
        if($this->cek_login() == TRUE){
			if(session()->get('level') =='Admin'){
                return redirect()->to(base_url('/dashboard'));
            }else{
                return redirect()->to(base_url('/'));
            }
		}
        echo view('auth/login');
    }

    public function proses_login()
    {
        $validation =  \Config\Services::validation();

        $email  = $this->request->getPost('email');
        $pass   = $this->request->getPost('password');

        $data = [
            'email' => $email,
            'password' => $pass
        ]; 

        if($validation->run($data, 'authlogin') == FALSE){
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/auth/login'));
        } else {

            $cek_login = $this->auth_model->cek_login($email);

            // email didapatkan
            if($cek_login == TRUE){

                // jika email dan password cocok
                if(password_verify($pass, $cek_login['password'])){

                    if($cek_login['status'] == 'Active'){
                        session()->set('email', $cek_login['email']);
                        session()->set('name', $cek_login['name']);
                        session()->set('level', $cek_login['level']);
                        session()->set('status', $cek_login['status']);
                        session()->set('login', true);
                        if($cek_login['level'] == 'Admin'){
                            return redirect()->to(base_url('admin/dashboard'));      
                        }else{
                            return redirect()->to(base_url('/'));      
                        }    
                    }else{
                        session()->setFlashdata('errors', ['' => 'Akun ini tidak Active']);
                        return redirect()->to(base_url('/auth/login'));
                    }
                // email cocok, tapi password salah
                } else {
                    session()->setFlashdata('errors', ['' => 'Password yang Anda masukan salah']);
                    return redirect()->to(base_url('/auth/login'));
                }
            } else {
                // email tidak cocok / tidak terdaftar
                session()->setFlashdata('errors', ['' => 'Email yang Anda masukan tidak terdaftar']);
                return redirect()->to(base_url('auth/login'));
            }
        }
    }

    public function register()
    {
        if($this->cek_login() == TRUE){
			return redirect()->to(base_url('dashboard'));
		}
        return view('auth/register');
    }

    public function proses_register()
    {
        $validation =  \Config\Services::validation();

        $data = [
            'email'             => $this->request->getPost('email'),
            'name'              => $this->request->getPost('name'),
            'username'          => $this->request->getPost('username'),
            'password'          => $this->request->getPost('password'),
            'confirm_password'  => $this->request->getPost('confirm_password')
        ];

        if($validation->run($data, 'authregister') == FALSE){
            session()->setFlashdata('errors', $validation->getErrors());
            session()->setFlashdata('inputs', $this->request->getPost());
            return redirect()->to(base_url('auth/register'));
        } else {

            $datalagi = [
                'email'         => $this->request->getPost('email'),
                'name'          => $this->request->getPost('name'),
                'username'      => $this->request->getPost('username'),
                'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'status'        => "Active",
                'email_verified_at' => null,
                'level'         => "User"
            ];

            $simpan = $this->auth_model->register($datalagi);
            // dd($simpan);
            // $simpan['email'];
            $user = new User_model();

            $dataUser = $user->getUser('email', $simpan['email']);

            $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code = substr(str_shuffle($set), 0, 12);

            $message = 	"
            <html>
            <head>
                <title>Verification Code</title>
            </head>
            <body>
                <h2>Thank you for Registering.</h2>
                <p>Your Account:</p>
                <p>Email: ".$datalagi['email']."</p>
                <p>Password: ".$this->request->getPost('password')."</p>
                <p> ".base_url()."/auth/activate/".$dataUser['id']."/".$code." </p>
                <p>Please click the link below to activate your account.</p>
                <h4><a href='".base_url()."/auth/activate/".$dataUser['id']."/".$code."'>Activate My Account</a></h4>
            </body>
            </html>
        ";
            // date("Y-m-d h:i:s");
            
            $email = \Config\Services::email();
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'smtp.mailtrap.io',
                'smtp_port' => 2525,
                'smtp_user' => 'fa6b94e73ffaa5',
                'smtp_pass' => 'ae23bfb98e617f',
                'crlf' => "\r\n",
                'newline' => "\r\n"
            );
            $email->initialize($config);

            $email->setFrom('admin@gmail.com', 'Admin');
            $email->setTo('fajarprayoga23@gmail.com');
            // $email->setCC('another@another-example.com');
            // $email->setBCC('them@their-example.com');

            $email->setSubject('Tes Email');
            $email->setMessage($message);

            // $email->send();
           
            if($email->send()){
		    session()->setFlashdata('message','Activation code sent to email');
		    }
		    else{
		    session()->setFlashdata('message', $email->print_debugger());
		    }

            if($simpan){
                session()->setFlashdata('success_register', 'Register Successfully');
                return redirect()->to(base_url('auth/login'));
            }
            

        }

        // return redirect()->to(base_url()."auth/activate/1/2");
    }

    public function activate(){
       echo 'halo';
 
	}

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('auth/login'));
    }
}