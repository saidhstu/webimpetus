<?php namespace App\Models;
use CodeIgniter\Model;
 
class Tenant_service_model extends Model
{
    protected $table = 'tenants_services';
     
    public function getRows($id = false, $st =1)
    {
        if($st === 1){
            return $this->select('sid')->where(['tid'=>$id])->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function saveData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
	
	public function deleteData($id)
    {
        $query = $this->db->table($this->table)->delete(array('tid' => $id));
        return $query;
    }
	
	public function updateData($data = null, $id = null)
	{
		$query = $this->db->table($this->table)->update($data, array('id' => $id));
		return $query;
	}
}