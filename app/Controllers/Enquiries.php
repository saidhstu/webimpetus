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
	function __construct()
    {
        parent::__construct();
		// $this->model = new Content_model();
		$this->content_model = new Content_model();
		$this->enquries_model = new Enquiries_model();
		$this->user_model = new Users_model();
		$this->cat_model = new Cat_model();
	}
    public function index()
    {        
        $data[$this->table] = $this->enquries_model->where(['type' => 1])->findAll();
		$data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;

        echo view($this->table."/list",$data);
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
		
		echo view($this->table."/edit", $data);
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
			$row = $this->model->getRows($id)->getRow();
			
			$filearr = ($row->custom_assets!="")?json_decode($row->custom_assets):[];
			$count = !empty($filearr)?count($filearr):0;
			if(!empty($_FILES['file'])) {	
				foreach($_FILES['file']['tmp_name'] as $key=>$v) {	
					if($_FILES['file']['tmp_name'][$key]){
						$imgData = base64_encode(file_get_contents($_FILES['file']['tmp_name'][$key]));
						$filearr[$count] = $imgData;
						$count++;
					}							
				}
				$data['custom_assets'] = json_encode($filearr);
				
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