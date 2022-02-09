<?php 
namespace App\Controllers; 
use App\Controllers\Core\CommonController; 
use App\Models\Users_model;
use App\Models\Core\Common_model;


 
class Customers extends CommonController
{	
	
    function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();

	}

    public function getAdditionalData($id)
    {
     
        $model = new Common_model();
        $builder = $this->db->table("contacts");
        $builder->select("id as contact_id,first_name,surname,email as contact_email");
        $builder->where("client_id", $id);
        $data["contacts"]  = $builder->get()->getResultArray();
        return  $data;

    }

    public function update()
    {        
        $post = $this->request->getPost();
        $data["company_name"] = ["company_name"];
        $data["acc_no"] = ["acc_no"];
        $data["status"] = ["status"];
        $data["contact_firstname"] = ["contact_firstname"];
        $data["contact_lastname"] = ["contact_lastname"];
        $data["email"] = ["email"];
        $data["address1"] = ["address1"];
        $data["address2"] = ["address2"];
        $data["city"] = ["city"];
        $data["country"] = ["country"];
        $data["postal_code"] = ["postal_code"];
        $data["phone"] = ["phone"];
        $data["notes"] = ["notes"];
        $data["supplier"] = ["supplier"];
        $data["website"] = ["website"];

        $id= $post["id"];
		$response = $this->model->insertOrUpdate($id, $data);
		if(!$response){
			session()->setFlashdata('message', 'Something wrong!');
			session()->setFlashdata('alert-class', 'alert-danger');	
		}else{
            $i = 0;
            foreach($post["first_name"] as $firstName){

                $contact["first_name"] = $firstName;
                $contact["client_id"] = $id;
                $contact["surname"] = $post["surname"][$i];
                $contact["email"] = $post["contact_email"][$i];
                $contactId =  $post["contact_id"];
                $this->insertOrUpdate("contacts",$contactId, $contact);

                $i++;
            }
        }

        return redirect()->to('/'.$this->table);
    }
    

	public function insertOrUpdate($table, $id = null, $data = null)
	{
        unset($data["id"]);

        if(@$id>0){
            $query = $this->db->table($table);
            $query->where('id', $id);
            $query->update($data);
            if( $query){
                session()->setFlashdata('message', 'Data updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $id;
            }
        }else{
            $query = $this->db->table($table)->insert($data);
            echo $this->db->getlastQuery();
            if($query){
                session()->setFlashdata('message', 'Data updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->db->insertID();
            }

        }
	
		return false;
	}

}