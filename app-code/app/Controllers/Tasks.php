<?php 
namespace App\Controllers; 
use App\Controllers\Core\CommonController; 
use App\Models\Tasks_model;
use App\Models\Core\Common_model;
 
class Tasks extends CommonController
{	
	
    function __construct()
    {
        parent::__construct();

        $this->Tasks_model = new Tasks_model();

	}
    public function index()
    {        

        $data[$this->table] = $this->Tasks_model->getTaskList();
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;

        echo view($this->table."/list",$data);
    }

    public function update()
    {        
        $id = $this->request->getPost('id');

		$data = $this->request->getPost();

        $data['start_date'] = strtotime($data['start_date']);
        $data['end_date'] = strtotime($data['end_date']);
     
        if(empty($id)){
            $data['task_id'] = findMaxFieldValue($this->table, "task_id");

            if(empty($data['task_id'])){
                $data['task_id'] = 1001;
            }else{
                $data['task_id'] += 1;
            }
        }

		$response = $this->model->insertOrUpdate($id, $data);
		if(!$response){
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');	
		}

        return redirect()->to('/'.$this->table);
    }
}