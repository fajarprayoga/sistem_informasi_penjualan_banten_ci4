<?php namespace App\Models;
use CodeIgniter\Model;
use ValueError;

class User_model extends Model
{
    protected $table = 'users';

    public function getUser($key = false, $value = false)
    {
        if($key === false){
            return $this->findAll();
        } else {
            if($value == false){
                return $this->getWhere(['id' => $value])->getFirstRow('array');
            }else{
                return $this->getWhere([$key => $value])->getFirstRow('array');
            }
        }  
    }

    public function updateProduct($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }

    public function activate($data, $id){
		$this->db->table($this->table)->where('users.id', $id);
		return $this->db->table($this->table)->update($data, ['id' => $id]);
	}
}