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
    public function getRateUi()
    {
        return $this->table('rates')
                    ->where('rates.rate_status', 1)
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

    public function updateRate($data, $id)
    {
        // dd($id);
        return $this->db->table($this->table)->update($data, ['rate_id' => $id]);

    }
}