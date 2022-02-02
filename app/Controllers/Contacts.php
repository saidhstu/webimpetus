<?php 
namespace App\Controllers; 
use App\Controllers\Core\CommonController; 
use App\Models\Users_model;
use App\Models\Core\Common_model;
 
class Contacts extends CommonController
{	
	
    function __construct()
    {
        parent::__construct();

	}
    
    public function getAdditionalData($id)
    {
        $model = new Common_model();
        $data["customers"] = $model->getAllDataFromTable("customers");

        return  $data;

    }
}