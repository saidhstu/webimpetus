<?php namespace App\Controllers;
use App\Controllers\BaseController;
 
use CodeIgniter\Controller;
use App\Controllers\Core\CommonController;
use App\Libraries\UUID;
use App\Models\Core\Common_model;
 
class Businesses extends CommonController
{	
	public function __construct()
	{
		parent::__construct(); 

	}

   
	public function index()
    {        

		$data['columns'] = $this->db->getFieldNames($this->table);
		$data['fields'] = array_diff($data['columns'], $this->notAllowedFields);
        $data[$this->table] = getWithOutUuidResultArray("businesses");
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
		if(@$_SESSION['role'] > 0){

			$data['is_add_permission'] = 1;
		}else{
			$data['is_add_permission'] = 0;
		}
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
		$data['business_contacts'] = json_encode(@$data['business_contacts']);
		if($id < 1){

			$uuidNamespace = UUID::v4();
			$data['uuid'] = UUID::v5($uuidNamespace, 'businesses');
		}
		// prd($data);
		$response = $this->model->insertOrUpdate($id, $data);
		if(!$response){
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');	
		}

        return redirect()->to('/'.$this->table);
    }

	public function edit($id = 0)
    {
		$data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
		$data["users"] = $this->model->getUser();
		$data[$this->rawTblName] = getRowArray($this->table, ['id' => $id]);
		// if there any special cause we can overried this function and pass data to add or edit view
		$data['additional_data'] = $this->getAdditionalData($id);

        echo view($this->table."/edit",$data);
    }
	

}