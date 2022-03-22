<?php namespace App\Controllers\Market;
use App\Controllers\BaseController;
use App\Models\Category_model;
use App\Models\Product_model;
class Shop extends BaseController
{
	public function __construct()
    {
        $this->product_model = new Product_model();
		$this->category_model = new Category_model();
	}

	public function index()
	{

		$search = '';
		if(!empty($this->request->getGet('search'))){
			$search = $this->request->getGet('search');
		}
		// $products = $this->product_model->join('categories', 'categories.category_id = products.category_id')->join('sub_categories', 'sub_categories.sub_category_id = products.sub_category_id')->paginate(6, 'jq');
		$products= $this->product_model->where('product_status', 'Active')->like('product_name', $search)->join('categories', 'categories.category_id = products.category_id')->where('categories.category_status', 'Active')->paginate(6, 'jq');

		$category = $this->request->getGet('category');
		if($category){
			$products =  $this->product_model->where('product_status', 'Active')->like('product_name', $search)->where('categories.category_id', $category)->join('categories', 'categories.category_id = products.category_id')->where('category_status', 'Active')->paginate(6, 'jq');
		}

		$data = [
			'products' => $products ,
			'pager' => $this->product_model->pager,
			'categories' => $this->category_model->where('category_status', 'Active')->get()->getResultArray()
		];

		// App/Views/..../..../
		return view('ui/shop', $data);
	}
}
