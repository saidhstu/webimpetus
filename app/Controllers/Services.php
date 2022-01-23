<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Service_model;
use App\Models\Users_model;
use App\Models\Tenant_model;
use App\Models\Cat_model;
use App\Models\Secret_model;
use App\Models\Template_model;
use App\Models\Meta_model;

class Services extends Api
{	
	public function __construct()
	{
		parent::__construct(); 
		$this->session = \Config\Services::session();
		$this->model = new Service_model();
		$this->user_model = new Users_model();
		$this->tmodel = new Tenant_model();
		$this->cmodel = new Cat_model();
		$this->secret_model = new Secret_model();
		$this->template_model = new Template_model();
		$this->meta_model = new Meta_model();
	}
    public function index()
    {        
        $data['services'] = $this->model->getRows();
		echo view('services',$data);
    }
	
	public function add()
    {
		$data['users'] = $this->user_model->getUser();
		$data['tenants'] = $this->tmodel->getRows();
		$data['category'] = $this->cmodel->getRows();
		
		//$data['defaultSecret'] = $this->secret_model->getDefaultRows();
		
        echo view('add_service',$data);
    }
 
    public function save()
    {        
		//echo '<pre>';print_r($this->request); die;        
		if(!empty($this->request->getPost('code'))){		

		   // File path to display preview
			//$filepath = $this->upload('file');	
			//echo '<pre>'; print_r($this->request->getFile('file')); die;
			//$filepath2 = $this->upload('file2');		   
		   
		   $data = array(
				'name'  => $this->request->getPost('name'),
				'code' => $this->request->getPost('code'),				
				'notes' => $this->request->getPost('notes'),	
				'uuid' => $this->request->getPost('uuid'),
				//'nginx_config' => $this->request->getPost('nginx_config'),
				//'varnish_config' => $this->request->getPost('varnish_config'),
				/* 'image_logo' => $filepath,
				'image_brand' => $filepath2, */
				'cid' => $this->request->getPost('cid'),
				'tid' => $this->request->getPost('tid'),
			);
			
			if($_FILES['file']['tmp_name']) {		
				//echo '<pre>';print_r($_FILES['file']); die;											
				$imgData = base64_encode(file_get_contents($_FILES['file']['tmp_name']));				
				$data['image_logo'] = $imgData;
			 }
			 
			 if($_FILES['file2']['tmp_name']) {		
				//echo '<pre>';print_r($_FILES['file']); die;											
				$imgData2 = base64_encode(file_get_contents($_FILES['file2']['tmp_name']));				
				$data['image_brand'] = $imgData2;
			 }
			
			 $this->model->saveData($data);	
			 
		//	Sanket Changes start 11th January 2022
		$service_id = $this->model->getLastInserted();
		
//BW

$default_secrets_template = $this->meta_model->getRowsByCode('service_default_secret');
// print_r($default_secrets_template->result_array);
// foreach ($default_secrets_template as $row)
// {
// 	echo $row['meta_key'];
// 	echo $row['meta_value'];
// }

// die;

foreach($default_secrets_template as $row)
{
	$default_meta_data['key_name'] = $row['meta_key'];
	$default_meta_data['key_value'] = $row['meta_value'];
	$default_meta_data['status'] = 1;

	$this->secret_model->saveData($default_meta_data);
	$secret_id = $this->secret_model->getLastInserted();
	$dataRelated['secret_id'] = $secret_id;
	$dataRelated['service_id'] = $service_id;

	$this->secret_model->saveSecretRelatedData($dataRelated);	
}

//BW

		// $default_key_name = $this->request->getPost('default_key_name');
		// $default_key_value = $this->request->getPost('default_key_value');
		// $jak_increment_val = 1;
		// foreach ($default_key_name as $key => $value) {
		// 	$def_data['service_id'] = $service_id;
		// 	$def_data['secrets_default_id'] = $jak_increment_val;
		// 	$def_data['secrets_default_value'] = $default_key_value[$key];
			
		// 	$this->secret_model->saveDefaultData($def_data);
		// 	$jak_increment_val++;
		// }
		
		$key_name = $this->request->getPost('key_name');
		$key_value = $this->request->getPost('key_value');
		
		if(count($key_name) > 0){
			foreach ($key_name as $key => $value) {
				//$address_data['service_id'] = $service_id;
				$address_data['key_name'] = $key_name[$key];
				$address_data['key_value'] = $key_value[$key];
				$address_data['status'] = 1;
				
				$this->secret_model->saveData($address_data);
			}
		}
		
		//	Sanket Changes end 11th January 2022
			// Set Session
		   session()->setFlashdata('message', 'Data entered Successfully!');
		   session()->setFlashdata('alert-class', 'alert-success');
		}	 
        return redirect()->to('/services');
    }
	
	public function edit($id)
    {        
        $data['service'] = $this->model->getRows($id)->getRow();
		$data['tenants'] = $this->tmodel->getRows();
		$data['category'] = $this->cmodel->getRows();
		$data['users'] = $this->user_model->getUser();
		$data['secret_services'] = $this->secret_model->getSecrets($id);
        
		//$data['defaultSecret'] = $this->secret_model->getDefaultRows();
		//$data['default_secrets_services'] = $this->secret_model->getServicesFromSecret2($id);
		
        echo view('edit_service', $data);
    }
	
	/*public function rmimg($type="", $id)
    {
		if(!empty($id)){
			$data[$type] = "";
			$this->model->updateData($id,$data);
			session()->setFlashdata('message', 'Image deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
			
		}
		return redirect()->to('/services/edit/'.$id);
		
	}*/
	
