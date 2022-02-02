<?php namespace App\Models\Core;
use CodeIgniter\Model;
 
class Common_model extends Model
{
    protected $table = '';

    function __construct()
    {
        parent::__construct();
        $this->session = session();
        $this->table = $this->getTableNameFromUri();
    }


    public function getTableNameFromUri ()
    {
        $uri = service('uri');
        $tableNameFromUri = $uri->getSegment(1);
        return $tableNameFromUri;
    }
    

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
	

	public function deleteData($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
	
	public function insertOrUpdate($id = null, $data = null)
	{
        unset($data["id"]);

        if(@$id){
            $query = $this->db->table($this->table)->update($data, array('id' => $id));
            if( $query){
                session()->setFlashdata('message', 'Data updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
            }
        }else{
            $query = $this->db->table($this->table)->insert($data);
            if($query){
                session()->setFlashdata('message', 'Data updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
            }

        }
	
		return $query;
	}

    public function getAllDataFromTable($tableName)
    {
		$query = $this->db->table($tableName)->get()->getResultArray();
        return $query;
	}

    public function getUser($id = false)
    {
        $builder = $this->db->table("users");
        if($id === false){
            return $builder->where(['role!='=>1])->get()->getResultArray();
        }else{
            return $builder->getWhere(['id' => $id])->get()->getRowArray();
        }   
    }

    public function updateColumn($tableName , $id = null, $data = null){
        $query = $this->db->table($tableName, $this->table)->update($data, array('id' => $id));
        return $query;
    }

}