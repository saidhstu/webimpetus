<?php namespace App\Models;
use CodeIgniter\Model;
use Exception;

class Users_model extends Model
{
    protected $table = 'users';
    private $whereCond = array();

    public function __construct()
    {
        parent::__construct();
        if ($this->db->fieldExists('uuid_business_id', $this->table)) {

            $this->whereCond['uuid_business_id'] = session('uuid_business');
        }
    }
     
    public function getUser($id = false)
    {
        $whereCond = $this->whereCond;
        if($id === false){

            $whereCond = array_merge(['role!='=>1], $whereCond);
            return $this->where($whereCond)->findAll();
        }else{

            $whereCond = array_merge(['id' => $id], $whereCond);
            return $this->getWhere($whereCond);
        }   
    }
	
	public function countEmail($email = ''){
        $whereCond = $whereCond = array_merge(['email' => $email], $this->whereCond);
		return $this->db->table($this->table)->select('id')->where($whereCond)->countAllResults();
	}
	
	public function saveUser($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
	
	public function deleteUser($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
	
	public function updateUser($data, $id)
	{
		$query = $this->db->table($this->table)->update($data, array('id' => $id));
		return $query;
	}
	
	public function findUserByEmailAddress(string $emailAddress)
    {
        $user = $this
            ->asArray()
            ->where(['email' => $emailAddress])
            ->first();

        if (!$user) 
            throw new Exception('User does not exist for specified email address');

        return $user;
    }
}