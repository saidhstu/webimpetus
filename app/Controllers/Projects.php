<?php

namespace App\Controllers;

use App\Controllers\Core\CommonController;
use App\Models\Core\Common_model;

class Projects extends CommonController
{
    public function __construct()
    {
        parent::__construct();   
        $this->model = new Common_model();
    }

    public function index()
    {
        $data['projects'] = $this->model->getRows();
		$data['tableName'] = "projects";
        $data['rawTblName'] = "projects";
		$menucode = $this->getMenuCode("/projects");
		$this->session->set("menucode", $menucode);
		return view('projects/list',$data);
    }
}
