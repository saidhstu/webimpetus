<?php 
namespace App\Controllers\Core; 
use App\Controllers\BaseController; 
use CodeIgniter\Controller;
use App\Models\Core\Common_model;
use App\Models\Amazon_s3_model;

use App\Models\Users_model;
 
class CommonController extends BaseController
{	
	protected $table;
	protected $model;
	protected $businessUuid;
	protected $notAllowedFields = array();

	function __construct()
    {
        parent::__construct();
        
		$this->businessUuid = session('uuid_business');
		$this->whereCond['uuid_business_id'] = $this->businessUuid;

		$this->model = new Common_model();
		$this->Amazon_s3_model = new Amazon_s3_model();
		
		
		$this->table = $this->getTableNameFromUri();
		$this->rawTblName =  substr($this->table, 0, -1); 
		$this->menucode = $this->getMenuCode("/".$this->table);

		$this->session->set("menucode", $this->menucode);
		$this->notAllowedFields = array('uuid_business_id',"uuid");

	}
    
	public function getTableNameFromUri ()
    {

        $uri = service('uri');
        $tableNameFromUri = $uri->getSegment(1);
        return $tableNameFromUri;
    }

    public function index()
    {        

		$data['columns'] = $this->db->getFieldNames($this->table);
		$data['fields'] = array_diff($data['columns'], $this->notAllowedFields);
        $data[$this->table] = $this->model->getRows();
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;
        $data['identifierKey'] = 'id';

		$viewPath = "common/list";
		if (file_exists( APPPATH . 'Views/' . $this->table."/list.php")) {
			$viewPath = $this->table."/list";
		}

        return view($viewPath, $data);
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
	
	public function deleteImage($id )
    {
		if(!empty($id)){
			$data['image_logo'] = null;
			$response = $this->Amazon_s3_model->deleteFileFromS3($this->table, "image_logo");
			$this->model->updateColumn($this->table, $id, $data);
	
			if($response){
				session()->setFlashdata('message', 'Image deleted Successfully!');
				session()->setFlashdata('alert-class', 'alert-success');	
			
			}else{
				session()->setFlashdata('message', 'Something wrong!');
				session()->setFlashdata('alert-class', 'alert-danger');		
			}
			
		}
		return redirect()->to('/'.$this->table.'/edit/'.$id);
		
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

	// 
	public function status()
    {  
		if(!empty($id = $this->request->getPost('id'))){
			$data = array(            
				'status' => $this->request->getPost('status')
			);
			$this->model->updateData($id,$data);
		}
		echo '1';
	}


	
	// only call if there additional data needed on edit view
	public function getAdditionalData($id)
	{

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

	public function getMenuCode($link){

		return $this->model->getMenuCode($link);
	}


}