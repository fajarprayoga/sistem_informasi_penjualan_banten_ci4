<?php namespace App\Models;
use CodeIgniter\Model;
 
class Sub_Category_Model extends Model
{
    protected $table = 'sub_categories';
    protected $primaryKey = 'sub_category_id';

    public function getSubCategory($categoryId)
    {
        // if($id === false){
        //     return $this->findAll();
        // } else {
            return $this->getWhere(['category_id' => $categoryId]);
        // }  
        
    }
 
    public function insertSubCategory($data)
    {
        return $this->db->table($this->table)->insertBatch($data);
    }

    public function updateSubCategory($data, $id)
    {
        return $this->db->table($this->table)->updateBatch($data);
        // $this->db->table($this->table)->save($data);
    }

    public function deleteSubCategory($id)
    {
        return $this->db->table($this->table)->delete(['sub_category_id' => $id]);
    } 
}