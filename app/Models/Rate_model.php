<?php namespace App\Models;
use CodeIgniter\Model;
use ValueError;

class Rate_model extends Model
{
    protected $table = 'rates';

    public function getRate()
    {
        return $this->table('rates')
                    ->join('users', 'users.id = rates.user_id')
                    ->orderBy('rate_date', 'desc')
                    ->get()
                    ->getResultArray();
    }
    public function insertRate($data, $userId)
    {
        $rate = $this->db->table($this->table)->where('rates.user_id', $userId)->get()->getRowArray();
        if($rate){
            return $this->db->table($this->table)->update($data, ['user_id' => $userId]);
        }else{

            return $this->db->table($this->table)->insert($data);
        }
    }
}