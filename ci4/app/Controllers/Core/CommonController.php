<?php

namespace App\Controllers\Core;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\Core\Common_model;
use App\Models\Amazon_s3_model;

use App\Models\Users_model;
use PHPUnit\Framework\Constraint\FileExists;

class CommonController extends BaseController
{
	protected $table;
	protected $model;
	protected $businessUuid;
	protected $notAllowedFields = array();

	function __construct()
	{
		parent::__construct();

		$this->businessUuid = session('uuid_business');
		$this->whereCond['uuid_business_id'] = $this->businessUuid;

		$this->model = new Common_model();
		$this->Amazon_s3_model = new Amazon_s3_model();


		$this->table = $this->getTableNameFromUri();
		$this->rawTblName =  substr($this->table, 0, -1);
		if (isset($_GET['cat']) && $_GET['cat'] == 'strategies') {

			$this->menucode = $this->getMenuCode("/" . $this->table . "?cat=strategies");
		} else {
			$this->menucode = $this->getMenuCode("/" . $this->table);
		}


		$this->session->set("menucode", $this->menucode);
		$this->notAllowedFields = array('uuid_business_id', "uuid");
	}

	public function getTableNameFromUri()
	{

		$uri = service('uri');
		$tableNameFromUri = $uri->getSegment(1);
		return $tableNameFromUri;
	}

	public function index()
	{

		$data['columns'] = $this->db->getFieldNames($this->table);
		$data['fields'] = array_diff($data['columns'], $this->notAllowedFields);
		$data[$this->table] = $this->model->getRows();
		$data['tableName'] = $this->table;
		$data['rawTblName'] = $this->rawTblName;
		$data['is_add_permission'] = 1;
		$data['identifierKey'] = 'id';

		$viewPath = "common/list";
		if (file_exists(APPPATH . 'Views/' . $this->table . "/list.php")) {
			$viewPath = $this->table . "/list";
		}

		return view($viewPath, $data);
	}


	public function edit($id = 0)
	{
		$data['tableName'] = $this->table;
		$data['rawTblName'] = $this->rawTblName;
		$data["users"] = $this->model->getUser();
		$data[$this->rawTblName] = $this->model->getRows($id)->getRow();
		// if there any special cause we can overried this function and pass data to add or edit view
		$data['additional_data'] = $this->getAdditionalData($id);

		echo view($this->table . "/edit", $data);
	}

	public function update()
	{
		$id = $this->request->getPost('id');

		$data = $this->request->getPost();
		$response = $this->model->insertOrUpdate($id, $data);
		if (!$response) {
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');
		}

		return redirect()->to('/' . $this->table);
	}

	public function deleteImage($id)
	{
		if (!empty($id)) {
			$data['image_logo'] = null;
			$response = $this->Amazon_s3_model->deleteFileFromS3($this->table, "image_logo");
			$this->model->updateColumn($this->table, $id, $data);

			if ($response) {
				session()->setFlashdata('message', 'Image deleted Successfully!');
				session()->setFlashdata('alert-class', 'alert-success');
			} else {
				session()->setFlashdata('message', 'Something wrong!');
				session()->setFlashdata('alert-class', 'alert-danger');
			}
		}
		return redirect()->to('/' . $this->table . '/edit/' . $id);
	}

	public function delete($id)
	{
		//echo $id; die;
		if (!empty($id)) {
			$response = $this->model->deleteData($id);
			if ($response) {
				session()->setFlashdata('message', 'Data deleted Successfully!');
				session()->setFlashdata('alert-class', 'alert-success');
			} else {
				session()->setFlashdata('message', 'Something wrong delete failed!');
				session()->setFlashdata('alert-class', 'alert-danger');
			}
		}

		return redirect()->to('/' . $this->table);
	}

	// 
	public function status()
	{
		if (!empty($id = $this->request->getPost('id'))) {
			$data = array(
				'status' => $this->request->getPost('status')
			);
			$this->model->updateData($id, $data);
		}
		echo '1';
	}



	// only call if there additional data needed on edit view
	public function getAdditionalData($id)
	{
	}

