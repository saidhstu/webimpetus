<?php namespace App\Models;
use CodeIgniter\Model;
 
class Cat_model extends Model
{
    protected $table = 'categories';
	protected $table2 = 'content_category';
     
    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function getCats($id = false)
    {
		return $this->findAll();
	}
	
	public function deleteCatData($id)
    {
        $query = $this->db->table($this->table2)->delete(array('contentid' => $id));
        return $query;
    }
	
	public function getCatIds($id)
    {        
        return $this->db->table($this->table2)->where(['contentid' => $id])->get()->getResult('array');
    }
	
	public function saveData2($data)
    {
        $query = $this->db->table($this->table2)->insert($data);
        return $query;
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