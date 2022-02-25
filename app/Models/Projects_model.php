<?php 

namespace App\Models;
use CodeIgniter\Model;
 
class Projects_model extends Model
{
    protected $table = 'projects';
     
    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function getProjectList()
    {
        $builder = $this->db->table($this->table);
        $builder->select($this->table.".*, customers.company_name");
        $builder->join('customers', 'customers.id = '.$this->table.'.customers_id', 'left');
        return $builder->get()->getResultArray();
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