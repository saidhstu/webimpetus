<?php 
namespace App\Controllers;
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
		$this->rawTblName =  "blocks"; 
		$this->model = new Blocks_model();
		$this->user_model = new Users_model();
	}

    public function index()
    {        
		$data['rawTblName'] = $this->rawTblName;
		$data['tableName'] = "blocks";
        $data[$this->rawTblName] = $this->model->findAll();
        echo view($this->table.'/list',$data);
    }
	
	
	public function edit($id = 0)
    {
		$data['tableName'] = "blocks";
		$data[$this->rawTblName] = $this->model->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
        echo view($this->table.'/edit',$data);
    }
	
	
    public function update()
    {        
		$data = array(
			'code' => $this->request->getPost('code'),
			'status' => $this->request->getPost('status'),
			'text' => $this->request->getPost('text'),
		);

        $id = $this->request->getPost('id');
		if($id > 0){
								
	
			$this->model->updateData($id, $data);
			
			session()->setFlashdata('message', 'Data updated Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}else {

			$this->model->saveData($data);	
			session()->setFlashdata('message', 'Data entered Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');	   
		}
        return redirect()->to('/'.$this->rawTblName);
    }	

}