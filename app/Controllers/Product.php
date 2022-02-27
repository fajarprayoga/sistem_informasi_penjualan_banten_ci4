<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Product_model;
use App\Models\Category_model;
// use App\Models\Sub_Category_Model;
use Dompdf\Dompdf;
class Product extends Controller
{
    protected $helpers = [];

    public function __construct()
    {
		// $this->cek_login();
        helper(['form']);
        $this->category_model = new Category_model();
        $this->product_model = new Product_model();
	}

    // public function cek_login()
	// {
	// 	if($this->cek_login() == FALSE){
	// 		session()->setFlashdata('error_login', 'Silahkan login terlebih dahulu untuk mengakses data');
	// 		if(session()->get('login')){

	// 			return redirect()->to('/');
	// 		}else{
				
	// 			return redirect()->to('auth/login');
	// 		}
	// 	}
	// }

    public function index()
    {
        $category           = $this->request->getGet('category');
        $keyword            = $this->request->getGet('keyword');

        $data['category']   = $category;
        $data['keyword']    = $keyword;

        $categories         = $this->category_model->where('category_status', 'Active')->findAll();
        $data['categories'] = ['' => 'Pilih Category'] + array_column($categories, 'category_name', 'category_id');

        // filter
        $where      = [];
        $like       = [];
        $or_like    = [];

        if(!empty($category)){
            $where = ['products.category_id' => $category];
        }

        if(!empty($keyword)){
            $like   = ['products.product_name' => $keyword];
            $or_like   = ['products.product_sku' => $keyword, 'products.product_description' => $keyword];
        }
        // end filter

        // paginate
        $paginate = 5;
        $data['products']   = $this->product_model->join('categories', 'categories.category_id = products.category_id')->where($where)->like($like)->orLike($or_like)->paginate($paginate, 'product');
        $data['pager']      = $this->product_model->pager;

        // generate number untuk tetap bertambah meskipun pindah halaman paginate
        $nomor = $this->request->getGet('page_product');
        // define $nomor = 1 jika tidak ada get page_product
        if($nomor == null){
            $nomor = 1;
        }
        $data['nomor'] = ($nomor - 1) * $paginate;
        // end generate number

        echo view('product/index', $data);
    }
 
    public function create()
    {
        $categories = $this->category_model->where('category_status', 'Active')->findAll();
        $data['categories'] = ['' => 'Pilih Kategori'] + array_column($categories, 'category_name', 'category_id');
        return view('product/create', $data);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        // get file
        if ($imagefile = $this->request->getFileMultiple('product_image')) {
            foreach($imagefile as $image){
                $name = $this->request->getPost('product_name').'-'.$image->getClientName();
                $dataImage[] = $this->request->getPost('product_name').'-'.$image->getClientName();
                $image->move(ROOTPATH . 'public/uploads', $name);
            }
            
            $data = array(
                'category_id'           => $this->request->getPost('category_id'),
                // 'sub_category_id'       => $this->request->getPost('sub_category_id'),
                'product_name'          => $this->request->getPost('product_name'),
                'product_price'         => $this->request->getPost('product_price'),
                'product_sku'           => $this->request->getPost('product_sku'),
                'product_status'        => $this->request->getPost('product_status'),
                'product_image'         => json_encode($dataImage),
                'product_description'   => $this->request->getPost('product_description'),
            );

            if($validation->run($data, 'product') == FALSE){
                    session()->setFlashdata('inputs', $this->request->getPost());
                    session()->setFlashdata('errors', $validation->getErrors());
                    return redirect()->to(base_url('admin/product/create'));
            } else {

                // upload
                // $image->move(ROOTPATH . 'public/uploads', $name);
                // insert
                $simpan = $this->product_model->insertProduct($data);
                if($simpan)
                {
                    session()->setFlashdata('success', 'Created Product successfully');
                    return redirect()->to(base_url('admin/product')); 
                }
            }
        }
    }
 
    public function show($id)
    {  
        $data['product'] = $this->product_model->getProduct($id);
        echo view('product/show', $data);
    }
    
    public function edit($id)
    {  
        $categories = $this->category_model->where('category_status', 'Active')->findAll();
        // $m_sub_category = new Sub_Category_Model(); 
        $data['categories'] = ['' => 'Pilih Kategori'] + array_column($categories, 'category_name', 'category_id');
        $data['product'] = $this->product_model->getProduct($id);
        // $data['sub_categories'] = $m_sub_category->getSubCategory($data['product']['category_id'])->getResultArray();
        // dd($data['sub_categories']->getResultArray());
        echo view('product/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('product_id');
        $product = $this->product_model->getProduct($id);
        $validation =  \Config\Services::validation();
        $imagefile = $this->request->getFileMultiple('product_image');

        if (!empty($_FILES['product_image']['name'][0])) {
            foreach($imagefile as $image){
                $name = $this->request->getPost('product_name').'-'.$image->getClientName();
                $dataImage[] = $this->request->getPost('product_name').'-'.$image->getClientName();
                $image->move(ROOTPATH . 'public/uploads', $name);
            }

            $data = array(
                'category_id'           => $this->request->getPost('category_id'),
                // 'sub_category_id'       => $this->request->getPost('sub_category_id'),
                'product_name'          => $this->request->getPost('product_name'),
                'product_price'         => $this->request->getPost('product_price'),
                'product_sku'           => $this->request->getPost('product_sku'),
                'product_status'        => $this->request->getPost('product_status'),
                'product_image'         => json_encode($dataImage),
                'product_description'   => $this->request->getPost('product_description'),
            );

            $images = json_decode($product['product_image']);
            
            foreach($images as $image) {
                if(file_exists($image)){
                    unlink('public/uploads/'. $image);
                }
            }
        }else{
            $data = array(
                'category_id'           => $this->request->getPost('category_id'),
                // 'sub_category_id'       => $this->request->getPost('sub_category_id'),
                'product_name'          => $this->request->getPost('product_name'),
                'product_price'         => $this->request->getPost('product_price'),
                'product_sku'           => $this->request->getPost('product_sku'),
                'product_status'        => $this->request->getPost('product_status'),
                'product_description'   => $this->request->getPost('product_description'),
            );
        }

        if($validation->run($data, 'product') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('admin/product/edit/'.$id));
        } else {

            // upload
            // $image->move(ROOTPATH . 'public/uploads', $name);
            // insert
            $ubah = $this->product_model->updateProduct($data, $id);
            if($ubah)
            {
                session()->setFlashdata('info', 'Updated Product successfully');
                return redirect()->to(base_url('admin/product')); 
            }
        }
    }
 
    public function delete($id)
    {
        $hapus = $this->product_model->deleteProduct($id);
        if($hapus)
        {
            session()->setFlashdata('warning', 'Deleted Product successfully');
            return redirect()->to(base_url('product')); 
        }
    }
    public function report()
    {
        $where=[];
        $status = $this->request->getGet('order_status_report');

        if(!empty($status)){
            $where = ['products.product_status' => $status];
        }

        $data['products'] = $this->product_model->where($where)->getProduct();
        $filename = date('y-m-d-H-i-s'). '-qadr-labs-report';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('product/report', $data ));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}