<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\User_model;
use Dompdf\Dompdf;

class User extends Controller
{

    function __construct() {
        $this->db = db_connect();
        $this->user_model = new User_model();
        helper(['notable', 'form']);
    }

    public function index()
    {
 
        $status           = $this->request->getGet('status');
        $search            = $this->request->getGet('search');

         // filter
         $where      = [];
         $like       = [];
         $or_like    = [];
 
         if(!empty($status)){
             $where = ['status' => $status];
         }
         if(!empty($search)){
            $like   = ['username' => $search];
            $or_like   = ['name' =>  $search, 'phone' =>  $search, 'email' =>  $search];
         }
        $paginate = 5;


        $data = [
            'users' => $this->user_model->where($where)->like($like)->orLike($or_like)->orderBy('id', 'DESC')->paginate($paginate, 'jq'),
            'pager' => $this->user_model->pager,
            'no'    => nomor($this->request->getVar('page_jq'), 10)
        ];
          // generate number untuk tetap bertambah meskipun pindah halaman paginate
          $nomor = $this->request->getGet('page_product');
          // define $nomor = 1 jika tidak ada get page_product
          if($nomor == null){
              $nomor = 1;
          }
          $data['nomor'] = ($nomor - 1) * $paginate;
          // end generate number
  
        echo view('user/index', $data);
    }

    function edit($id){
        $data['user']=$this->user_model->getUser('id',$id);
        echo view('user/edit', $data);
    }

    public function update()
    {
        // dd($this->request->getPost());
        $validation =  \Config\Services::validation();
        $id = $this->request->getPost('id');
        $data = array(
            'id'       => $this->request->getPost('id'),
            'username' => $this->request->getPost('username'),
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'status' => $this->request->getPost('status'),
            'level' => $this->request->getPost('level'),
        );

        if(!empty($this->request->getPost('password'))){
            $data['password'] =$this->request->getPost('password');
            if($validation->run($data, 'password') == FALSE){
                session()->setFlashdata('inputs', $this->request->getPost());
                session()->setFlashdata('errors', $validation->getErrors());
                return redirect()->to(base_url('admin/user/edit/'.$id));
            }else{
                $data['password']=password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            }
        }

        if($validation->run($this->request->getPost(), 'userUpdate') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('admin/user/edit/'.$id));
        } else {
            // update
            $ubah = $this->user_model->updateProduct($data, $id);
            if($ubah)
            {
                session()->setFlashdata('info', 'Updated User successfully');
                return redirect()->to(base_url('admin/user')); 
            }
        }
    }
    public function report()
    {
        $where=[];
        $status = $this->request->getGet('user_status_report');

        if(!empty($status)){
            $where = ['users.status' => $status];
        }

        $data['users'] = $this->user_model->where($where)->getUser();
        $filename = date('y-m-d-H-i-s'). '-qadr-labs-report';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('user/report', $data ));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}