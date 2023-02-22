<?php

namespace App\Controllers;

use App\Controllers\Core\CommonController;
use App\Models\Tasks_model;
use App\Models\Users_model;
use App\Models\Email_model;
use App\Models\Sprints_model;

class Tasks extends CommonController
{

    function __construct()
    {
        parent::__construct();

        $this->Tasks_model = new Tasks_model();
        $this->Users_model = new Users_model();
        $this->Email_model = new Email_model();
        $this->sprintModel = new Sprints_model();
    }

    public function index()
    {
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;

        $taskStatusList = $this->Tasks_model->allTaskStatus();

        $blank_item = array("key" => "", "value" => "--Choose Status--");
        array_unshift($taskStatusList, $blank_item);
        $backlog_item = array("key" => "backlog", "value" => "Backlog");
        array_push($taskStatusList, $backlog_item);

        $data['taskStatusList'] = $taskStatusList;
        $status = $_GET['status'] ?? "";



        // $condition = array();
        // foreach ($statusList as $status) {

        //     if ($status === "backlog") {

        //         //$condition = []

        //     } else {
        //         $condition = [$this->table . ".status" => $status];
        //         continue;
        //         // if ($sprint) {
        //         //     $data['tasks'][$category] = $this->taskModel->getTaskList(['category' => $category, 'sprint_id' => $sprint]);
        //         // } else {
        //         //     $data['tasks'][$category] = $this->taskModel->getTaskList(['category' => $category]);
        //         // }
        //     }
        // }
        // print_r($condition);
        $condition = array();

        if ($status === "") {
        } elseif ($status === "backlog") {
            $current_sprint = $this->sprintModel->getCurrentSprint();
            $next_sprint = $this->sprintModel->getNextSprint($current_sprint);

            $sprintCondition = $current_sprint > 0 ? "sprint_id < $current_sprint AND" : "sprint_id < $next_sprint AND";
            $condition = "(sprint_id = null OR (" . $sprintCondition . " tasks.status != 'done'))";
        } else {
            $condition = [$this->table . ".status" => $status];
        }


        $data[$this->table] = $this->Tasks_model->getTaskList($condition);


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
