<?php namespace App\Controllers;
use App\Controllers\BaseController;
 
use CodeIgniter\Controller;
use App\Models\Secret_model;
use App\Models\Service_model;
use App\Controllers\Core\CommonController;
use App\Libraries\UUID;
use App\Models\Core\Common_model;
 
class Businesses extends CommonController
{	
	public function __construct()
	{
		parent::__construct(); 

		$this->secretModel = new Secret_model();
		$this->service_model = new Service_model();
		$this->model = new Common_model();
	}

   
	public function index()
    {        

		$data['columns'] = $this->db->getFieldNames($this->table);
		$data['fields'] = array_diff($data['columns'], $this->notAllowedFields);
        $data[$this->table] = getWithOutUuidResultArray("businesses");
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;
        $data['identifierKey'] = 'id';

		$viewPath = "common/list";
		if (file_exists( APPPATH . 'Views/' . $this->table."/list.php")) {
			$viewPath = $this->table."/list";
		}

        return view($viewPath, $data);
    }
	
    public function update()
    {        
        $id = $this->request->getPost('id');

		$data = $this->request->getPost();
		if(isset($data['default_business'])){
			$data['default_business'] = 1;
		}
		if($id < 1){

			$uuidNamespace = UUID::v4();
			$data['uuid'] = UUID::v5($uuidNamespace, 'businesses');
		}
		$response = $this->model->insertOrUpdate($id, $data);
		if(!$response){
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');	
		}

        return redirect()->to('/'.$this->table);
    }
	

}