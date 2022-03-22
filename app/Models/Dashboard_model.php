<?php namespace App\Models;
use CodeIgniter\Model;
 
class Dashboard_model extends Model
{
    protected $table = 'orders';

    // hitung total data pada transaction
    public function getCountTrx()
    {
        return $this->db->table("orders")->countAll();
    }

    // hitung total data pada category
    public function getCountCategory()
    {
        return $this->db->table("categories")->countAll();
    }

    // hitung total data pada product
    public function getCountProduct()
    {
        return $this->db->table("products")->countAll();
    }

    // hitung total data pada user
    public function getCountUser()
    {
        return $this->db->table("users")->countAll();
    }

    public function getStatusSuccess()
    {
        return $this->db->table("orders")->selectCount('order_status')->where('order_status', 'SUCCESS')->get()->getRow()->order_status;
    }
    public function getStatusPending()
    {
        return $this->db->table("orders")->selectCount('order_status')->where('order_status', 'PENDING')->get()->getRow()->order_status;
    }
    public function getStatusCancel()
    {
        return $this->db->table("orders")->selectCount('order_status')->where('order_status', 'CANCEL')->get()->getRow()->order_status;
    }

    public function getGrafik()
    {
        $query = $this->db->query("SELECT order_total, MONTHNAME(created_at) as month, COUNT(order_total) as total FROM orders GROUP BY MONTHNAME(created_at), order_id ORDER BY MONTH(created_at)");
        $hasil = [];
        // dd($query);
        if(!empty($query)){
            foreach($query->getResultArray() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
        return $hasil;
    }

    

    public function getLatestTrx()
    {
        return $this->table('orders')
            ->select('*, orders.created_at as created_at_order')
            // ->select('products.product_name, orders.*')
            ->join('users', 'users.id = orders.user_id')
            ->orderBy('orders.order_id', 'desc')
            ->limit(5)
            ->get()
            ->getResultArray();
    }
}