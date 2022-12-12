<?php

namespace App\Controllers;

use App\Controllers\Core\CommonController;
use App\Models\Tasks_model;

class Kanban_board extends CommonController
{
    protected $timeSlipsModel;

    public function __construct()
    {
        parent::__construct();
        $this->taskModel = new Tasks_model();
    }

    /**
     * [POST] Display kanban board based on task category
     */
    public function index()
    {
        $table = 'tasks';
        $data['tableName'] = $table;

        $viewPath = "common/list";
        if (file_exists(APPPATH . 'Views/' . $this->table . "/list.php")) {
            $viewPath = $this->table . "/list";
        }

        $data['tasks'] = [
            'todo' => $this->taskModel->getTaskList(['category' => 'todo']),
            'in-progress' => $this->taskModel->getTaskList(['category' => 'in-progress']),
            'review' => $this->taskModel->getTaskList(['category' => 'review']),
            'done' => $this->taskModel->getTaskList(['category' => 'done']),
        ];
        return view($viewPath, $data);
    }

    /**
     * [POST] Update task category
     */
    public function update_task()
    {
        $task_id = $this->request->getPost('task_id');
        $data_category = $this->request->getPost('data_category');
        $this->taskModel->updateData($task_id, ['category' => $data_category]);
        echo json_encode(array("status" => true, "message" => "Successfully Updated!"));
    }
}
