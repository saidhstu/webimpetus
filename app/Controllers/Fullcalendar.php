<?php

namespace App\Controllers;

use App\Controllers\Core\CommonController;
use App\Models\TimeslipsModel;

class Fullcalendar extends CommonController
{
    protected $timeSlipsModel;

    public function __construct()
    {
        parent::__construct();
        $this->timeSlipsModel = new TimeslipsModel();
    }

    public function index()
    {
        $table = 'timeslips';
        $data['columns'] = $this->db->getFieldNames($table);
		$data['fields'] = array_diff($data['columns'], $this->notAllowedFields);
        $data[$table] = $this->timeSlipsModel->getRows();
        foreach ($data[$table] as &$record) {
            $record['slip_start_date'] = render_date($record['slip_start_date']);
            $record['slip_end_date'] = render_date($record['slip_end_date']);
        }
        $data['tableName'] = $table;
        $data["tasks"] = $this->timeSlipsModel->getTaskData();
		$data["employees"] = $this->timeSlipsModel->getEmployeesData();
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;
        $data['identifierKey'] = 'uuid';

		$viewPath = "common/list";
		if (file_exists( APPPATH . 'Views/' . $this->table."/list.php")) {
			$viewPath = $this->table."/list";
		}

        return view($viewPath, $data);
    }
}
