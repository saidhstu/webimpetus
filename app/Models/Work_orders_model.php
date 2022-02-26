<?php 

namespace App\Models;
use CodeIgniter\Model;
 
class Work_orders_model extends Model
{
    protected $work_orders = 'work_orders';
     
    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function getOrder()
    {
        $builder = $this->db->table($this->work_orders. " as sa");
        $builder->select("sa.*, customers.company_name");
        $builder->join('customers', 'customers.id = sa.client_id', 'left');
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