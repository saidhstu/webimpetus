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
use App\Models\Documents_model;
use App\Models\Customers_model;
use App\Models\WebpageCategory;
use App\Models\CustomerCategory;
use App\Models\Email_model;

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
	  $this->documents_model = new Documents_model();
	  $this->customer_model = new Customers_model();
	  $this->webCategory_model = new WebpageCategory();
	  $this->cusCategory_model = new CustomerCategory();
	  $this->emailModel = new Email_model();

	  header('Content-Type: application/json; charset=utf-8');
	  // header('Access-Control-Allow-Origin: *');
	  // header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
	  //header('Access-Control-Allow-Headers: Accept,Authorization,Content-Type');
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

	public function webpages($customer_id=false){

		$categories=$this->cusCategory_model->where('customer_id',$customer_id)->get()->getResult();

		$categoriesId=[];
		foreach($categories as $row)
		{
			$categoriesId[$row->categories_id]=$row->categories_id;
		}
		$webPagesId=[];
		if(count($categoriesId))
		{
			$webPages = $this->webCategory_model->whereIn('categories_id',$categoriesId)->get()->getResult();
			foreach($webPages as $row)
			{
				$webPagesId[$row->webpage_id]=$row->webpage_id;
			}
		}
		if(count($webPagesId))
		{
			$webpages = $this->cmodel->where("status", 1)->whereIn('id', $webPagesId)->get()->getResult();

			if( $webpages ){
				$webPageList = [];
				foreach($webpages as $key => $eachPage){
					$eachPage->contacts = $this->getContacts(@$eachPage->id);
					$webPageList[$key] = $eachPage;
					
				}
				
				$data['data'] = $webPageList;
				$data['status'] = 'success';
			}else{

				$data['status'] = 'error';
			}
		}
		else{
			$data['status'] = 'error';
		}
		
		echo json_encode($data); die;
	}

	public function getContacts( $id){
		$blocks = $this->bmodel->where(["webpages_id" => $id])->get()->getResult();
		return $blocks;
	}
	
	public function webpagesEdit($id=false){

		if( strlen($id) > 0){
			$webpages = $this->cmodel->where(["id" => $id])->get()->getResult();
			$blocks = $this->bmodel->where(["webpages_id" => $id])->get()->getResult();

			$webPageList = [];
			$blockList = [];
			foreach($blocks as $eachBlock){

				if( $eachBlock->webpages_id > 0){

					$blockList[$eachBlock->webpages_id][] = $eachBlock;
				}
			}
			
			foreach($webpages as $key => $eachPage){

				$webPageList[$key] = $eachPage;
				$webPageList[$key]->blockList = @$blockList[$eachPage->id];
				
			}
			
			$data['data'] = $webPageList;
			$data['status'] = 'success';
		}else{

			$data['status'] = 'error';
			$data['status'] = 'Id is missing';
		}
		echo json_encode($data); die;
	}

	public function getDocument($id=false){

		if( strlen($id) > 0){
			$documents = $this->documents_model->where(["id" => $id])->get()->getResult();
			
		}else{
			$documents = $this->documents_model->get()->getResult();
		}
		$documentList = [];	
		foreach($documents as $key => $eachPage){
			$documentList[$key] = $eachPage;
		}
		
		$data['data'] = $documentList;
		$data['status'] = 'success';
		echo json_encode($data); die;
	}


	public function sendEmail(){

		$name = $this->request->getVar('name');
		$ccEmail = $this->request->getVar('email');
		if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
			$data['status'] = 'error';
			$data['msg']    = 'Please Enter a valid email!';
			echo json_encode($data); die;
		}

		$message = $this->request->getVar('message');
		$organisation = $this->request->getVar('organisation');
		
		$phone = $this->request->getVar('phone');

		if (strlen(trim($message)) < 1) {
	
			$message    = 'Email Sent by user '.$name."<br> Phone ".$phone. "<br> Organization :".$organisation;
			echo json_encode($data); die;
		}


		$uuid_business_id = $this->request->getVar('uuid_business_id') ? $this->request->getVar('uuid_business_id') : 6;
		$subject = "Odin contact email";
		$name = $name ? $name : "";

		$from_email = "info@odincm.com";
		$is_send = $this->emailModel->send_mail($from_email, $name, $from_email, $message, $subject, [], "", $ccEmail);
		if($is_send){
			$data['status'] = 'success';
			$data['msg']    = 'Email send successfully!';

			$insertArray["uuid_business_id"] = $uuid_business_id;
			$insertArray["name"] = $name;
			$insertArray["email"] = $ccEmail;
			$insertArray["phone"] = $phone;
			$insertArray["message"] = $message;
			$insertArray["type"] = 1;

			$this->emodel->saveData($insertArray);
			
		}else{
			$data['status'] = 'error';
			$data['msg']    = 'Email send failed!';
		}
	
		echo json_encode($data); die;
	}
	
	
}
