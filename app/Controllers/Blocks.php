<?php namespace App\Controllers;
use App\Controllers\BaseController;
 
use CodeIgniter\Controller;
use App\Models\Blocks_model;
use App\Models\Users_model;
 
class Blocks extends Controller
{	
	public function __construct()
	{
		$this->session = \Config\Services::session();
		$this->model = new Blocks_model();
		$this->user_model = new Users_model();
	}
    public function index()
    {        
        $data['content'] = $this->model->findAll();
        echo view('blocks',$data);
    }
	
	public function add()
    {
		$data['users'] = $this->user_model->getUser();
        echo view('add_block',$data);
    }
 
    public function save()
    {		      
		if(!empty($this->request->getPost('code'))){
				
				   // Set Session
				   session()->setFlashdata('message', 'Data entered Successfully!');
				   session()->setFlashdata('alert-class', 'alert-success');
				   
				   $data = array(						
						'code' => $this->request->getPost('code'),
						'text' => $this->request->getPost('text'),
						'status' => $this->request->getPost('status'),						
						//'image_logo' => $filepath
					);				
					
					$this->model->saveData($data);			
			
		}
        return redirect()->to('//blocks');
    }
	
	public function edit($id)
    {
		$data['content'] = $this->model->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
        echo view('edit_block',$data);
    }
	
	public function rmimg($id)
    {
		if(!empty($id)){
			$data['custom_assets'] = null;
			$this->model->updateData($id,$data);
			session()->setFlashdata('message', 'Image deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
			
		}
		return redirect()->to('//blocks/edit/'.$id);
		
	}
	
    public function update()
    {        
        $id = $this->request->getPost('id');
		if(!empty($id)){
			$data = array(
						'code' => $this->request->getPost('code'),
						'status' => $this->request->getPost('status'),
						'text' => $this->request->getPost('text'),
					);					
	
			$this->model->updateData($id, $data);
			
			session()->setFlashdata('message', 'Data updated Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}else {
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');				   
		}
        return redirect()->to('//blocks');
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
		
        return redirect()->to('//blocks');
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