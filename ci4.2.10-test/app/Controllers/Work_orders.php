<?php 
namespace App\Controllers; 
use App\Controllers\Core\CommonController;
use App\Libraries\UUID;
use App\Models\Core\Common_model;
use App\Models\Work_orders_model;
use stdClass;

 ini_set("display errors", 1);
class Work_orders extends CommonController
{	
	
    function __construct()
    {
        parent::__construct();

        $this->work_orders_model = new Work_orders_model();

        $this->work_order_items = "work_order_items";
        $this->work_order_notes = "work_order_notes";
        $this->work_orders = "work_orders";
	}
    
    public function index()
    {        

        $data[$this->table] = $this->work_orders_model->getOrder();
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

    public function edit($id = 0)
    {
		$data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
		$data["users"] = $this->model->getUser();
		$data[$this->rawTblName] = $this->model->getRows($id)->getRow();
        if (empty($id)) {
            if (empty($data[$this->rawTblName])) {
                $data[$this->rawTblName] = new stdClass();
            }
            $data[$this->rawTblName]->date = time();
        }
		// if there any special cause we can overried this function and pass data to add or edit view
		$data['additional_data'] = $this->getAdditionalData($id);

        echo view($this->table."/edit",$data);
    }

    public function update()
    {        
        $id = $this->request->getPost('id');

		$data = $this->request->getPost();
        $itemIds = @$data['item_id'];
        unset($data['item_id']);

        // $data['due_date'] = strtotime($data['due_date']);
        $data['date'] = strtotime($data['date']);
        if(empty($id)){
            $data['order_number'] = findMaxFieldValue($this->work_orders, "order_number");

            if(empty($data['order_number'])){
                $data['order_number'] = 1001;
            }else{
                $data['order_number'] += 1;
            }

            $data['custom_order_number'] = $data['custom_order_number'] . $data['order_number'];
        }
        
        $data['is_locked'] = isset($data['is_locked']) ? 1 : 0;
		$response = $this->model->insertOrUpdate($id, $data);
		if(!$response){
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');	
		} else {

            $id = $response;
            if($itemIds){
                foreach ($itemIds as $itemId) {

                    $this->db->table($this->work_order_items)->where('id', $itemId)->update(array(
                        'work_orders_id' => $id,
                    ));
                }
            }
           
        }

        return redirect()->to('/'.$this->table);
    }

    public function removeInvoiceItem(){

        $id = $this->request->getPost('id');
        $mainTableId = $this->request->getPost('mainTableId');

        if( $id > 0){

            $this->model->deleteTableData( $this->work_order_items, $id);
            $response['status'] = true;
        }

        echo json_encode($response);

    }
    public function updateInvoice(){

        $mainTableId = $this->request->getPost('mainTableId');
        $data['balance_due'] = $this->request->getPost('totalAmountWithTax');
        $data['total'] = $this->request->getPost('totalAmountWithTax');
        $data['total_due_with_tax'] = $this->request->getPost('totalAmountWithTax');
        $data['total_qty'] = $this->request->getPost('totalQty');
        $data['total_due'] = $this->request->getPost('totalAmount');
        $data['total_tax'] = $this->request->getPost('total_tax');
        $data['discount'] = $this->request->getPost('discount');
        $data['subtotal'] = $this->request->getPost('subtotal');

        $res = $this->model->updateTableData($mainTableId, $data, $this->work_orders);

        $response['status'] = true;
        $response['msg'] = "Data updated successfully";
        $response['status'] = true;
        $response['data'] = $res;

        echo json_encode($response);

    }
    public function saveNotes(){

        $id = $this->request->getPost('id');
        $data['notes'] = $this->request->getPost('notes');
        $data['work_orderss_id'] = $this->request->getPost('mainTableId');
     
        if( $id > 0){

            $res = $this->model->updateTableData($id, $data, $this->work_orders_notes);
        }else{

            $data['created_by'] = $_SESSION['uuid'];
            $id = $this->model->insertTableData($data, $this->work_orders_notes);
        }

        $response['name'] = getUserInfo()->name;
        $response['status'] = true;
        $response['msg'] = "Data updated successfully";
        $response['data'] = getRowArray($this->work_orders_notes, ["id" => $id]);

        echo json_encode($response);
    }
    public function addInvoiceItem(){

        $id = $this->request->getPost('id');
        $mainTableId = $this->request->getPost('mainTableId');
        $data['uuid_business_id'] = session('uuid_business');
        $data['description'] = $this->request->getPost('description');
        $data['rate'] = $this->request->getPost('rate');
        $data['qty'] = $this->request->getPost('qty');
        $data['discount'] = $this->request->getPost('discount');
        $data['amount'] = $data['rate'] * $data['qty'];

        if( $data['discount'] > 0){
            $discount = ( $data['amount'] / 100 ) * $data['discount'];

            $data['amount'] = $data['amount'] - $discount;
        }
        

// echo $this->work_order_items;die;

        if( $id > 0){

            $this->model->updateTableData($id, $data, $this->work_order_items);
            $response['status'] = true;
        }else{

            $data['work_orders_id'] = $mainTableId;
            $data['uuid'] = UUID::v5(UUID::v4(), 'work_order_items');
            $id = $this->model->insertTableData( $data, $this->work_order_items);

            if( $id > 0){
                $response['msg'] = "Data added successfully";
                $response['status'] = true;
            }else{
                $response['msg'] = "Data insertion failed";
                $response['status'] = false;
            }
        }

        $response['data'] = getRowArray( $this->work_order_items, ["id" => $id]);

        echo json_encode($response);

    }

    public function deleteNote(){

        $id = $this->request->getPost('id');
        $res = $this->model->deleteTableData($this->work_orders_notes, $id);

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

    public function loadBillToData()
    {
        $clientId = $this->request->getPost('clientId');
        $commonModel = new Common_model();
        $response = $commonModel->loadBillToData($clientId);
        echo json_encode($response);
    }
}