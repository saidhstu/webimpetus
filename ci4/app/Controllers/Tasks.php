<?php

namespace App\Controllers;

use App\Controllers\Core\CommonController;
use App\Models\Tasks_model;
use App\Models\Users_model;
use App\Models\Email_model;

class Tasks extends CommonController
{

    function __construct()
    {
        parent::__construct();

        $this->Tasks_model = new Tasks_model();
        $this->Users_model = new Users_model();
        $this->Email_model = new Email_model();
    }
    public function index()
    {

        $data[$this->table] = $this->Tasks_model->getTaskList();
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;

        echo view($this->table . "/list", $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');

        $data = $this->request->getPost();

        $data['start_date'] = strtotime($data['start_date']);
        $data['end_date'] = strtotime($data['end_date']);

        if (empty($id)) {
            $data['task_id'] = findMaxFieldValue($this->table, "task_id");

            if (empty($data['task_id'])) {
                $data['task_id'] = 1001;
            } else {
                $data['task_id'] += 1;
            }
        }

        $response = $this->model->insertOrUpdate($id, $data);
        if (!$response) {
            session()->setFlashdata('message', 'Something wrong!');
            session()->setFlashdata('alert-class', 'alert-danger');
        }

        // Send an email when assign task to user
        $user = $this->Users_model->getUser($data['assigned_to'])->getRow();
        if (isset($user->email) && !empty($user->email)) {
            $from_email = "info@odincm.com";
            $from_name = "Web Impetus";
            $message = "<p><b>Hi " . $user->name . ",</b></p>";
            $message .= "<p>A task has been assigned to you on Webimpetus. Please login to system for more details.</p>";
            $message .= "<p><b>Thanks, Webimpetus Team</b></p>";
            $subject = "Webimpetus Task Update";
            $is_send = $this->Email_model->send_mail($user->email, $from_name, $from_email, $message, $subject);
        }

        return redirect()->to('/' . $this->table);
    }
}
