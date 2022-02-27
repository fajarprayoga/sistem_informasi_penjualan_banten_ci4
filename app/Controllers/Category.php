<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Category_model;
use App\Models\Sub_Category_Model;
 
class Category extends Controller
{

    function __construct() {
        $this->db = db_connect();
    }

    public function index()
    {
        // $this->cek_login();
        $model = new Category_model();
        $data['categories'] = $model->getCategory();
        echo view('category/index', $data);
    }
    public function create()
    {
        return view('category/create');
    }

    public function store()
    {
        $validation =  \Config\Services::validation();
        $categoryLastId = $this->db->query("SELECT category_id FROM categories ORDER BY category_id DESC");
        $data = array(
            'category_name'     => $this->request->getPost('category_name'),
            'category_status'   => $this->request->getPost('category_status'),
        );

        $validation->run($data, 'category_create');

        if($validation->run($data, 'category_create') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('/admin/category/create'));
        } else {
            $model = new Category_model();

            $this->db->transBegin();
            $categoryId = $model->insertCategory($data);
            
            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                session()->setFlashdata('errors', 'Kategori gagal di tambahkan ');
            } else {
                $this->db->transCommit();
                session()->setFlashdata('success', 'Kategori di tambakan');
                return redirect()->to(base_url('/admin/category')); 
            }
        }

        // dd($this->request->getPost('sub_category_name'));
    }
 
    public function edit($id)
    {  
        $m_category = new Category_model();
        $data['category'] = $m_category->getCategory($id)->getRowArray();
        echo view('category/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('category_id');

        $validation =  \Config\Services::validation();

        $data = array(
            'category_name'     => $this->request->getPost('category_name'),
            'category_status'   => $this->request->getPost('category_status'),
        );
        
        if($validation->run($data, 'category_update') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('admin/category/edit/'.$id));
        } else {
            $this->db->transBegin();
            $m_category = new Category_model();

            $m_category->updateCategory($data, $id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                session()->setFlashdata('errors', 'Kategori gagal di rubah');
            } else {
                $this->db->transCommit();
                session()->setFlashdata('success', 'Kategori berhasil di rubah');
                return redirect()->to(base_url('/admin/category')); 
            }
        }
    }
 
    public function delete($id)
    {
        $model = new Category_model();
        $hapus = $model->deleteCategory($id);
        if($hapus)
        {
            session()->setFlashdata('warning', 'Deleted Category successfully');
            return redirect()->to(base_url('category')); 
        }
    }

    public function testajax()
    {
        echo 'tes ajax';
    }
}