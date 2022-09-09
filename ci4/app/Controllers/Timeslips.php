<?php

namespace App\Controllers;

use App\Controllers\Core\CommonController;
use App\Libraries\UUID;
use App\Models\TimeslipsModel;

class Timeslips extends CommonController
{
    protected $timeSlipsModel;

    public function __construct()
    {
        parent::__construct();
        $this->timeSlipsModel = new TimeslipsModel();
    }

    public function index()
    {        
        
        $data['columns'] = $this->db->getFieldNames($this->table);
        $data['fields'] = array_diff($data['columns'], $this->notAllowedFields);
        $data[$this->table] = $this->timeSlipsModel->getRows();
        foreach ($data[$this->table] as &$record) {
            $record['slip_start_date'] = render_date($record['slip_start_date']);
            $record['slip_end_date'] = render_date($record['slip_end_date']);
        }
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;
        $data['identifierKey'] = 'uuid';
        $data["employees"] = $this->timeSlipsModel->getEmployeesData();

        $viewPath = "timeslips/list";
    //    Saidur/BW removed on 13 Aug 2022 as it caused pdf not to work if (file_exists( APPPATH . $this->table."/list")) {
    //        $viewPath = $this->table."/list";
    //    }

       return view($viewPath, $data);
   }

   public function edit($uuid = null)
   {
      $data['tableName'] = $this->table;
      $data['rawTblName'] = $this->rawTblName;
      $data['actionUrl'] = base_url($this->table . '/save/' . $uuid);
      $data["tasks"] = $this->timeSlipsModel->getTaskData();
      $data["employees"] = $this->timeSlipsModel->getEmployeesData();
      $data[$this->table] = $this->timeSlipsModel->getSingleData($uuid);

      return view($this->table."/edit",$data);
  }

