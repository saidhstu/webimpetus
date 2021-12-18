<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Tenant_model;
use App\Models\Users_model;
 use App\Models\Service_model;
  use App\Models\Tenant_service_model;
class Tenants extends Controller
{	
	public function __construct()
	{
		$this->session = \Config\Services::session();
	  $this->model = new Tenant_model();
	  $this->user_model = new Users_model();
	  $this->service_model = new Service_model();
	  $this->tservice_model = new Tenant_service_model();
	  //$this->CI = &get_instance();
	}
    public function index()
    {        
        $data['tenants'] = $this->model->getJoins();
		//echo '<pre>';print_r($data['tenants']); die;
        echo view('tenants',$data);
    }
	
	public function add()
    {
		$data['users'] = $this->user_model->getUser();
		$data['services'] = $this->service_model->getRows();
        echo view('add_tenant',$data);
    }
 
    public function save()
    {        
		//echo '<pre>';print_r($this->request->getPost('name')); die;        
		if(!empty($this->request->getPost('contact_email'))){
			
			$count = $this->model->getWhere(['contact_email' => $this->request->getPost('contact_email')])->getNumRows();
			if(!empty($count)){
				session()->setFlashdata('message', 'Email already exist!');
				session()->setFlashdata('alert-class', 'alert-danger');
				return redirect()->to('/tenants/add');
			}else {
				$data = array(
					'name'  => $this->request->getPost('name'),
					'contact_email' => $this->request->getPost('contact_email'),
					'contact_name' => $this->request->getPost('contact_name'),
					'address' => $this->request->getPost('address'),
					'notes' => $this->request->getPost('notes'),
					'uuid' => $this->request->getPost('uuid')
					//'status' => 0,
				);
				$this->model->saveData($data); 
				$tid = $this->model->getLastInserted(); //die;
				if(!empty($this->request->getPost('sid'))){
					foreach($this->request->getPost('sid') as $val){
						$this->tservice_model->saveData(array('sid'=>$val,'tid'=>$tid));
					}
				}
				session()->setFlashdata('message', 'Data entered Successfully!');
				session()->setFlashdata('alert-class', 'alert-success');				
			}
		}
        return redirect()->to('/tenants');
    }
	
	public function edit($id)
    {        
        $data['tenant'] = $this->model->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
		$data['services'] = $this->service_model->getRows();
		$data['tservices'] = array_column($this->tservice_model->getRows($id, 1),'sid');
		//echo '<pre>';print_r($data['tservices']); die;
        echo view('edit_tenant', $data);
    }
	
    public function update()
    {        
        $id = $this->request->getPost('id');
		
		$count = $this->model->getWhere(['contact_email' => $this->request->getPost('contact_email'), 'id!=' => $id])->getNumRows();
		if(!empty($count)){
				session()->setFlashdata('message', 'Email already exist!');
				session()->setFlashdata('alert-class', 'alert-danger');
				return redirect()->to('/tenants/edit/'.$id);
		}else {
			$data = array(
				'name'  => $this->request->getPost('name'),
				'contact_email' => $this->request->getPost('contact_email'),
				'contact_name' => $this->request->getPost('contact_name'),
				'address' => $this->request->getPost('address'),
				'notes' => $this->request->getPost('notes'),
				'uuid' => $this->request->getPost('uuid'),
				//'status' => 0,
			);
			$this->model->updateData($data, $id);
			$tid = $id;
			$this->tservice_model->deleteData($id);
			if(!empty($this->request->getPost('sid'))){
					foreach($this->request->getPost('sid') as $val){
						$this->tservice_model->saveData(array('sid'=>$val,'tid'=>$tid));
					}
				}
			session()->setFlashdata('message', 'Data updated Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		
		}
        return redirect()->to('/tenants');
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
        if(!empty($id)){
			$this->model->deleteData($id);
			session()->setFlashdata('message', 'Data deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}
		
        return redirect()->to('/tenants');
    }
}