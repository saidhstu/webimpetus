<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Users_model;
 
class Users extends Controller
{
	
	public function __construct()
	{
		$this->session = \Config\Services::session();
	  $this->model = new Users_model();
	}
    public function index()
    {        
        $data['users'] = $this->model->getUser();
		//echo '<pre>';print_r($data['users']); die;
        echo view('users',$data);
    }
	
	public function add()
    {
        echo view('add_user');
    }
 
    public function saveuser()
    {        
		//echo '<pre>';print_r($this->request->getPost('name')); die;        
		if(!empty($this->request->getPost('email'))){		

			$count = $this->model->getWhere(['email' => $this->request->getPost('email')])->getNumRows();
			if(!empty($count)){
				session()->setFlashdata('message', 'Email already exist!');
				session()->setFlashdata('alert-class', 'alert-danger');
				return redirect()->to('/users/add');
			}else {
				$data = array(
					'name'  => $this->request->getPost('name'),
					'email' => $this->request->getPost('email'),
					'password' => md5($this->request->getPost('password')),
					'address' => $this->request->getPost('address'),
					'notes' => $this->request->getPost('notes'),
					'uuid' => mt_rand(10000, 100000),
					'status' => 0,
				);
				$this->model->saveUser($data);
				session()->setFlashdata('message', 'Data entered Successfully!');
				session()->setFlashdata('alert-class', 'alert-success');
			}
		}
        return redirect()->to('/users');
    }
	
	 public function edit($id)
    {        
        $data['user'] = $this->model->getUser($id)->getRow();
        echo view('edit_user', $data);
    }
	
    public function update()
    {        
        $id = $this->request->getPost('id');
		
		$count = $this->model->getWhere(['email' => $this->request->getPost('email'), 'id!=' => $id])->getNumRows();
			if(!empty($count)){
				session()->setFlashdata('message', 'Email already exist!');
				session()->setFlashdata('alert-class', 'alert-danger');
				return redirect()->to('/users/edit/'.$id);
			}else {
        $data = array(
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
			'address' => $this->request->getPost('address'),
			'notes' => $this->request->getPost('notes')
        );
        $this->model->updateUser($data, $id);
		session()->setFlashdata('message', 'Data updated Successfully!');
		session()->setFlashdata('alert-class', 'alert-success');
		
		
			}
        return redirect()->to('/users');
    }
	
	public function savepwd()
    {
		if(!empty($this->request->getPost('id')) && !empty($this->request->getPost('npassword')) && $this->request->getPost('npassword') == $this->request->getPost('cpassword') ){			
			$data = array(					
				'password' => md5($this->request->getPost('npassword'))					
			);
			$this->model->updateUser($data, $this->request->getPost('id'));
			session()->setFlashdata('message', 'Password changed Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');			
		}
        return redirect()->to('/users');
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
        if(!empty($id)) {
			$this->model->deleteUser($id);
			session()->setFlashdata('message', 'Data deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}
		
        return redirect()->to('/users');
    }
}