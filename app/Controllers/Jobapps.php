<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
 
use CodeIgniter\Controller;
use App\Models\Enquiries_model;
use App\Models\Users_model;
use App\Controllers\Core\CommonController; 
ini_set('display_errors', 1);
class Jobapps extends CommonController
{	
	public function __construct()
	{
		parent::__construct();
		$this->model = new Enquiries_model();
		$this->user_model = new Users_model();
	}
    public function index()
    {        
        $data['content'] = $this->model->where(['type' => 2, "uuid_business_id" => $this->businessUuid])->findAll();
        $data['tableName'] = $this->table;
		$data['rawTblName'] = $this->rawTblName;
		$data['is_add_permission'] = 0;
		echo view($this->table."/list", $data);
    }
	
	
}