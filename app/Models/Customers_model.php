<?php namespace App\Models;
use CodeIgniter\Model;
 
class Customers_model extends Model
{
    protected $table = 'customers';

    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function getCats($id = false)
    {
		return $this->findAll();
	}
	

	public function deleteData($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
	
	public function insertOrUpdate($id = null, $data = null)
	{

        unset($data["id"]);

        if(@$id){
            $query = $this->db->table($this->table)->update($data, array('id' => $id));
           
        }else{
            $query = $this->db->table($this->table)->insert($data);
        }
	
		return $query;
	}

    
}