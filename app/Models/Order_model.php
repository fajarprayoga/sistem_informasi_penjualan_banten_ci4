<?php namespace App\Models;
use CodeIgniter\Model;
 
class Order_model extends Model
{
    protected $table = 'orders';
     

    public function getOrder($id = false)
    {
        if($id === false){
            return $this->table('orders')
                ->orderBy('orders.order_id','desc')
                ->join('users', 'users.id = orders.user_id')
                // ->join('order_details', 'order_details.order_id = orders.order_id')
                ->get()
                ->getResultArray();
        } else {
            return $this->getWhere(['order_id' => $id])->getRowArray();
        }  
    }

    public function getOrderUser()
    {
        return $this->orderBy('order_id','desc')->getWhere(['user_id' => session()->get('id')])->getResultArray();
        // return session()->get('id');
    }

    public function insertOrder($data)
    {
         $this->db->table($this->table)->insert($data);
         return $this->db->insertID();
    }


    public function updateOrder($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['order_id' => $id]);
    }

    public function lastId()
    {
        $query = $this->db->query('SELECT order_id FROM orders ORDER BY order_id DESC');
        $row   = $query->getRowArray();
        return $row['order_id'];
    }
}