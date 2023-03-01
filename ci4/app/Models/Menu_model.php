<?php namespace App\Models;
use CodeIgniter\Model;
 
class Menu_model extends Model
{
    protected $table = 'menu';
     
    public function getRows($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
	
	public function getWherein($id = [])
    {
        if(!empty($id)){
            return $this->whereIn('id', $id)->findAll();
        }else{
            return [];
        }   
    }

    public function updateData($id = null, $data = null)
	{
		$query = $this->db->table($this->table)->update($data, array('id' => $id));
		return $query;
	}

    public function saveData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $this->db->insertID();
    }

    public function saveMenuCat($id,$data)
    {
        $this->db->table('menu_category')->delete(array('uuid_menu' => $id));
        foreach($data as $key=>$val){
            $arr = [];
            $arr['uuid_category'] = $val;
            $arr['uuid_menu'] = $id;
            $query = $this->db->table('menu_category')->insert($arr);
        }
        return true;
    }

    public function CatByMenuId($mid = "")
    {

        $builder = $this->db->table('categories');
        $builder->select("categories.ID");
        $builder->join('menu_category', 'menu_category.uuid_category = categories.ID', 'left');
        $builder->where("menu_category.uuid_menu",  $mid);

        return $builder->get()->getResultArray();

		// $whereCond = ['menu_category.uuid_menu'=>$mid];			
        // $this->join('categories', 'categories.ID = menu_category.uuid_category', 'LEFT');			
        // $this->select('categories.*');
        // return $this->where($whereCond)->get()->getResult();
       
    }
	
	/* public function saveData($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
	
	public function deleteData($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
	
	public function updateData($id = null, $data = null)
	{
		$query = $this->db->table($this->table)->update($data, array('id' => $id));
		return $query;
	}
	
	public function updateMeta($field = null, $data = [])
	{
		//echo '<pre>';print_r($data); die;
		if(!is_null($field) && !empty($data)){			
			$count = $this->db->table($this->table)->getWhere(['meta_key' => $field])->getNumRows();
			if(empty($count)){
				$data['meta_key'] = $field;
				$query = $this->db->table($this->table)->insert($data);
				return $query;
			}else {
				$query = $this->db->table($this->table)->update($data, array('meta_key' => $field));
				return $query;
			}
		}else return;
	} */
	
	
}