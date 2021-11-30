<?php namespace App\Models;
use CodeIgniter\Model;
 
class Service_model extends Model
{
    protected $table = 'services';
     
    public function getRows($id = false)
    {
        if($id === false){
			$this->join('categories', 'services.cid = categories.id', 'LEFT');
			$this->join('tenants', 'services.tid = tenants.id', 'LEFT');
			$this->select('categories.name as category');			
			$this->select('tenants.name as tenant');
			$this->select('services.*');
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function getApiRows($id = false)
    {
        if($id === false){
			$this->join('categories', 'services.cid = categories.id', 'LEFT');
			$this->join('tenants', 'services.tid = tenants.id', 'LEFT');
			$this->select('categories.name as category');			
			$this->select('tenants.name as tenant');
			$this->select('services.*');
            return $this->where('status', 1)->findAll();
        }else{
            return $this->getWhere(['id' => $id,'status'=>1]);
        }   
    }
	
	public function saveData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
	
	public function deleteData($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
	
	public function updateData($id = null, $data = null)
	{
		$query = $this->db->table($this->table)->update($data, array('id' => $id));
		return $query;
	}
}