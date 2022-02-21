<?php 
namespace App\Controllers; 
use App\Controllers\Core\CommonController; 
use App\Models\sales_invoice_model;
 ini_set("display errors", 1);
class Sales_invoices extends CommonController
{	
	
    function __construct()
    {
        parent::__construct();

        $this->si_model = new sales_invoice_model();

        $this->sales_invoice_items = "sales_invoice_items";
        $this->sales_invoice_notes = "sales_invoice_notes";
        $this->sales_invoices = "sales_invoices";
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

    public function removeInvoiceItem(){

        $id = $this->request->getPost('id');
        $mainTableId = $this->request->getPost('mainTableId');

        if( $id > 0){

            $this->model->deleteTableData( $this->sales_invoice_items, $id);
            $response['status'] = true;
        }

        echo json_encode($response);

    }
    public function updateInvoice(){

        $mainTableId = $this->request->getPost('mainTableId');
        $data['balance_due'] = $this->request->getPost('totalAmountWithTax');
        $data['total'] = $this->request->getPost('totalAmountWithTax');
        $data['total_due_with_tax'] = $this->request->getPost('totalAmountWithTax');
        $data['total_hours'] = $this->request->getPost('totalHour');
        $data['total_due'] = $this->request->getPost('totalAmount');
        $data['total_tax'] = $this->request->getPost('total_tax');

        $res = $this->model->updateTableData($mainTableId, $data, $this->sales_invoices);

        $response['status'] = true;
        $response['msg'] = "Data updated successfully";
        $response['status'] = true;
        $response['data'] = $res;

        echo json_encode($response);

    }
    public function saveNotes(){

        $id = $this->request->getPost('id');
        $data['notes'] = $this->request->getPost('notes');
        $data['sales_invoices_id'] = $this->request->getPost('mainTableId');
     
        if( $id > 0){

            $res = $this->model->updateTableData($id, $data, $this->sales_invoice_notes);
        }else{

            $data['created_by'] = $_SESSION['uuid'];
            $id = $this->model->insertTableData($data, $this->sales_invoice_notes);
        }

        $response['name'] = getUserInfo()->name;
        $response['status'] = true;
        $response['msg'] = "Data updated successfully";
        $response['data'] = getRowArray($this->sales_invoice_notes, ["id" => $id]);

        echo json_encode($response);
    }
    public function addInvoiceItem(){

        $id = $this->request->getPost('id');
        $mainTableId = $this->request->getPost('mainTableId');
        $data['description'] = $this->request->getPost('description');
        $data['rate'] = $this->request->getPost('rate');
        $data['hours'] = $this->request->getPost('hours');
        $data['amount'] = $data['rate'] * $data['hours'];

// echo $this->sales_invoice_items;die;

        if( $id > 0){

            $this->model->updateTableData($id, $data, $this->sales_invoice_items);
            $response['status'] = true;
        }else{

            $data['sales_invoices_id'] = $mainTableId;
            $id = $this->model->insertTableData( $data, $this->sales_invoice_items);

            if( $id > 0){
                $response['msg'] = "Data added successfully";
                $response['status'] = true;
            }else{
                $response['msg'] = "Data insertion failed";
                $response['status'] = false;
            }
        }

        $response['data'] = getRowArray( $this->sales_invoice_items, ["id" => $id]);

        echo json_encode($response);

    }

    public function deleteNote(){

        $id = $this->request->getPost('id');
        $res = $this->model->deleteTableData($this->sales_invoice_notes, $id);

        $response['id'] = $id;
        if($res){

            $response['status'] = true;
            $response['msg'] = "Data deleted successfully";
        }else{
            $response['status'] = false;
            $response['msg'] = "Failed";
        }
        

        echo json_encode($response);
    }
}