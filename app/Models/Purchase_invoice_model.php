<?php 

namespace App\Models;
use CodeIgniter\Model;
 
class Purchase_invoice_model extends Model
{
    protected $purchase_invoices = 'purchase_invoices';
     
    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function getInvoice()
    {
        $builder = $this->db->table($this->purchase_invoices. " as sa");
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
	public function insertData( $data = null)
	{
       
		$query = $this->db->table($this->purchase_invoices)->insert($data);
		return  $this->db->insertID();
	}
}