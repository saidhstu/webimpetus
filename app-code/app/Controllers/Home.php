<?php
namespace App\Controllers;
use App\Models\Users_model;
use App\Models\Meta_model;
use App\Models\Menu_model;
class Home extends BaseController
{
	public function __construct()
	{
		$this->session = \Config\Services::session();
	  $this->model = new Users_model();
	  $this->meta_model = new Meta_model();
	  $this->menu_model = new Menu_model();
	}
	
    public function index()
    {
		if($this->session->get('uuid')){
		  return redirect()->to('/dashboard');
	  }
	  $data['logo'] = $this->meta_model->getWhere(['meta_key' => 'site_logo'])->getRow();
	  $data['uuid'] = $this->meta_model->getAllBusiness();
        $data['title'] = "Hello World from Codeigniter 4";
        echo view('login', $data);
    }
	
	public function login()
    {
        if(!empty($this->request->getPost('email')) && !empty($this->request->getPost('password'))){		

			$count = $this->model->getWhere(['status' => 1, 'email' => $this->request->getPost('email'),'password' => md5($this->request->getPost('password'))])->getNumRows();
			if(!empty($count)){
				//session()->setFlashdata('message', 'Email already exist!');
				//session()->setFlashdata('alert-class', 'alert-success');
				$row = $this->model->getWhere(['email' => $this->request->getPost('email')])->getRow();
				$logo = $this->meta_model->getWhere(['meta_key' => 'site_logo'])->getRow();
				$uuid_business_id = $this->request->getPost('uuid_business_id');

				$uuid_business = @$this->meta_model->getBusinessRow($uuid_business_id)->uuid;

				$this->session->set('uemail',$row->email);
				$this->session->set('uuid',$row->id);
				$this->session->set('uname',$row->name);
				$this->session->set('role',$row->role);
				$this->session->set('logo',$logo->meta_value);	
				$this->session->set('uuid_business_id',$uuid_business_id);	
				$this->session->set('uuid_business',$uuid_business);	
				$arr = json_decode($row->permissions);
				$roww = $this->menu_model->getWherein($arr);
				// echo '<pre>';print_r($roww); die;
				$this->session->set('permissions',$roww);


				// return redirect()->to('/dashboard');
				return redirect()->to($this->request->getPost('redirectAfterLogin'));
			}else {
				session()->setFlashdata('message', 'Wrong email or password!');
				session()->setFlashdata('alert-class', 'alert-danger');
			}
		}else {
				session()->setFlashdata('message', 'Wrong email or password!');
				session()->setFlashdata('alert-class', 'alert-danger');
			}
			return redirect()->to('/');
    }
	
	public function logout() {
		$array_items = ['uemail', 'uuid', 'uname', 'role'];
		$this->session->remove($array_items);
		session()->setFlashdata('message', 'Logged out successfully!');
		session()->setFlashdata('alert-class', 'alert-success');
		return redirect()->to('/');
	}

	public function switchbusiness()
	{
		$bid = $this->request->getPost('bid');
		session()->set('uuid_business', $bid);
	}
}
