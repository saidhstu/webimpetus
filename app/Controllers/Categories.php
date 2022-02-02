<?php namespace App\Controllers;

use App\Models\Cat_model;
use App\Models\Users_model;
use App\Controllers\Core\CommonController; 

class Categories extends CommonController
{	
	function __construct()
	{
		parent::__construct();
		$this->session = \Config\Services::session();
		$this->catModel = new Cat_model();
		$this->user_model = new Users_model();
		$this->rawTblName =  "category"; 
	}


	public function deleteImage($id)
    {
		if(!empty($id)){
			$data['image_logo'] = null;

			$response = $this->model->updateColumn("categories", $id, $data);
			if($response){
				session()->setFlashdata('message', 'Image deleted Successfully!');
				session()->setFlashdata('alert-class', 'alert-success');	
			
			}else{
				session()->setFlashdata('message', 'Something wrong!');
				session()->setFlashdata('alert-class', 'alert-danger');		
			}
			
		}
		return redirect()->to('/categories/edit/'.$id);
		
	}
	
    public function update()
    {        
        $id = $this->request->getPost('id');
		$data = array(
			'name'  => $this->request->getPost('name'),				
			'notes' => $this->request->getPost('notes'),
			'uuid' => $this->request->getPost('uuid')
		);
		
		if($_FILES['file']['tmp_name']) {											
			$imgData = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
			$imageProperties = getimageSize($_FILES['file']['tmp_name']);
	
			$data['image_logo'] = $imgData;
			}

			$response = $this->model->insertOrUpdate($id, $data);
			if(!$response){
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');		
			}


		return redirect()->to('/'.$this->table);

    }
	
	public function status()
    {  
		if(!empty($id = $this->request->getPost('id'))){
			$data = array(            
				'status' => $this->request->getPost('status')
			);
			$this->model->updateUser($data, $id);
		}
		echo '1';
	}
	

}