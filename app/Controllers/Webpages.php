<?php 
namespace App\Controllers;
use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\Content_model;
use App\Models\Users_model;
use App\Controllers\Core\CommonController; 
ini_set('display_errors', 1);

 
class Webpages extends CommonController
{	
	public function __construct()
	{
		parent::__construct();
		$this->content_model = new Content_model();
		$this->user_model = new Users_model();
	}
    public function index()
    {        

		$data[$this->table] = $this->content_model->where(['type' => 1, "uuid_business_id" => $this->businessUuid])->findAll();
		$data['tableName'] = $this->table;
        $data['rawTblName'] = $this->rawTblName;
        $data['is_add_permission'] = 1;

        echo view($this->table."/list",$data);
    }
	

	public function edit($id = 0)
	{
		$data['tableName'] = $this->table;
		$data['rawTblName'] = $this->rawTblName;
		$data['webpage'] = $this->content_model->getRows($id)->getRow();
		$data['users'] = $this->user_model->getUser();
		if( $id > 0 ){

			$data['images'] = $this->model->getDataWhere("webpage_images", $id, "webpage_id");
		}else{
			$data['images'] = [];
		}

		echo view($this->table."/edit", $data);
	}
	
	
    public function update()
    {        
        $id = $this->request->getPost('id');
		$data = array(
			'title'  => $this->request->getPost('title'),				
			'sub_title' => $this->request->getPost('sub_title'),
			'content' => $this->request->getPost('content'),
			'code' => $this->request->getPost('code')?$this->content_model->format_uri($this->request->getPost('code'),'-',$id):$this->content_model->format_uri($this->request->getPost('title'),'-',$id),
			'meta_keywords' => $this->request->getPost('meta_keywords'),
			'meta_title' => $this->request->getPost('meta_title'),
			'meta_description' => $this->request->getPost('meta_description'),
			'status' => $this->request->getPost('status'),
			'publish_date' => ($this->request->getPost('publish_date')?strtotime($this->request->getPost('publish_date')):strtotime(date('Y-m-d H:i:s'))),
			//'image_logo' => $filepath
		);

		$files = $this->request->getPost("file");

		if(!empty($id)){
			
			$row = $this->content_model->getRows($id)->getRow();
	 
			$filearr = ($row->custom_assets!="")?json_decode($row->custom_assets):[];
			$count = !empty($filearr)?count($filearr):0;
			

			if(is_array($files)){
				foreach($files as $key => $filePath) {	

					$blog_images = [];
					$blog_images['uuid_business_id'] =  session('uuid_business');
					$blog_images['image'] = $filePath;				
					$blog_images['webpage_id'] = $id;

					$this->content_model->saveDataInTable($blog_images, "webpage_images"); 						
				}
			}
			

			$this->content_model->updateData($id, $data);
			
			session()->setFlashdata('message', 'Data updated Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}else {

			$id = $this->content_model->saveData($data);

			if(is_array($files)){
				foreach($files as $key => $filePath) {	

					$blog_images = [];
					$blog_images['uuid_business_id'] =  session('uuid_business');
					$blog_images['image'] = $filePath;				
					$blog_images['webpage_id'] = $id;

					$this->content_model->saveDataInTable($blog_images, "webpage_images"); 						
				}
			}
				
			
			session()->setFlashdata('message', 'Data entered Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
		}

		if( $id > 0){
			$i = 0;
			$post = $this->request->getPost();
            foreach($post["blocks_code"] as $code){

                $blocks["code"] = $code;
                $blocks["webpages_id"] = $id;
                $blocks["text"] = $post["blocks_text"][$i];
                $blocks["title"] = $post["blocks_title"][$i];
                $blocks["uuid_business_id"] = session('uuid_business');
                $blocks_id =  @$post["blocks_id"][$i];
                if(strlen(trim($code)) > 0 || strlen(trim($blocks["text"])>0) || strlen(trim($blocks["title"])>0)){
                    $this->insertOrUpdate("blocks_list",$blocks_id, $blocks);
                }

				$i++;
            }
		}
        return redirect()->to('/'.$this->table);
    }


	public function insertOrUpdate($table, $id = null, $data = null)
	{
        unset($data["id"]);

        if(@$id>0){
           
            $builder = $this->db->table($table);
            $builder->where('id', $id);
            $result = $builder->update($data);

            if( $result){
                session()->setFlashdata('message', 'Data updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $id;
            }
        }else{
            $query = $this->db->table($table)->insert($data);
            if($query){
                session()->setFlashdata('message', 'Data updated Successfully!');
                session()->setFlashdata('alert-class', 'alert-success');
                return $this->db->insertID();
            }

        }
	
		return false;
	}

	public function rmimg($id, $rowId)
	{
		if(!empty($id)){

			$this->model->deleteTableData("webpage_images", $id);
			session()->setFlashdata('message', 'Image deleted Successfully!');
			session()->setFlashdata('alert-class', 'alert-success');
			
		}
		return redirect()->to('//'.$this->table.'/edit/'.$rowId);
		
	}

	public function deleteBlocks(){

        $blocks_id = $this->request->getPost("blocks_id");

        $res = $this->model->deleteTableData("blocks_list", $blocks_id);
       
        return $res;
    }


	
}