    public function update()
    {
        $id = $this->request->getPost('id');
		
		if(!empty($id)){
        $data = array(
			'name'  => $this->request->getPost('name'),
			'code' => $this->request->getPost('code'),				
			'notes' => $this->request->getPost('notes'),	
			'uuid' => $this->request->getPost('uuid'),
			//'nginx_config' => $this->request->getPost('nginx_config'),
			//'varnish_config' => $this->request->getPost('varnish_config'),
			'cid' => $this->request->getPost('cid'),
			'tid' => $this->request->getPost('tid'),
			//'image_logo' => $filepath,
			//'image_brand' => $filepath2
		);
		
		if($_FILES['file']['tmp_name']) {		
			//echo '<pre>';print_r($_FILES['file']); die;											
			$imgData = base64_encode(file_get_contents($_FILES['file']['tmp_name']));				
			$data['image_logo'] = $imgData;
		 }
		 
		 if($_FILES['file2']['tmp_name']) {		
			//echo '<pre>';print_r($_FILES['file']); die;											
			$imgData2 = base64_encode(file_get_contents($_FILES['file2']['tmp_name']));				
			$data['image_brand'] = $imgData2;
		 }
        $this->model->updateData($id,$data);
		
		$this->secret_model->deleteServiceFromServiceID($id);
		
		$key_name = $this->request->getPost('key_name');
		$key_value = $this->request->getPost('key_value');
		
		foreach ($key_name as $key => $value) {
			//$address_data['service_id'] = $id;
			$address_data['key_name'] = $key_name[$key];
			$address_data['key_value'] = $key_value[$key];
			$address_data['status'] = 1;


			$this->secret_model->saveData($address_data);
			$secret_id = $this->secret_model->getLastInserted();
			$dataRelated['secret_id'] = $secret_id;
			$dataRelated['service_id'] = $id;

			$this->secret_model->saveSecretRelatedData($dataRelated);	
		}
		
				//	Sanket Changes end 11th January 2022
// $default_key_name = $this->request->getPost('default_key_name');
		// $default_key_value = $this->request->getPost('default_key_value');
		// $jak_increment_val = 1;
		// foreach ($default_key_name as $key => $value) {
		// 	$def_data['secrets_default_value'] = $default_key_value[$key];
			
		// 	$this->secret_model->updateDefaultData($id, $jak_increment_val, $def_data);
		// 	$jak_increment_val++;
		// }
		//	Sanket Changes end 11th January 2022
		
		session()->setFlashdata('message', 'Data updated Successfully!');
		session()->setFlashdata('alert-class', 'alert-success');
		} else{
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');
		}
		
        return redirect()->to('/services');
    }
	
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
	
	public function delete($id)
    {       
		//echo $id; die;
        if(!empty($id)){
			$this->model->deleteData($id);
			session()->setFlashdata('message', 'Data deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}
		
        return redirect()->to('/services');
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
	
	public function deploy_service($uuid=0)
    {
		if(!empty($uuid)) {
			//$enval = getenv('MYSECRET');
			
			$this->export_service_json($uuid);
			$this->gen_service_env_file($uuid);
			$this->push_service_env_vars($uuid);
			$this->gen_service_yaml_file($uuid);
						
			exec('/bin/bash /var/www/html/writable/tizohub_deploy_service.sh', $output, $return);
			echo "Service deployment process started OK.";
			
		} else { echo "Uuid is empty!!"; }
		
    }
	
	public function export_service_json($uuid) 
	{
		//export service json same format as provided by the api
		// url/api/service/uuid.json -> json
		// write json to to file	
		
		$myfile = fopen(FCPATH."tizohub_deployments/service-".$uuid.".json", "w") or die("Unable to open file!");
		
		fwrite($myfile, $this->services($uuid,true));
		fclose($myfile);
	}
	
	public function push_service_env_vars($uuid) 
	{
		// loop through all secrets of this service 
		//foreach ();
		//putenv("secretname", "secretvalue");
		$secrets = $this->secret_model->getSecrets($uuid);
		if(!empty($secrets)){
			foreach($secrets as $key=>$val){
				putenv($val['key_name']."=".$val['key_value']);
			}
		}
	}
	

public function gen_service_env_file($uuid)
{

	$service_data = file_get_contents(WRITEPATH. 'tizohub.env.template');
	$secrets = $this->secret_model->getSecrets($uuid);
	if(!empty($secrets)){
		foreach($secrets as $key=>$val){
			$pattern = "/{{".$val['key_name']."}}/i";
			$service_data = preg_replace($pattern, $val['key_value'], $service_data);
	
		}
	}

	$myfile = fopen(WRITEPATH."tizohub_deployments/service-".$uuid.".env", "w") or die("Unable to open file!");
	fwrite($myfile, $service_data);
	fclose($myfile);

}

public function gen_service_yaml_file($uuid)
{

	$service_data = file_get_contents(WRITEPATH. 'tizohub.yaml.template');
	$secrets = $this->secret_model->getSecrets($uuid);
	if(!empty($secrets)){
		foreach($secrets as $key=>$val){
			$pattern = "/{{".$val['key_name']."}}/i";
			$service_data = preg_replace($pattern, $val['key_value'], $service_data);
	
		}
	}

	$myfile = fopen(WRITEPATH."tizohub_deployments/service-".$uuid.".yaml", "w") or die("Unable to open file!");
	fwrite($myfile, $service_data);
	fclose($myfile);

}


}