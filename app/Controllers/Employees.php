<?php 
namespace App\Controllers; 
use App\Controllers\Core\CommonController; 
use App\Models\Users_model;
use App\Models\Core\Common_model;
 
class Employees extends CommonController
{	
	
    function __construct()
    {
        parent::__construct();

	}
    
    public function getAdditionalData($id)
    {
        $model = new Common_model();
        $data["customers"] = $model->getAllDataFromTable("customers");

        return  $data;

    }

    public function update()
    {        
        $id = $this->request->getPost('id');

		$data = $this->request->getPost();

        if(strlen($data['password']) > 0){
            $data['password'] = md5($data['password']);
        }
        $data['businesses'] = json_encode(@$data['businesses']);
		$response = $this->model->insertOrUpdate($id, $data);
		if(!$response){
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');	
		}

        return redirect()->to('/'.$this->table);
    }
}