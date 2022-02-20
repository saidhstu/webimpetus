<?php 
namespace App\Controllers; 
use App\Controllers\Core\CommonController; 
use App\Models\sales_invoice_model;
 
class Sales_invoices extends CommonController
{	
	
    function __construct()
    {
        parent::__construct();

        $this->si_model = new sales_invoice_model();

	}
    
    public function index()
    {        

        $data[$this->table] = $this->si_model->getInvoice();
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;

        echo view($this->table."/list",$data);
    }
    // public function edit($id = 0)
    // {
	// 	$data['tableName'] = $this->table;
    //     $data['rawTblName'] = $this->rawTblName;
	// 	$data["users"] = $this->model->getUser();
	// 	$data[$this->rawTblName] = $this->model->getRows($id)->getRow();
	// 	// if there any special cause we can overried this function and pass data to add or edit view
	// 	$data['additional_data'] = $this->getAdditionalData($id);

    //     echo view($this->table."/edit",$data);
    // }
    // public function getAdditionalData($id)
    // {
    //     $model = new Common_model();
    //     $data["customers"] = $model->getAllDataFromTable("customers");

    //     return  $data;

    // }

    public function update()
    {        
        $id = $this->request->getPost('id');

		$data = $this->request->getPost();

        $data['due_date'] = strtotime($data['due_date']);
        $data['date'] = strtotime($data['date']);
    //  prd($data);
     
		$response = $this->model->insertOrUpdate($id, $data);
		if(!$response){
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');	
		}

        return redirect()->to('/'.$this->table);
    }
}