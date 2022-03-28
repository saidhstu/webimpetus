<?php 

namespace App\Models;
use CodeIgniter\Model;
 
class Purchase_orders_model extends Model
{
    protected $purchase_orders = 'purchase_orders';
     
    protected $businessUuid;
     
    public function __construct()
    {
        parent::__construct();
        $this->businessUuid = session('uuid_business');
    }

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
        $builder = $this->db->table($this->purchase_orders. " as sa");
        $builder->select("sa.*, customers.company_name");
        $builder->join('customers', 'customers.id = sa.client_id', 'left');
        $builder->where('sa.uuid_business_id', session("uuid_business"));
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