<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tenant_model extends Model
{
    protected $table = 'tenants';
     
    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function getJoins()
    {
			$this->join('tenants_services', 'tenants_services.tid = tenants.id', 'LEFT');
			$this->join('services', 'tenants_services.sid = services.id', 'LEFT');
			$this->groupBy('tenants.id');
			$this->select('GROUP_CONCAT(services.name) as servicename');
			$this->select('tenants.*');
            return $this->findAll();         
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
	
	public function updateData($data = null, $id = null)
	{
		$query = $this->db->table($this->table)->update($data, array('id' => $id));
		return $query;
	}
	
	public function getLastInserted() {
		return $this->db->insertID();
	}
}