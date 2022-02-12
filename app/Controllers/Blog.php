<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Content_model;
use App\Models\Users_model;
use App\Models\Enquiries_model;
use App\Models\Cat_model;
use App\Controllers\Core\CommonController; 
use App\Models\Amazon_s3_model; 
ini_set('display_errors', 1);
class Blog extends CommonController
{	
	public function __construct()
	{
		parent::__construct();
		$this->content_model = new Content_model();		
		$this->emodel = new Enquiries_model();
		$this->user_model = new Users_model();
		$this->cat_model = new Cat_model();
	}
	public function index()
	{        
		$data['content'] = $this->content_model->where(['type' => 2])->findAll();
		$data['tableName'] = $this->table;
		$data['rawTblName'] = $this->rawTblName;
		$data['menucode'] = 8;
		echo view($this->table."/list", $data);
	}
	
	public function blogcomments()
	{
		$data['tableName'] = $this->table;
		$data['rawTblName'] = $this->rawTblName;
		$data['content'] = $this->emodel->where(['type' => 3])->findAll();
		echo view($this->table."/comments", $data);
	}
	

	
	public function edit($id = 0)
	{
		$data['menucode'] = 8;
		$data['tableName'] = $this->table;
		$data['rawTblName'] = $this->rawTblName;
		$data['content'] = $this->content_model->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
		$data['cats'] = $this->cat_model->getRows();
		$data['images'] = $this->model->getDataWhere("blog_images", $id, "blog_id");
		
		$array1 = $this->cat_model->getCatIds($id);
		
		$arr = array_map (function($value){
			return $value['categoryid'];
		} , $array1);
		$data['selected_cats'] = $arr;
		
		echo view($this->table."/edit", $data);
	}
	
	public function rmimg($id, $blogId)
	{
		if(!empty($id)){

			$this->model->deleteTableData("blog_images", $id);
			session()->setFlashdata('message', 'Image deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
			
		}
		return redirect()->to('//blog/edit/'.$blogId);
		
	}
	
	public function update()
	{     
		 
		$id = $this->request->getPost('id');

		$data = array(
			'title'  => $this->request->getPost('title'),				
			'sub_title' => $this->request->getPost('sub_title'),
			'content' => $this->request->getPost('content'),
			'code' => $this->request->getPost('code')?$this->content_model->format_uri($this->request->getPost('code'),'-',@$id):$this->content_model->format_uri($this->request->getPost('title'),'-',@$id),
			'meta_keywords' => $this->request->getPost('meta_keywords'),
			'meta_title' => $this->request->getPost('meta_title'),
			'meta_description' => $this->request->getPost('meta_description'),
			'status' => $this->request->getPost('status'),
			'publish_date' => ($this->request->getPost('publish_date')?strtotime($this->request->getPost('publish_date')):strtotime(date('Y-m-d H:i:s'))),
			'type' => ($this->request->getPost('type')?$this->request->getPost('type'):1),
					//'image_logo' => $filepath
		);
		if(!empty($this->request->getPost('uuid'))){
			$data['uuid'] = $this->request->getPost('uuid');
		}
		
		

		
		if(!empty($id)){
			$row = $this->content_model->getRows($id)->getRow();
			
			$filearr = ($row->custom_assets!="")?json_decode($row->custom_assets):[];
			$count = !empty($filearr)?count($filearr):0;
			
			if(!empty($_FILES['file'])) {	
				foreach($_FILES['file']['tmp_name'] as $key=>$v) {	
					if($_FILES['file']['tmp_name'][$key]){

						
						// $imgData = base64_encode(file_get_contents($_FILES['file']['tmp_name'][$key]));
						// $filearr[$count] = $imgData;
						// $count++;
						$response = $this->Amazon_s3_model->doUploadMultiple("file", "blog-images", $_FILES['file']['tmp_name'][$key], $_FILES['file']['name'][$key]);	

						$blog_images['image'] = $response["filePath"];				
						$blog_images['blog_id'] = $id;
						pre($response);
						$this->content_model->saveDataInTable($blog_images, "blog_images"); 
					}							
				}
				
			}

			$this->content_model->updateData($id, $data);
			
			if(!empty($id) && !empty($this->request->getPost('catid'))){
				$this->cat_model->deleteCatData($id);		
				foreach($this->request->getPost('catid') as $val) {
					$cat_data = [];
					$cat_data['categoryid'] = $val;
					$cat_data['contentid'] = $id;
					$this->cat_model->saveData2($cat_data);					
				}			
				
			}
			
			session()->setFlashdata('message', 'Data updated Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}else {

			if(!empty($this->request->getPost('title'))){
				
				if($this->request->getPost('title')) {
					
					// Set Session
					session()->setFlashdata('message', 'Data entered Successfully!');
					session()->setFlashdata('alert-class', 'alert-success');
					
					
					$bid = $this->content_model->saveData($data); 
					
					if($bid){
						$filearr = [];
					
						if(!empty($_FILES['file'])) {	
							foreach($_FILES['file']['tmp_name'] as $key=>$v) {	
								if($_FILES['file']['tmp_name'][$key]){

									$response = $this->Amazon_s3_model->doUploadMultiple("file", "blog-images", $_FILES['file']['tmp_name'][$key], $_FILES['file']['name'][$key]);	

									$blog_images['image'] = $response["filePath"];				
									$blog_images['blog_id'] = $bid;
									pre($response);
									$this->content_model->saveDataInTable($blog_images, "blog_images"); 			
								}							
							}
							
							
						}
					}
					if(!empty($bid) && !empty($this->request->getPost('catid'))){
						
						foreach($this->request->getPost('catid') as $val) {
							$cat_data = [];
							$cat_data['categoryid'] = $val;
							$cat_data['contentid'] = $bid;
							$this->cat_model->saveData2($cat_data);
							
						}
					}
					
				}else{
					   // Set Session
					session()->setFlashdata('message', 'File not uploaded.');
					session()->setFlashdata('alert-class', 'alert-danger');
				}
			}
		}
		return redirect()->to('/'.$this->table);
	}
	

}