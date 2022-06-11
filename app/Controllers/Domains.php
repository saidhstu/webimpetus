<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Domain_model;
use App\Models\Users_model;
use App\Models\Service_model;
use App\Controllers\Core\CommonController; 
use App\Models\Core\Common_model;


class Domains extends CommonController
{	

	function __construct()
    {
        parent::__construct();
		$this->domainModel = new Domain_model();
		$this->user_model = new Users_model();
		$this->service_model = new Service_model();
	}

    public function index()
    {			
		$data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['domains'] = $this->domainModel->getRows();
        echo view('domains/list',$data);
    }
	

	public function edit($id=0)
    {        
		$data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['domain'] = $this->domainModel->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
		$data['services'] = $this->service_model->getRows();

		echo view($this->table."/edit",$data);
    }
	

	public function update()
    {        
        $id = $this->request->getPost('id');
		$data = array(
			'name'  => $this->request->getPost('name'),				
			'notes' => $this->request->getPost('notes'),
			'uuid' => $this->request->getPost('uuid'),
			'sid' => $this->request->getPost('sid'),
			'uuid_business_id' => session('uuid_business'),
		);
		
		$file = $this->request->getPost('file');
		if(strlen($file) > 0){
			$data['image_logo'] = $file;
		}


			$response = $this->model->insertOrUpdate($id, $data);
			if(!$response){
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');		
			}


		return redirect()->to('/'.$this->table);

    }




}