<?php 
namespace App\Controllers; 
use App\Controllers\Core\CommonController; 
use App\Models\Purchase_orders_model;
use App\Models\Core\Common_model;

class Purchase_orders extends CommonController
{	
	
    function __construct()
    {
        parent::__construct();

        $this->purchase_orders_model = new Purchase_orders_model();

    }
    
    public function index()
    {        

        $data[$this->table] = $this->purchase_orders_model->getList();
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;

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
  public function getAdditionalData($id)
  {
    $model = new Common_model();
    $data["customers"] = $model->getAllDataFromTable("customers");

    return  $data;

}

public function update()
{        
    $id = $this->request->getPost('id');

    $data = $this->request->getPost();

    $data['start_date'] = strtotime($data['start_date']);
    $data['end_date'] = strtotime($data['end_date']);
    $data['payment_due_on'] = strtotime($data['payment_due_on']);
    $data['payment_made_date'] = strtotime($data['payment_made_date']);

    if(empty($id)){
        $data['purchase_order_no'] = findMaxFieldValue($this->table, "purchase_order_no");

        if(empty($data['purchase_order_no'])){
            $data['purchase_order_no'] = 1001;
        }else{
            $data['purchase_order_no'] += 1;
        }
    }

    if(isset($data['purchase_order_inactive']) &&  $data['purchase_order_inactive'] == "on"){
        $data['purchase_order_inactive'] = 1;
    }else{
        $data['purchase_order_inactive'] = 0;
    }

    if( isset($data['vat_charge']) && $data['vat_charge'] == "on"){
        $data['vat_charge'] = 1;
    }else{
        $data['vat_charge'] = 0;
    }


    $response = $this->model->insertOrUpdate($id, $data);
    if(!$response){
     session()->setFlashdata('message', 'Something wrong!');
     session()->setFlashdata('alert-class', 'alert-danger');	
 }

 return redirect()->to('/'.$this->table);
}
}