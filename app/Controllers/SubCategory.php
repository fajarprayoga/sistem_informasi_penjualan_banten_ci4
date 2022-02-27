<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Category_model;
use App\Models\Sub_Category_Model;
 
class SubCategory extends Controller
{

    function __construct() {
        $this->db = db_connect();
    }

    public function sub_category($id)
    {
        $m_sub_category = new Sub_Category_Model();
        $data = $m_sub_category->where('sub_category_status', 'Inactive')->getSubCategory($id);
        return json_encode($data->getResultArray());
        // dd($data->getResultArray());
    }
}