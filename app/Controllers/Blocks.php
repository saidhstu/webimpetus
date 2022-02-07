<?php namespace App\Controllers;
use App\Controllers\BaseController;
 
use App\Models\Blocks_model;
use App\Models\Users_model;
use App\Controllers\Core\CommonController; 
use App\Models\Core\Common_model;


class Blocks extends CommonController
{	

	function __construct()
    {
        parent::__construct();
		$this->table = "blocks_list";
		$this->rawTblName =  "block"; 
		$this->model = new Blocks_model();
		$this->user_model = new Users_model();
	}

    public function index()
    {        
        $data['content'] = $this->model->findAll();
        echo view('blocks',$data);
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
	
	public function edit($i = 0)
    {
		$data['content'] = $this->model->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
        echo view('edit_block',$data);
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

}