	public function upload($filename = null)
	{
		//echo $filename; die;
		$input = $this->validate([
			$filename => "uploaded[$filename]|max_size[$filename,1024]|ext_in[$filename,jpg,png,jpeg,docx,pdf],"
		]);

		if (!$input) { // Not valid
			return '';
		} else { // Valid

			if ($file = $this->request->getFile($filename)) {
				if ($file->isValid() && !$file->hasMoved()) {
					// Get file name and extension
					$name = $file->getName();
					$ext = $file->getClientExtension();

					// Get random file name
					$newName = $file->getRandomName();

					// Store file in public/uploads/ folder
					$file->move('../public/ckfinder/userfiles/files/', $newName);

					// File path to display preview
					return $filepath = base_url() . "/ckfinder/userfiles/files/" . $newName;
				}
			}
		}
	}

	public function getMenuCode($link)
	{

		return $this->model->getMenuCode($link);
	}


	public function uploadMediaFiles()
	{

		$folder = $this->request->getPost("mainTable");

		$response = $this->Amazon_s3_model->doUpload("file", $folder);

		if ($response["status"]) {

			$id = 0;
			$file_path = $response['filePath'];
			$status = 1;


			if (file_exists(APPPATH . "Views/" . $this->table . "/uploadedFileView.php")) {

				$file_views = view($this->table . "/uploadedFileView", array("file_path" => $file_path, "id" => $id));
			} else {

				$file_views = view("common/uploadedFileView", array("file_path" => $file_path, "id" => $id));
			}
			$msg = "success";
		} else {
			$status = 0;
			$file_views = '';
			$msg = "error";
		}

		echo json_encode(array("status" => $status, "file_path" => $file_views, "msg" => $msg));
	}


	public function exportPDF($id = 0)
	{
		$mpdf = new \App\Libraries\Generate_Pdf();
		$pdf = $mpdf->load_portait();
		$uuid_business_id = $this->session->get('uuid_business');

		$pdf_template_code = 'timeslip_export_pdf';
		$pdf_template_id = 0;

		if (!empty($id) && ($this->table == 'sales_invoices' || $this->table == 'purchase_invoices' || $this->table == 'purchase_orders' || $this->table == 'work_orders')) {

			$item_details = $this->getInvoiceItem($id);

			if ($this->table == 'sales_invoices') {
				$pdf_template_id = $item_details->print_template_code;
			} else if ($this->table == 'purchase_invoices') {
				$pdf_template_id = $item_details->print_template_code;
			} else if ($this->table == 'purchase_orders') {
				$pdf_template_id = $item_details->template;
			} else if ($this->table == 'work_orders') {
				$pdf_template_id = $item_details->template;
			}

			$pdf->AddPage(
				'', // L - landscape, P - portrait
				'',
				'',
				'',
				'',
				15, // margin_left
				15, // margin right
				10, // margin top
				15, // margin bottom
				8, // margin header
				1, // margin footer
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'',
				'A4-P'
			);
		}


		//Find the template contenet and then search block by code

		if ($this->table == 'timeslips') {
			$templates = $this->db->table('templates')->where("uuid_business_id", $uuid_business_id)->where('code', $pdf_template_code)->get()->getResultArray();
		} else {
			$templates = $this->db->table('templates')->where("uuid_business_id", $uuid_business_id)->where('id', $pdf_template_id)->get()->getResultArray();
		}

		$template_html = "";
		if ($templates) {
			foreach ($templates as $template) {
				$template_contents = explode('<*--', $template['template_content']);
				foreach ($template_contents as $template_content) {
					$block_code = trim(str_replace('--*>', '', $template_content));
					if (!empty($block_code)) {
						$blocks_list = $this->db->table('blocks_list')->where("uuid_business_id", $uuid_business_id)->where('code', $block_code)->get()->getResultArray();
						foreach ($blocks_list as $block) {
							$block_text = $block['text'];

							// Load Header Data
							if (strpos($block_text, 'loadTimeslipData();') !== false) {
								$template_html .= $this->loadTimeslipData();
								$block_text = str_replace('loadTimeslipData();', '', $block_text);
							}

							// Load Footer Data
							if (strpos($block_text, 'displayTimeslipFooter();') !== false) {
								$pdf->SetHTMLFooter($this->displayTimeslipFooter());
								$block_text = str_replace('displayTimeslipFooter();', '', $block_text);
							}

							// Load Body Data With Dynamic Content
							if (strpos($block_text, 'displayTimeslipItem();') !== false) {
								if ($this->table == 'timeslips') {
									$template_html .= $this->displayTimeslipItem($_POST);
								} else if ($this->table == 'sales_invoices' || $this->table == 'purchase_invoices' || $this->table == 'purchase_orders' || $this->table == 'work_orders') {
									$template_html .= $this->displayInvoiceItem($id);
								}
								$block_text = str_replace('displayTimeslipItem();', '', $block_text);
							}
							$template_html .= $block_text;
						}
					}
				}
			}
		}

		$DYNAMIC_SCRIPTS_PATH = getenv('DYNAMIC_SCRIPTS_PATH');
		if(empty($DYNAMIC_SCRIPTS_PATH)){
			$DYNAMIC_SCRIPTS_PATH = '/tmp';
		}
		$pdf_path = $DYNAMIC_SCRIPTS_PATH . '/' . $this->table;
		if (!file_exists($pdf_path)) {
			mkdir($pdf_path, 0755, true);
		}
		file_put_contents($pdf_path . "/dynamic_body.php", $template_html);
		ob_start();
		include($pdf_path . "/dynamic_body.php");
		$html = ob_get_contents();
		ob_end_clean();

		$pdf->WriteHTML($html);
		$pdf->Output($this->table . ".pdf", "D");
	}


