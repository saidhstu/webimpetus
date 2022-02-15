
<?php
function getAllBusiness(){
    $db = \Config\Database::connect();
    $builder = $db->table("businesses");
    $result = $builder->get()->getResultArray();
    return $result ;    
}