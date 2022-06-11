<?php 

namespace App\Models;
use CodeIgniter\Model;
 
class Tasks_model extends Model
{
    protected $table = 'tasks';
     
    protected $businessUuid;
	private $whereCond = array();

    public function __construct()
    {
        parent::__construct();
		
        $this->businessUuid = session('uuid_business');
		$this->whereCond['uuid_business_id'] = $this->businessUuid;
    }
    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function getTaskList()
    {
        $builder = $this->db->table($this->table);
        $builder->select($this->table.".*, customers.company_name, projects.name as project_name");
        $builder->join('customers', 'customers.id = '.$this->table.'.reported_by', 'left');
        $builder->join('projects', 'projects.id = '.$this->table.'.projects_id', 'left');
        $builder->where($this->table.".uuid_business_id",  $this->businessUuid);
        return $builder->get()->getResultArray();
    }
	
}