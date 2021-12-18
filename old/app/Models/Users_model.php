<?php namespace App\Models;
use CodeIgniter\Model;
 
class Users_model extends Model
{
    protected $table = 'users';
     
    public function getUser($id = false)
    {
        if($id === false){
            return $this->where(['role!='=>1])->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function countEmail($email = ''){
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where(['email' => $email]);
		return $num_results = $this->db->count_all_results();
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