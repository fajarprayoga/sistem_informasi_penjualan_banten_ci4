<?php namespace App\Controllers;

use App\Models\Order_detail_model;
use App\Models\Order_model;
use CodeIgniter\Controller;
use App\Models\Product_model;
use Dompdf\Dompdf;
 
class Order extends Controller
{
    protected $helpers = [];

    public function __construct()
    {
        $this->session = session();
        $this->product_model = new Product_model();
        $this->order_model = new Order_model();
        $this->order_detail_model = new Order_detail_model();
        $this->db = db_connect();
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
             $where = ['orders.order_status' => $status];
         }
         if(!empty($search)){
            preg_match_all('!\d+!', $search, $matches);
            $like   = ['orders.order_id' => $search];
            $or_like   = ['username' => $search, 'order_id' =>  count($matches[0]) > 0 ?$matches[0][0] : $search];
         }
        $paginate = 5;
        $data['orders'] = $this->order_model->orderBy('orders.order_id','desc')
            ->join('users', 'users.id = orders.user_id')
            ->like($like)
            ->orLike($or_like)
            ->where($where)
            ->paginate($paginate, 'order');
        
        $data['pager'] = $this->order_model->pager;
          // generate number untuk tetap bertambah meskipun pindah halaman paginate
          $nomor = $this->request->getGet('page_product');
          // define $nomor = 1 jika tidak ada get page_product
          if($nomor == null){
              $nomor = 1;
          }
          $data['nomor'] = ($nomor - 1) * $paginate;
          // end generate number
  

        echo view('order/index', $data);
    }

    public function order_detail($id)
    {
        // $data['order'] = $this->order_model->getOrder($id);
        $data['order'] = $this->order_model->join('users', 'users.id = orders.user_id')->getOrder($id);
        $data['order_details'] = $this->order_detail_model->getOrderDetail($id);
        return view('order/detail', $data);
    }

    public function update_status_market($id)
    {
         if ($this->request->isAJAX()) {
            $data['order_status'] = service('request')->getPost('order_status');
            $return =   $this->order_model->updateOrder($data, $id);
            if($return){
                return 'Your order is canceled';
            }else{
                return 'Opps order is not cancel';
            }
        }
    }

    public function update_status($id)
    {
        $validation =  \Config\Services::validation();
        $data = array(
            'order_status'     => $this->request->getPost('order_status'),
        );

        if($validation->run($data, 'order_status') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('admin/order'));
        }else{
            $return =   $this->order_model->updateOrder($data, $id);
            if($return)
            {
                session()->setFlashdata('info', 'Updated Order Status successfully');
                return redirect()->to(base_url('admin/order')); 
            }
        } 
    }

    public function report()
    {
        $where  = [];
        $status = $this->request->getGet('order_status_report');
        $start = $this->request->getGet('start');
        $end = $this->request->getGet('end');
        if(!empty($status)){
            $where = ['orders.order_status' => $status];
        }
        if(!empty($start) && !empty($end)){
            $data['orders'] = $this->order_model->where($where)->where("created_at BETWEEN " ."'$start '". 'AND '. "'$end'")->orderBy('order_id', 'DESC')->join('users', 'users.id = orders.user_id')->get()->getResultArray();
        }
        else{
            $data['orders'] = $this->order_model->where($where)->orderBy('order_id', 'DESC')->join('users', 'users.id = orders.user_id')->get()->getResultArray();
        }

        $data['order_details'] = $this->order_detail_model;
        $filename = date('y-m-d-H-i-s'). '-qadr-labs-report';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('order/report', $data ));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
        return view('order/report', $data);
    }


}