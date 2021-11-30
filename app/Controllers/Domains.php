<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Domain_model;
use App\Models\Users_model;
use App\Models\Service_model;

class Domains extends Controller
{	
	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->model = new Domain_model();
		$this->user_model = new Users_model();
		$this->service_model = new Service_model();
	}
    public function index()
    {			
        $data['domains'] = $this->model->getRows();
        echo view('domains',$data);
    }
	
	public function add()
    {
		$data['users'] = $this->user_model->getUser();
		$data['services'] = $this->service_model->getRows();
        echo view('add_domain',$data);
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
	
	public function rmimg($id)
    {
		if(!empty($id)){
			$data['image_logo'] = null;
			$this->model->updateData($id,$data);
			session()->setFlashdata('message', 'Image deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
			
		}
		return redirect()->to('/domains/edit/'.$id);
		
	}
 
    public function save()
    {        
		//echo '<pre>';print_r($this->request->getPost('name')); die;        
		if(!empty($this->request->getPost('name'))){
			
		// Validation
		/*  $input = $this->validate([
			'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpg,jpeg,docx,pdf],'
		 ]);

		 if (!$input) { // Not valid
			$data['validation'] = $this->validator; 
			session()->setFlashdata('message', 'File extention is not valid.File not uploaded.');
			session()->setFlashdata('alert-class', 'alert-danger');
		 }else{ // Valid

			 if($file = $this->request->getFile('file')) {
				if ($file->isValid() && ! $file->hasMoved()) { */
				   // Get file name and extension
				   /* $name = $file->getName();
				   $ext = $file->getClientExtension();

				   // Get random file name
				   $newName = $file->getRandomName(); 

				   // Store file in public/uploads/ folder
				   $file->move('../public/uploads', $newName);

				   // File path to display preview
				   $filepath = base_url()."/uploads/".$newName; */
				   
				   // Set Session
				   
				   $data = array(
						'name'  => $this->request->getPost('name'),				
						'notes' => $this->request->getPost('notes'),
						'uuid' => $this->request->getPost('uuid'),
						'sid' => $this->request->getPost('sid'),						
					);
					
					if($_FILES['file']['tmp_name']) {		
						//echo '<pre>';print_r($_FILES['file']); die;	
												
						$imgData = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
						$imageProperties = getimageSize($_FILES['file']['tmp_name']);
				
						$data['image_logo'] = $imgData;
						$data['image_type'] = $imageProperties['mime'];
					 }
				   
					$this->model->saveData($data);
					
					session()->setFlashdata('message', 'Data entered Successfully!');
				   session()->setFlashdata('alert-class', 'alert-success');

				/* }else{
				   // Set Session
				   session()->setFlashdata('message', 'File not uploaded.');
				   session()->setFlashdata('alert-class', 'alert-danger');

				}
			 } 

		 }*/
			
		}
        return redirect()->to('/domains');
    }
	
	public function edit($id)
    {        
        $data['category'] = $this->model->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
		$data['services'] = $this->service_model->getRows();
		//echo 'data:image/jpeg;base64,'.$data['category']->image_logo; die;
		//header("Content-type: image/jpeg");
		//echo '<img src="data:image/jpeg;base64,'.base64_decode($data['category']->image_logo).'" />'; die;
        echo view('edit_domain', $data);
    }
	
    public function update()
    {        
         $id = $this->request->getPost('id');
		if(!empty($id)){
			$data = array(
				'name'  => $this->request->getPost('name'),				
				'notes' => $this->request->getPost('notes'),
				'uuid' => $this->request->getPost('uuid'),
				'sid' => $this->request->getPost('sid'),
			);
			
			if($_FILES['file']['tmp_name']) {		
				//echo '<pre>';print_r($_FILES['file']); die;											
				$imgData = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
				$imageProperties = getimageSize($_FILES['file']['tmp_name']);
		
				$data['image_logo'] = $imgData;
				$data['image_type'] = $imageProperties['mime'];
			 }
			$this->model->updateData($id, $data);
			
			session()->setFlashdata('message', 'Data updated Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}else {
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');				   
		}
        return redirect()->to('/domains');
    }
	
	public function delete($id)
    {       
		//echo $id; die;
        if(!empty($id)) {
			$this->model->deleteData($id);		
			session()->setFlashdata('message', 'Data deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}
		
        return redirect()->to('/domains');
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