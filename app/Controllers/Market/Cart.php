<?php 

namespace App\Controllers\Market;
use App\Controllers\BaseController;
use App\Models\Product_model;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class Cart extends BaseController
{
	public function __construct()
    {
        // $session = \Config\Services::session();
        $this->session = session();
        $this->product_model = new Product_model();
	}

    public function index()
    {
        // $session = session();
        // dd($this->session->get('cart'));
        if($this->session->has('cart')){
            $total = 0;
            $data['carts'] = $this->session->get('cart');
            // $data['carts'] = $this->product_model->getProduct($data['carts']['id']));
            // $data['total'] = array_sum(array_column($data['carts'], 'price'));
            foreach ($data['carts'] as $index => $cart) {
                $total = $total + ($cart['qty'] * $cart['price']);
            }
            $data['total']= $total;
		}else{
			$data['carts'] = null;
            $data['total'] = 0;
		}
        // $total = array_sum(array_column($data['carts'], 'price')); 
        return view('ui/cart', $data);
        // dd($total);
    }

	public function add()
	{
        if($this->session->has('login')){
            $req = $this->request->getPost('cart');

            $product = $this->product_model->getProduct($req['id']); 

            if($this->session->has('cart')){
                $cart_session = $this->session->get('cart');
                $result = false;
                // $result = $this->search($cart_session, 'id', $product['product_id']);

                foreach ($cart_session as $index => $cart) {
                    if($cart['id'] == $product['product_id']){
                        $result = true;
                        break;
                    }
                }
                    
                if(!$result){
                    $this->session->push('cart', [
                        [
                            'id' => $product['product_id'],
                            'name' => $product['product_name'],
                            'qty' => $req['qty'],
                            'price' =>$product['product_price'],
                            'image' => $product['product_image']
                        ],
                    ]);
                    return 'Produk di tambahkan ke keranjang';
                }else{
                    return 'Produk sudah ada di keranjang';
                }
            }else{
                $carts['cart'] = [
                    [
                        'id' => $product['product_id'],
                        'name' => $product['product_name'],
                        'qty' => $req['qty'],
                        'price' =>$product['product_price'],
                        'image' => $product['product_image']
                    ],
                ];

                $this->session->set($carts);
                return 'Produk di tambahkan ke keranjang';
            }
        }else{
            return 'Mohon login terlebih dahulu';
        }
	}

    public function edit()
    {
        $req = $this->request->getPost('cart');
        // $product = $this->product_model->getProduct($req['id']); 
        $carts = $this->session->get('cart');

        foreach($carts as $index => $cart){
            if($cart['id'] == $req['id']){
                $cart['qty'] = $req['qty'];
                $carts[$index] = $cart;
                break;
            }
        }
        
        $this->session->set('cart',$carts);
        return 'success';
        
    }

    public function destroy()
    {
        // $this->session->destroy();
        $this->session->remove('cart');
    }

    public function destroyById()
    {
        $id = $this->request->getPost('id');
        $cart_session = $this->session->get('cart');
        foreach ($cart_session as $index => $cart) {
            if($cart['id'] == $id){
                unset($cart_session[$index]);
                break;
            }
        }
        $this->session->remove('cart');
        $this->session->set('cart',$cart_session);
        return 'Deleted success';
    }


    function search($array, $key, $value) {
   
        // RecursiveArrayIterator to traverse an
        // unknown amount of sub arrays within
        // the outer array.
        $arrIt = new RecursiveArrayIterator($array);
       
        // RecursiveIteratorIterator used to iterate
        // through recursive iterators
        $it = new RecursiveIteratorIterator($arrIt);
       
        foreach ($it as $sub) {
       
            // Current active sub iterator
            $subArray = $it->getSubIterator();
       
            if ($subArray[$key] === $value) {
                $result[] = iterator_to_array($subArray);
            }else{
                $result = false;
            }
        }
        return $result;
    }
}
