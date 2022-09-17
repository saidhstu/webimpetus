<?php

namespace App\Controllers;

use App\Controllers\Core\CommonController;
use App\Models\Projects_model;
use App\Models\Core\Common_model;
use App\Models\Blocks_model;

class Templates extends CommonController
{

    function __construct()
    {
        parent::__construct();
        $this->blocks_model = new Blocks_model();
    }

    public function edit($id = 0)
    {
        $data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data["users"] = $this->model->getUser();
        //echo "<pre>";
        $data["blocks_list"] = $this->blocks_model->where([ "uuid_business_id" => $this->businessUuid])->findAll();
        //print_r($data);
        //exit;
        $data[$this->rawTblName] = $this->model->getRows($id)->getRow();
        // if there any special cause we can overried this function and pass data to add or edit view
        $data['additional_data'] = $this->getAdditionalData($id);

        echo view($this->table . "/edit", $data);
    }
}
