<?php namespace App\Controllers;
use App\Controllers\BaseController;
 
use CodeIgniter\Controller;
use App\Models\Secret_model;
use App\Models\Service_model;
 
class Secrets extends Controller
{	
	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->model = new Secret_model();
		$this->service_model = new Service_model();
	}
    public function index()
    {        
        $data['content'] = $this->model->findAll();
        echo view('secrets',$data);
    }
	
	public function add()
    {
		$data['services'] = $this->service_model->getRows();
        echo view('add_secret',$data);
    }
 
    public function save()
    {		      
		if(!empty($this->request->getPost('key_name'))){
				
				   // Set Session
				   session()->setFlashdata('message', 'Data entered Successfully!');
				   session()->setFlashdata('alert-class', 'alert-success');
				   
				   $data = array(						
						'key_name' => $this->request->getPost('key_name'),
						'key_value' => $this->request->getPost('key_value'),
						//'services' => implode(',',$this->request->getPost('sid')),
						'status' => $this->request->getPost('status')?$this->request->getPost('status'):0,						
						//'image_logo' => $filepath
					);				
					$this->model->saveData($data); 
					$secret_id = $this->model->getLastInserted(); //die;
					if(!empty($this->request->getPost('sid'))){
						foreach($this->request->getPost('sid') as $val){
							$this->model->serviceData(array('service_id'=>$val,'secret_id'=>$secret_id));
						}
					}			
			
		}
        return redirect()->to('/secrets');
    }
	
	public function edit($id)
    {
		$data['content'] = $this->model->getRows($id)->getRow();
		$data['services'] = $this->service_model->getRows();
		$data['sservices'] = array_column($this->model->getServices($id),'service_id');
        echo view('edit_secret',$data);
    }
	
	public function rmimg($id)
    {
		if(!empty($id)){
			$data['custom_assets'] = null;
			$this->model->updateData($id,$data);
			session()->setFlashdata('message', 'Image deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
			
		}
		return redirect()->to('/secrets/edit/'.$id);
		
	}
	
    public function update()
    {        
        $id = $this->request->getPost('id');
		if(!empty($id)){
			$data = array(
						'key_name' => $this->request->getPost('key_name'),
						'status' => $this->request->getPost('status')?$this->request->getPost('status'):0,
						//'services' => implode(',',$this->request->getPost('sid')),
						//'key_value' => $this->request->getPost('key_value'),
					);	

			if(strpos($this->request->getPost('key_value'), '********') === false){				
				$data['key_value'] = $this->request->getPost('key_value');
			}
	
			$this->model->updateData($id, $data);
			
			$secret_id = $id;
			$this->model->deleteService($id);
			if(!empty($this->request->getPost('sid'))){
						foreach($this->request->getPost('sid') as $val){
							$this->model->serviceData(array('service_id'=>$val,'secret_id'=>$secret_id));
						}
					}	
				
				
			
			session()->setFlashdata('message', 'Data updated Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}else {
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');				   
		}
        return redirect()->to('/secrets');
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
		
        return redirect()->to('/secrets');
    }
	
	public function upload($filename = null){
		//echo $filename; die;
		$input = $this->validate([
			$filename => "uploaded[$filename]|max_size[$filename,1024]|ext_in[$filename,jpg,png,jpeg,docx,pdf],"
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
				   $file->move('../public/ckfinder/userfiles/files/', $newName);

				   // File path to display preview
				   return $filepath = base_url()."/ckfinder/userfiles/files/".$newName;
				   
				}
				
			 }
			 
		 }
		 
	}
}