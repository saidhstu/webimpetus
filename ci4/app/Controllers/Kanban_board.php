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


        // echo "<pre>";
        // foreach ($data['tasks'] as $key => $value) {
        //     foreach($value as $record){
        //         print_r($record['id']);
        //     }
            
        //     // if(count($value)){
        //     //     print_r($value['id']);
        //     // }
            
        // }
        // exit;

        return view($viewPath, $data);
    }
}