  public function save($uuid = null)
  {
      $data['tableName'] = $this->table;
      $data['rawTblName'] = $this->rawTblName;
      $uuidVal = null;
      if (empty($uuid)) {
        $uuidVal = UUID::v5(UUID::v4(), 'timeslips_saving');
    }
    $slipStartDate = strtotime( $this->request->getPost('slip_start_date') );
    $slipStartDate = $slipStartDate ? $slipStartDate : null;
    $slipEndDate = strtotime( $this->request->getPost('slip_end_date') );
    $slipEndDate = $slipEndDate ? $slipEndDate : null;
    $data = array(
        'task_name' => $this->request->getPost('task_name'),
        'week_no' => $this->request->getPost('week_no'),
        'employee_name' => $this->request->getPost('employee_name'),
        'slip_start_date' => $slipStartDate,
        'slip_timer_started' => $this->request->getPost('slip_timer_started'),
        'slip_end_date' => $slipEndDate,
        'slip_timer_end' => $this->request->getPost('slip_timer_end'),
        'break_time' => $this->request->getPost('break_time') === "on" ? 1: 0,
        'break_time_start' => $this->request->getPost('break_time_start'),
        'break_time_end' => $this->request->getPost('break_time_end'),
        'slip_hours' => $this->request->getPost('slip_hours'),
        'slip_description' => $this->request->getPost('slip_description'),
        'slip_rate' => $this->request->getPost('slip_rate'),
        'slip_timer_accumulated_seconds' => $this->request->getPost('slip_timer_accumulated_seconds'),
        'billing_status' => $this->request->getPost('billing_status'),
        'uuid_business_id' => $this->session->get('uuid_business'),
        'uuid' => $uuidVal,
    );

    $this->timeSlipsModel->saveByUuid($uuid, $data);
    if (empty($uuidVal)) {
        session()->setFlashdata('message', 'Data inserted Successfully!');
    } else {
        session()->setFlashdata('message', 'Data updated Successfully!');
    }

    session()->setFlashdata('alert-class', 'alert-success');

    return redirect()->to('/timeslips');
}

public function delete($uuid)
{
    if(!empty($uuid)) {
       $response = $this->timeSlipsModel->deleteData($uuid);		
       if($response){
        session()->setFlashdata('message', 'Data deleted Successfully!');
        session()->setFlashdata('alert-class', 'alert-success');
    }else{
        session()->setFlashdata('message', 'Something wrong delete failed!');
        session()->setFlashdata('alert-class', 'alert-danger');		
    }

}

return redirect()->to('/'.$this->table);
}

public function savecalenderevent()
{
    $data['tableName'] = $this->table;
    $data['rawTblName'] = $this->rawTblName;
    $uuid = UUID::v5(UUID::v4(), 'timeslips_event_saving_from_calendar');
    $currentDate = changeDateFormat($this->request->getPost('date'));
    $sTime = $this->request->getPost('s_time');
    $eTime = $this->request->getPost('e_time');
    $slipStartDate = strtotime( $currentDate . ' ' . $sTime );
    $slipStartDate = $slipStartDate ? $slipStartDate : null;
    $slipEndDate = strtotime( $currentDate . ' ' . $eTime );
    $slipEndDate = $slipEndDate ? $slipEndDate : null;
    $data = array(
        'task_name' => $this->request->getPost('task_id'),
        'employee_name' => $this->request->getPost('emp_id'),
        'slip_start_date' => $slipStartDate,
        'slip_timer_started' => $sTime,
        'slip_end_date' => $slipEndDate,
        'slip_timer_end' => $eTime,
        'slip_description' => $this->request->getPost('descr'),
        'uuid_business_id' => $this->session->get('uuid_business'),
        'uuid' => $uuid,
    );

    $this->timeSlipsModel->saveByUuid(null, $data);

    $currentDateMonth = render_date(strtotime($currentDate), "", "d-M");
    $taskData = $this->db->table('tasks')->select('name')->getWhere(array('id' => $data['task_name'], 'uuid_business_id' => $this->businessUuid))->getFirstRow();
    $employeeData = $this->db->table('employees')->select('CONCAT_WS(" ", saludation, first_name, surname) as name')->getWhere(array('id' => $data['employee_name'], 'uuid_business_id' => $this->businessUuid))->getFirstRow();
    $title = "{" . $currentDateMonth . " " . getTitleHour($sTime) . " - " . $currentDateMonth . " " . getTitleHour($eTime) . "} " . $employeeData->name . ": ". $taskData->name;

    return json_encode(array(
        'uuid' => $uuid,
        'title' => $title,
        'start' => render_date($slipStartDate, "", "Y-m-d H:i:s"),
        'end' => render_date($slipEndDate, "", "Y-m-d H:i:s"),
    ));
}

public function downloadPdf(){

    $mpdf = new \App\Libraries\Generate_Pdf();
    $pdf = $mpdf->load_portait();
    $employeeData = $this->db->table('employees')->select('*')->getWhere(array('id' => 4))->getFirstRow();
    // generate the PDF!
    $viewArray["timeslips"] = $this->getPdfData();
    $viewArray["employeeData"] = $employeeData;


    // generate the dynamically PDF!
    $uuid_business_id = $this->session->get('uuid_business');

    //look for associated override temaplte in DB
    $bodytemplate = $this->db->table('templates')->where("uuid_business_id", $uuid_business_id)->where("code", "Timeslip_PDF_Design_Template_Body")->get()->getRowArray();
    if( $bodytemplate ){

        file_put_contents(APPPATH."Views/timeslips/dynamic_body.php", $bodytemplate["template_content"]);
        $html = view("timeslips/dynamic_body", $viewArray);

    }else{
        $html = view("timeslips/pdf_body", $viewArray);
    }

    $headertemplate = $this->db->table('templates')->where("uuid_business_id", $uuid_business_id)->where("code", "Timeslip_PDF_Design_Template_Header")->get()->getRowArray();
    
    if( $headertemplate ){

        file_put_contents(APPPATH."Views/timeslips/dynamic_header.php", $headertemplate["template_content"]);
        $headerData = view("timeslips/dynamic_header");

    }else{
        $headerData = view("timeslips/pdf_header");
    }

    

    $footertemplate = $this->db->table('templates')->where("uuid_business_id", $uuid_business_id)->where("code", "Timeslip_PDF_Design_Template_Footer")->get()->getRowArray();
    
    if( $footertemplate ){

        file_put_contents(APPPATH."Views/timeslips/dynamic_footer.php", $footertemplate["template_content"]);
        $footerdata = view("timeslips/dynamic_footer");

    }else{
        $footerdata = view("timeslips/pdf_footer");
    }

    // end section for generate the dynamically PDF!

        
    $pdf->SetHTMLHeader($headerData);
    $pdf->SetHTMLFooter($footerdata);
    
    $pdf->AddPage('', // L - landscape, P - portrait
    '', '', '', '', 10, // margin_left
    10, // margin right
    30, // margin top
    15, // margin bottom
    8, // margin header
    0, // margin footer
'', '', '', '', '', '', '', '', '', 'A4-L');
    $pdf->WriteHTML($html);
    $pdf->Output("timeslips.pdf", "D");
}
public function getPdfData(){
    $employee_id = $_POST["employee"];
    $requestMonth = $_POST["monthpicker"];
    $year = $_POST["yearpicker"];
    
    $builder = $this->db->table("timeslips");
    //var_dump($employee_id); die;
    $firstDayOfCurrentMonth = strtotime($this->firstDay($requestMonth,  $year)) ;
        
    $lastDayMonth = strtotime($this->lastday($requestMonth,  $year)); // hard-coded '01' for first day

    $builder->select("timeslips.*, tasks.name as tasks_name, employees.first_name as employee_first_name, employees.surname as employee_surname");
    $builder->join("tasks", "tasks.id = timeslips.task_name", "left");
    $builder->join("employees", "employees.id = timeslips.employee_name", "left");

    if($employee_id != "-1"){

        $builder->where("timeslips.employee_name", $employee_id);
    }

    $builder->where("timeslips.slip_start_date >=", $firstDayOfCurrentMonth);
    $builder->where("timeslips.slip_start_date <=", $lastDayMonth);


    $records = $builder->get()->getResultArray();
    //echo $this->db->getLastQuery(); die;
    //print_r($records ); die;
    return $records;
}


function lastday($month = '', $year = '') {
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



}