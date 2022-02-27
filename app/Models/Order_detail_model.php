<?php namespace App\Models;
use CodeIgniter\Model;
 
class Order_detail_model extends Model
{
    protected $table = 'order_details';
     

    public function getOrderDetail($order_id)
    {
        return $this->join('products', 'products.product_id = order_details.product_id')
        ->getWhere(['order_id' => $order_id])
        ->getResultArray();
    }

    public function insertOrderDetail($data)
    {
        return $this->db->table($this->table)->insertBatch($data);
    }
}