	public function loadTimeslipData()
	{
		if ($this->table == 'timeslips') {
			return view("timeslips/pdf_header");
		} else if ($this->table == 'sales_invoices' || $this->table == 'purchase_invoices' || $this->table == 'purchase_orders' || $this->table == 'work_orders') {
			return view("sales_invoices/pdf_header");
		}
		return;
	}

	public function displayTimeslipFooter()
	{
		return view("timeslips/pdf_footer");
	}

	public function displayTimeslipItem($post_data)
	{
		$employeeData = $this->db->table('employees')->select('*')->getWhere(array('id' => 4))->getFirstRow();
		// generate the PDF!
		$viewArray["timeslips"] = $this->loadTimeslipItem($post_data);
		$viewArray["employeeData"] = $employeeData;

		return view("timeslips/pdf_body", $viewArray);
	}

	public function loadTimeslipItem($post_data)
	{
		$employee_id = $post_data["employee"];
		$requestMonth = $post_data["monthpicker"];
		$year = $_POST["yearpicker"];

		$builder = $this->db->table("timeslips");

		$firstDayOfCurrentMonth = strtotime($this->firstDay($requestMonth,  $year));

		$lastDayMonth = strtotime($this->lastday($requestMonth,  $year)); // hard-coded '01' for first day

		$builder->select("timeslips.*, tasks.name as tasks_name, employees.first_name as employee_first_name, employees.surname as employee_surname");
		$builder->join("tasks", "tasks.id = timeslips.task_name", "left");
		$builder->join("employees", "employees.id = timeslips.employee_name", "left");

		if ($employee_id != "-1") {
			$builder->where("timeslips.employee_name", $employee_id);
		}

		$builder->where("timeslips.slip_start_date >=", $firstDayOfCurrentMonth);
		$builder->where("timeslips.slip_start_date <=", $lastDayMonth);
		$records = $builder->get()->getResultArray();
		return $records;
	}

	function firstDay($month = '', $year = '')
	{
		if (empty($month)) {
			$month = date('m');
		}
		if (empty($year)) {
			$year = date('Y');
		}
		$result = strtotime("{$year}-{$month}-01");
		return date('Y-m-d', $result);
	}

	function lastday($month = '', $year = '')
	{
		if (empty($month)) {
			$month = date('m');
		}
		if (empty($year)) {
			$year = date('Y');
		}
		$result = strtotime("{$year}-{$month}-01");
		$result = strtotime('-1 second', strtotime('+1 month', $result));
		return date('Y-m-d', $result);
	}

	function displayInvoiceItem($id)
	{
		$viewArray["sales_invoice"] = $this->getInvoiceItem($id);
		return view($this->table . "/pdf_item", $viewArray);
	}

	function getInvoiceItem($id)
	{
		$builder = $this->db->table($this->table);
		$builder->where('id', $id);
		$records = $builder->get()->getRowArray();
		return (object)$records;
	}
}
