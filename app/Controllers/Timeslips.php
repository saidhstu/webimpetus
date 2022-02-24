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
        $data = array(
            'task_name' => $this->request->getPost('task_name'),
            'week_no' => $this->request->getPost('week_no'),
            'employee_name' => $this->request->getPost('employee_name'),
            'slip_start_date' => strtotime( $this->request->getPost('slip_start_date') ),
            'slip_timer_started' => $this->request->getPost('slip_timer_started'),
            'slip_end_date' => strtotime( $this->request->getPost('slip_end_date') ),
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
}
