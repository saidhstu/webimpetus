<?php
namespace App\Controllers;
use App\Models\Service_model;
use App\Models\Tenant_model;
use App\Models\Domain_model;
use App\Models\Cat_model;
use App\Models\Content_model;
use App\Models\Enquiries_model;
use App\Models\Blocks_model;
use App\Models\Gallery_model;
use App\Models\Secret_model;
class Api extends BaseController
{
	public function __construct()
	{
	  $this->smodel = new Service_model();
	  $this->tmodel = new Tenant_model();
	  $this->dmodel = new Domain_model();
	  $this->catmodel = new Cat_model();
	  $this->cmodel = new Content_model();
	  $this->emodel = new Enquiries_model();
	  $this->bmodel = new Blocks_model();
	  $this->gmodel = new Gallery_model();
	  $this->sec_model = new Secret_model();
	  header('Content-Type: application/json; charset=utf-8');
	}
	
    public function index()
    {
        echo 'API ....';
    }
	
	public function services($id=false,$write=false)
    {
		if($this->request->getVar('q')){
			$data['data'] = $this->smodel->where(['status' => 1])->like('name', $this->request->getVar('q'))->get()->getResult();
		}else {
			//$data['data'] = ($id>0)?$this->smodel->getWhere(['id' => $id,'status' => 1])->getRow():$this->smodel->getApiRows();
			
			if($id>0){
				$data1 = $this->smodel->getRows($id)->getRow();
				$data1->domains = $this->dmodel->where(['sid' => $id])->get()->getResult();
			}else {
				$data1 = $this->smodel->getApiRows(); 				
			}			
			$data['data'] =$data1;
		}
		$data['status'] = 'success';
		if($write==true){
			return json_encode($data['data']);
		}else echo json_encode($data); die;
    }
	
	public function tenants($id=false)
    {
		if($this->request->getVar('q')){
			$data['data'] = $this->tmodel->like('name', $this->request->getVar('q'))->get()->getResult();
		}else {
			$data['data'] = ($id>0)?$this->tmodel->getRows($id)->getRow():$this->tmodel->getRows();
		}
		$data['status'] = 'success';
        echo json_encode($data); die;
    }
	
	public function domains($id=false)
    {
		if($this->request->getVar('q')){
			$data['data'] = $this->dmodel->like('name', $this->request->getVar('q'))->get()->getResult();
		}else {
			$data['data'] = ($id>0)?$this->dmodel->getRows($id)->getRow():$this->dmodel->getRows();
		}
		$data['status'] = 'success';
        echo json_encode($data); die;
    }
	
	public function categories($id=false)
    {
		if($this->request->getVar('q')){
			$data['data'] = $this->catmodel->like('name', $this->request->getVar('q'))->get()->getResult();
		}else {
			$data['data'] = ($id>0)?$this->catmodel->getRows($id)->getRow():$this->catmodel->getRows();
		}
		$data['status'] = 'success';
        echo json_encode($data); die;
    }
	
	public function templates($type=1,$id=false)
    {
		if($this->request->getVar('q')){
			$data['data'] = $this->cmodel->where(['status' => 1,'type'=>$type])->like('name', $this->request->getVar('q'))->get()->getResult();
		}else {
			$data['data'] = ($id>0)?$this->cmodel->getWhere(['status' => 1,'id' => $id,'type'=>$type])->getRow():$this->cmodel->where(['status' => 1,'type'=>$type])->get()->getResult();
		}
		$data['status'] = 'success';
        echo json_encode($data); die;
    }
	
	
	public function enquiries($type=1,$id=false)
    {
		if($this->request->getVar('q')){
			$data['data'] = $this->emodel->where(['type'=>$type])->like('name', $this->request->getVar('q'))->get()->getResult();
		}else {
			$data['data'] = ($id>0)?$this->emodel->getWhere(['id' => $id,'type'=>$type])->getRow():$this->emodel->where(['type'=>$type])->get()->getResult();
		}
		$data['status'] = 'success';
        echo json_encode($data); die;
    }
	
	public function blocks($id=false)
    {
		if($this->request->getVar('q')){
			$data['data'] = $this->bmodel->like('code', $this->request->getVar('q'))->get()->getResult();
		}else {
			$data['data'] = ($id>0)?$this->bmodel->getWhere(['id' => $id])->getRow():$this->bmodel->get()->getResult();
		}
		$data['status'] = 'success';
        echo json_encode($data); die;
    }
	
	public function media($id=false)
    {
		if($this->request->getVar('q')){
			$data['data'] = $this->gmodel->like('code', $this->request->getVar('q'))->get()->getResult();
		}else {
			$data['data'] = ($id>0)?$this->gmodel->getWhere(['id' => $id])->getRow():$this->gmodel->get()->getResult();
		}
		$data['status'] = 'success';
        echo json_encode($data); die;
    }
	
	
	public function secrets($id=false)
    {
		if($this->request->getVar('q')){
			$data['data'] = $this->sec_model->like('key_name', $this->request->getVar('q'))->get()->getResult();
		}else {
			$data['data'] = ($id>0)?$this->sec_model->getWhere(['id' => $id])->getRow():$this->sec_model->get()->getResult();
		}
		$data['status'] = 'success';
        echo json_encode($data); die;
    }
	
}
