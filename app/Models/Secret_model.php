<?php namespace App\Models;
use CodeIgniter\Model;
 
class Secret_model extends Model
{
    protected $table = 'secrets';
	protected $table2 = 'secrets_services';
     
    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
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
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
	
	public function updateData($id = null, $data = null)
	{
		$query = $this->db->table($this->table)->update($data, array('id' => $id));
		return $query;
	}
	
	public function getSecret($code=""){
		return !empty($this->select('key_value')->getWhere(['key_name' => $code])->getRow())?$this->select('key_value')->getWhere(['key_name' => $code])->getRow()->text:'';
	}
	
	public function getLastInserted() {
		return $this->db->insertID();
	}
	
	public function serviceData($data)
    {
        $query = $this->db->table($this->table2)->insert($data);
        return $query;
    }
	
	public function getServices($id)
    {        
        return $this->db->table($this->table2)->where(['secret_id' => $id])->get()->getResult('array');
    }
	
	public function deleteService($id)
    {
        $query = $this->db->table($this->table2)->delete(array('secret_id' => $id));
        return $query;
    }
}