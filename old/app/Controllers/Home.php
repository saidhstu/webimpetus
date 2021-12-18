<?php
namespace App\Controllers;
use App\Models\Users_model;
use App\Models\Meta_model;
class Home extends BaseController
{
	public function __construct()
	{
		$this->session = \Config\Services::session();
	  $this->model = new Users_model();
	  $this->meta_model = new Meta_model();
	}
	
    public function index()
    {
		if($this->session->get('uuid')){
		  return redirect()->to('/dashboard');
	  }
	  $data['logo'] = $this->meta_model->getWhere(['meta_key' => 'site_logo'])->getRow();
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
				$this->session->set('uemail',$row->email);
				$this->session->set('uuid',$row->id);
				$this->session->set('uname',$row->name);
				$this->session->set('role',$row->role);
				$this->session->set('logo',$logo->meta_value);
				return redirect()->to('/dashboard');
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
}
