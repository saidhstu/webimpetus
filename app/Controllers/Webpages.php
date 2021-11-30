<?php namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\Content_model;
use App\Models\Users_model;
 
class Webpages extends Controller
{	
	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->model = new Content_model();
		$this->user_model = new Users_model();
	}
    public function index()
    {        
        $data['webpages'] = $this->model->where(['type' => 1])->findAll();
        echo view('webpages',$data);
    }
	
	public function add()
    {
		$data['users'] = $this->user_model->getUser();
        echo view('add_webpage',$data);
    }
 
    public function save()
    {		      
		if(!empty($this->request->getPost('title'))){
			
			//echo '<pre>';print_r($_FILES['file']); die;
			 if($this->request->getPost('title')) {
				
				   // Set Session
				   session()->setFlashdata('message', 'Data entered Successfully!');
				   session()->setFlashdata('alert-class', 'alert-success');
				   
				   $data = array(
						'title'  => $this->request->getPost('title'),				
						'sub_title' => $this->request->getPost('sub_title'),
						'content' => $this->request->getPost('content'),
						'code' => $this->request->getPost('code')?$this->model->format_uri($this->request->getPost('code')):$this->model->format_uri($this->request->getPost('title')),
						'meta_keywords' => $this->request->getPost('meta_keywords'),
						'meta_title' => $this->request->getPost('meta_title'),
						'meta_description' => $this->request->getPost('meta_description'),
						'status' => $this->request->getPost('status'),
						'publish_date' => ($this->request->getPost('publish_date')?strtotime($this->request->getPost('publish_date')):strtotime(date('Y-m-d H:i:s'))),
						//'image_logo' => $filepath
					);
					$filearr = [];
					if(!empty($_FILES['file'])) {	
						foreach($_FILES['file']['tmp_name'] as $key=>$v) {	
							if($_FILES['file']['tmp_name'][$key]){
								$imgData = base64_encode(file_get_contents($_FILES['file']['tmp_name'][$key]));
								//$imageProperties = getimageSize($_FILES['file']['tmp_name']);					
								$filearr[$key] = $imgData;				
							}							
						}
						$data['custom_assets'] = json_encode($filearr);
						
					 }
					$this->model->saveData($data);

				}else{
				   // Set Session
				   session()->setFlashdata('message', 'File not uploaded.');
				   session()->setFlashdata('alert-class', 'alert-danger');

				}
			 //}

		 //}
			
		}
        return redirect()->to('/webpages');
    }
	
	
	
	public function edit($id)
    {
		$data['webpage'] = $this->model->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
        echo view('edit_webpage',$data);
    }
	
	public function rmimg($id,$key)
    {
		if(!empty($id) && isset($key)){
			$row = $this->model->getRows($id)->getRow();			
			$arr = json_decode($row->custom_assets,true);
			unset($arr[$key]); // remove item at index 0
			$arr = array_values($arr); // 'reindex' array

			$data['custom_assets'] = json_encode($arr);
			$this->model->updateData($id,$data);
			session()->setFlashdata('message', 'Image deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
			
		}
		return redirect()->to('/webpages/edit/'.$id);
		
	}
	
    public function update()
    {        
        $id = $this->request->getPost('id');
		if(!empty($id)){
			
			$row = $this->model->getRows($id)->getRow();
			
			
			$data = array(
						'title'  => $this->request->getPost('title'),				
						'sub_title' => $this->request->getPost('sub_title'),
						'content' => $this->request->getPost('content'),
						'code' => $this->request->getPost('code')?$this->model->format_uri($this->request->getPost('code'),'-',$id):$this->model->format_uri($this->request->getPost('title'),'-',$id),
						'meta_keywords' => $this->request->getPost('meta_keywords'),
						'meta_title' => $this->request->getPost('meta_title'),
						'meta_description' => $this->request->getPost('meta_description'),
						'status' => $this->request->getPost('status'),
						'publish_date' => ($this->request->getPost('publish_date')?strtotime($this->request->getPost('publish_date')):strtotime(date('Y-m-d H:i:s'))),
						//'image_logo' => $filepath
					);
					
					/* if($_FILES['file']['tmp_name']) {	
												
						$imgData = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
						$imageProperties = getimageSize($_FILES['file']['tmp_name']);
				
						$data['custom_assets'] = $imgData;
						
					 } */
					 
					$filearr = ($row->custom_assets!="")?json_decode($row->custom_assets):[];
					$count = !empty($filearr)?count($filearr):0;
					if(!empty($_FILES['file'])) {	
						foreach($_FILES['file']['tmp_name'] as $key=>$v) {	
							if($_FILES['file']['tmp_name'][$key]){
								$imgData = base64_encode(file_get_contents($_FILES['file']['tmp_name'][$key]));
								//$imageProperties = getimageSize($_FILES['file']['tmp_name']);					
								$filearr[$count] = $imgData;
								$count++;
							}							
						}
						$data['custom_assets'] = json_encode($filearr);
						
					 }
			$this->model->updateData($id, $data);
			
			session()->setFlashdata('message', 'Data updated Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}else {
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');				   
		}
        return redirect()->to('/webpages');
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
	
	public function delete($id)
    {       
		//echo $id; die;
        if(!empty($id)) {
			$this->model->deleteData($id);		
			session()->setFlashdata('message', 'Data deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}
		
        return redirect()->to('/webpages');
    }
	
	public function upload($filename = null){
		$input = $this->validate([
			$filename => "uploaded[$filename]|max_size[$filename,1024]|ext_in[$filename,jpg,jpeg,docx,pdf],"
		 ]);

		 if (!$input) { // Not valid
			return '';
		 }else{ // Valid

			 if($file = $this->request->getFile($filename)) {
				if ($file->isValid() && ! $file->hasMoved()) {
				   // Get file name and extension
				   $name = $file->getName();
				   $ext = $file->getClientExtension();

				   // Get random file name
				   $newName = $file->getRandomName(); 

				   // Store file in public/uploads/ folder
				   $file->move('../public/uploads', $newName);

				   // File path to display preview
				   return $filepath = base_url()."/uploads/".$newName;
				   
				}
				
			 }
			 
		 }
		 
	}
}