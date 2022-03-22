<?php namespace App\Controllers\Market;
use App\Controllers\BaseController;
use App\Models\Order_detail_model;
use App\Models\Order_model;
use App\Models\Product_model;
use Dompdf\Dompdf;
class Checkout extends BaseController
{
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
        if(!$this->session->has('cart')){
            return redirect()->to(base_url('market')); 
        }
        $carts = $this->session->get('cart');
        $total = 0;
        foreach ($carts as $index => $cart) {
            $total = $total + ($cart['qty'] * $cart['price']);
        }
        $data['total']= $total;

        return view('ui/checkout',$data);
	}

    public function process()
    {
        if(!$this->session->has('cart')){
            return redirect()->to(base_url('market')); 
        }


        $validation =  \Config\Services::validation();
        $req= [
            'order_destination' =>  $this->request->getPost('order_destination'),
            'order_description' => $this->request->getPost('order_description')
        ];
        if($validation->run($req, 'checkout') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('market/checkout'));
        }else{
            $carts = $this->session->get('cart');
            $total =0;
            foreach ($carts as $index => $cart) {
                $total = $total + ($cart['qty'] * $cart['price']);
            }
            $idlast = ((int)$this->order_model->lastId()) + 1;

            $name = 'order'.$idlast.'.jpg';
            $image = $this->request->getFile('order_token');
               //  process chekout

            // data 
            $dataOrder = array(
                'user_id' => $this->session->get('id'),
                'order_destination' => $this->request->getPost('order_destination'),
                'order_description' => $this->request->getPost('order_description'),
                'order_total' => $total + getenv('delivery'),
                'order_type' => $this->request->getPost('type_pembayaran'),
                'order_pay_1' => $this->request->getPost('type_pembayaran') =='Dp' ? $this->request->getPost('pay') : 0,
                'order_pay_2' => $this->request->getPost('type_pembayaran') =='Full' ? $this->request->getPost('pay') : 0,
                'order_pickup_date' => $this->request->getPost('order_pickup_date'),
                'order_token' => $name
            );

            $this->db->transBegin();
            $orderId = $this->order_model->insertOrder($dataOrder);

            for ($i=0; $i < count($carts) ; $i++) { 
                $order_detail[$i] = array(
                    'order_id' =>$orderId,
                    'product_id' => (int)$carts[$i]['id'],
                    'order_detail_quantity' => (int)$carts[$i]['qty'],
                    'order_detail_price' => $carts[$i]['price']
                );
            } 

            // dd($order_detail);
            $this->order_detail_model->insertOrderDetail($order_detail);
            // dd($order_detail);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                session()->setFlashdata('errors', 'Orders failed');
            } else {
                // if(file_exists($this->request->getFile('order_token'))){
                //     // dd(ROOTPATH . 'public\uploads', $product['order_token']);
                //     $data['order_token'] = $name;
                //     if(file_exists('public/uploads/token/'. $order['order_token'])){
                //        unlink('public/uploads/token/'. $order['order_token']);
                //     }
                // }

                $image->move(ROOTPATH . 'public/uploads/token', $name);
                $this->db->transCommit();
                session()->setFlashdata('success', 'Order successfully');
                // return redirect()->to(base_url('/admin/category')); 
                $this->session->remove('cart');
                // echo view('ui/history');
                return redirect()->to(base_url('/market/history')); 
            }

        }

    }

    public function history()
    {
        $data['orders'] = $this->order_model->getOrderUser();

        // dd($data['orders']);
        // dd($this->order_detail_model->getOrderDetail($orders[1]['order_id']));
        return view('ui/history', $data);
    }

    public function historyDetail($id)
    {
        $data['order'] = $this->order_model->getOrder($id);

        // dd($data['order']);
        $data['order_details'] = $this->order_detail_model->getOrderDetail($id);
        $total = 0;
        foreach ($data['order_details'] as $index => $order_detail) {
            $total = $total +  ($order_detail['order_detail_price'] * $order_detail['order_detail_quantity']);
        }

        $data['delivery_cost'] = $data['order']['order_total'] - $total;

        return view('ui/history_detail', $data);
        // dd($data['order_details']);
    }

    public function upload_token($id)
    {
        $validation =  \Config\Services::validation();
        $order = $this->order_model->getOrder($id);


        $image = $this->request->getFile('order_token');
        $name = 'order'.$id.'.jpg';
        // dd($name);

        $data = array(
            'order_token' => $name,
            'order_pay_2' => $order['order_pay_2'] + $this->request->getPost('nominal')
        );

        if(file_exists($this->request->getFile('order_token'))){
            // dd(ROOTPATH . 'public\uploads', $product['order_token']);
            $data['order_token'] = $name;
            if(file_exists($_SERVER['DOCUMENT_ROOT']. '/uploads/token/' . $order['order_token'])){
                unlink($_SERVER['DOCUMENT_ROOT']. '/uploads/token/' . $order['order_token']);
            }
            // unlink('public/uploads/token/'. $order['order_token']);
        }

        if($validation->run($data, 'upload_token') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost('order_token'));
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('market/history'));
        } else {
            // upload
            $image->move(ROOTPATH . 'public/uploads/token', $name);
            // insert
            $simpan = $this->order_model->updateOrder($data, $id);
            if($simpan)
            {
                session()->setFlashdata('success', 'Bukti berhasil di unggah');
                return redirect()->to(base_url('market/history')); 
            }
        }

    }

    public function nota($id)
    {
        $data['order'] = $this->order_model->getOrder($id);

        // // dd($data['order']);
        $data['order_details'] = $this->order_detail_model->getOrderDetail($id);
        $total = 0;
        foreach ($data['order_details'] as $index => $order_detail) {
            $total = $total +  ($order_detail['order_detail_price'] * $order_detail['order_detail_quantity']);
        }

        $filename = date('y-m-d-H-i-s'). '-qadr-labs-report';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('ui/nota', $data ));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'paper');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename,array("Attachment"=>0));
    }
}
