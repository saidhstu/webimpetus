<?php 
namespace App\Controllers\Core; 
use App\Controllers\BaseController; 
use CodeIgniter\Controller;
use App\Models\Core\Common_model;

use App\Models\Users_model;
 
class CommonController extends BaseController
{	
	protected $session;
	protected $table;
	protected $model;

	function __construct()
    {
        parent::__construct();
        
		$this->session = \Config\Services::session();
		$this->model = new Common_model();
		
		
		$this->table = $this->getTableNameFromUri();
		$this->rawTblName =  substr($this->table, 0, -1); 

	}
    
	public function getTableNameFromUri ()
    {

        $uri = service('uri');
        $tableNameFromUri = $uri->getSegment(1);
        return $tableNameFromUri;
    }

    public function index()
    {        

        $data[$this->table] = $this->model->getRows();
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;

        echo view($this->table."/list",$data);
    }
	 
	
	public function edit($id = 0)
    {
		$data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
		$data["users"] = $this->model->getUser();
		$data[$this->rawTblName] = $this->model->getRows($id)->getRow();
		// if there any special cause we can overried this function and pass data to add or edit view
		$data['additional_data'] = $this->getAdditionalData($id);

        echo view($this->table."/edit",$data);
    }
		
    public function update()
    {        
        $id = $this->request->getPost('id');

		$data = $this->request->getPost();
		$response = $this->model->insertOrUpdate($id, $data);
		if(!$response){
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');	
		}

        return redirect()->to('/'.$this->table);
    }
	
	
	public function delete($id)
    {       
		//echo $id; die;
        if(!empty($id)) {
			$response = $this->model->deleteData($id);		
			if($response){
				session()->setFlashdata('message', 'Data deleted Successfully!');
				session()->setFlashdata('alert-class', 'alert-success');
			}else{
				session()->setFlashdata('message', 'Something wrong delete failed!');
				session()->setFlashdata('alert-class', 'alert-danger');		
			}

		}
		
        return redirect()->to('/'.$this->table);
    }
	
	// only call if there additional data needed on edit view
	public function getAdditionalData($id)
	{

	}


}