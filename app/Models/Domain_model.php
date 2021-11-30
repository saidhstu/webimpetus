<?php namespace App\Models;
use CodeIgniter\Model;
 
class Domain_model extends Model
{
    protected $table = 'domains';
     
    public function getRows($id = false)
    {
        if($id === false){
			$this->join('services', 'domains.sid = services.id', 'LEFT');
			$this->select('services.name as sname');
			$this->select('domains.*');
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
}