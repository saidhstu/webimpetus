<?php namespace App\Models;
use CodeIgniter\Model;
 
class Meta_model extends Model
{
    protected $table = 'meta_fields';
     
    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['meta_key' => $id]);
        }   
    }

	public function getRowsByCode($code = '')
    {
        if($code === ''){
            return false;
        }else{
            return $this->select('*')->where(['code'=>$code])->findAll();
        } 

        //$query = $this->db->query("SELECT * FROM webimpetusci4test.meta_fields WHERE code = 'service_default_secret'");
        //return $query;
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
	
	public function updateMeta($field = null, $data = [])
	{
		//echo '<pre>';print_r($data); die;
		if(!is_null($field) && !empty($data)){			
			$count = $this->db->table($this->table)->getWhere(['meta_key' => $field])->getNumRows();
			if(empty($count)){
				$data['meta_key'] = $field;
				$query = $this->db->table($this->table)->insert($data);
				return $query;
			}else {
				$query = $this->db->table($this->table)->update($data, array('meta_key' => $field));
				return $query;
			}
		}else return;
	}

    public function getAllBusiness()
    {
        return $this->db->table("businesses")->get()->getResult();
    }
    public function getBusinessRow($id)
    {
        $data = $this->db->table("businesses")->getWhere(['id' => $id])->getRow();
        if (empty($data)) {
            $data = $this->db->table("businesses")->getWhere(['default_business' => 1])->getRow();
        }

        return $data;
    }
	
	
}