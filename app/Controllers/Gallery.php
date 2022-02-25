<?php 
namespace App\Controllers;

use App\Models\Gallery_model;
use App\Models\Users_model;
use App\Controllers\Core\CommonController; 
ini_set('display_errors', 1);

class Gallery extends CommonController
{	
	public function __construct()
	{
		parent::__construct();
		$this->gallery_model = new Gallery_model();
		$this->user_model = new Users_model();
		$this->table = 'media_list';
		$this->gallery = 'gallery';
	}

	public function index()
	{        

		$data[$this->table] = $this->gallery_model->where([ "uuid_business_id" => $this->businessUuid])->findAll();
		$data['tableName'] = $this->gallery;
		$data['rawTblName'] = "Image";
		$data['is_add_permission'] = 1;

		echo view($this->table."/list",$data);
	}

	public function edit($id = 0)
	{
		$data['rawTblName'] = "Image";
		$data['tableName'] = $this->gallery;
		$data[$this->table] = $this->gallery_model->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
		echo view($this->table.'/edit',$data);
	}

	
	public function update()
	{     
		$data = array(
			'code' => $this->request->getPost('code'),
			'status' => $this->request->getPost('status'),
			"uuid_business_id" => $this->businessUuid,
		);

		$id = $this->request->getPost('id');

		if( $id > 0 ){
			
			if($_FILES['file']['tmp_name']) {	

				$response = $this->Amazon_s3_model->doUpload("file", "category-file");						
				$data['name'] = $response["filePath"];
			}
			$this->gallery_model->updateData($id, $data);
			
			session()->setFlashdata('message', 'Data updated Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');

		}else {

			if($_FILES['file']['tmp_name']) {	

				$response = $this->Amazon_s3_model->doUpload("file", "category-file");						
				$data['name'] = $response["filePath"];
			}

			if($file = $this->request->getFile('file')) {
				
				session()->setFlashdata('message', 'Data entered Successfully!');
				session()->setFlashdata('alert-class', 'alert-success');

				$this->gallery_model->saveData($data);

			}else{

				session()->setFlashdata('message', 'File not uploaded.');
				session()->setFlashdata('alert-class', 'alert-danger');
			}			   
		}
		return redirect()->to('/'.$this->gallery);
	}
	
	
	public function delete($id)
	{       
		
		if(!empty($id)) {
			$this->gallery_model->deleteData($id);		
			session()->setFlashdata('message', 'Data deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}
		
		return redirect()->to('/'.$this->gallery);
	}
	
	
}