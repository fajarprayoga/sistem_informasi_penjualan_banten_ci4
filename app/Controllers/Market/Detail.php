<?php namespace App\Controllers\Market;
use App\Controllers\BaseController;
use App\Models\Product_model;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class Detail extends BaseController
{
	public function __construct()
    {
        $this->product_model = new Product_model();
		$this->session = session();
	}

	public function index($id)
	{
	
		$data['product'] = $this->product_model->getProduct($id);
		if($this->session->has('cart') && $this->session->get('cart')){
            $cart_session = $this->session->get('cart');
			// $result = $this->search($cart_session, 'id',$id);
            foreach ($cart_session as $index => $value) {
                if($id == $value['id']){
                    $result = $value;
                    break;
                }else{
                    $result = false;
                }
            }
			if($result){
				$data['cart'] = $result;
			}else{
				$data['cart'] = null;
			}
		}else{
			$data['cart'] = null;
		}
		return view('ui/detail', $data);
        // dd($cart_session);
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
        return $result[0];
    }
}
