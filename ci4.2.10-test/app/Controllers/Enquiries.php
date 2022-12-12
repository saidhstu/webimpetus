<?php namespace App\Controllers;
use App\Controllers\BaseController;
 
use CodeIgniter\Controller;
use App\Models\Enquiries_model;
use App\Models\Users_model;
use App\Models\Cat_model;
use App\Models\Content_model;
use App\Controllers\Core\CommonController; 

 
class Enquiries extends CommonController
{	
	protected $whereCond = array();
	function __construct()
    {
        parent::__construct();
		// $this->model = new Content_model();
		$this->content_model = new Content_model();
		$this->enquries_model = new Enquiries_model();
		$this->user_model = new Users_model();
		$this->cat_model = new Cat_model();
		$this->whereCond['uuid_business_id'] = $this->businessUuid;
	}
    public function index()
    {        
        $data[$this->table] = $this->enquries_model->where([ 'uuid_business_id' => $this->businessUuid])->findAll();
		$data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;

        return view($this->table."/list",$data);
    }

	
	
	public function edit($id = 0)
	{
		$data['tableName'] = $this->table;
		$data['rawTblName'] = $this->rawTblName;
		$data['content'] = $this->enquries_model->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
		$data['cats'] = $this->cat_model->getRows();
		
		$array1 = $this->cat_model->getCatIds($id);
		
		$arr = array_map (function($value){
			return $value['categoryid'];
		} , $array1);
		$data['selected_cats'] = $arr;
		
		return view($this->table."/edit", $data);
	}
	
}