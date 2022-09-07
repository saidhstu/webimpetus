<?php namespace App\Models;
use CodeIgniter\Model;
use Exception;

class User_business_model extends Model
{
    protected $table = 'user_business';
    private $whereCond = array();

    public function __construct()
    {
        parent::__construct();

    }
     
    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
    public function insertOrUpdate($id = null, $data = null)
	{
        unset($data["id"]);

        if(@$id){
            $query = $this->db->table($this->table)->update($data, array('id' => $id));
            if( $query){
                session()->setFlashdata('message', 'Data updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $id;
            }
        }else{
            $query = $this->db->table($this->table)->insert($data);
            if($query){
                session()->setFlashdata('message', 'Data updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->db->insertID();
            }

        }
	
		return false;
	}


	public function saveUserbusines($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
	
	public function deleteBusiness($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
	
	public function updateBusiness($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id' => $id));
		return $query;
	}

    public function getResult($id = false)
    {
        $query = $this->db->table($this->table)->where('id', $id)->get()->getResultObject();
		return $query;
    }

}