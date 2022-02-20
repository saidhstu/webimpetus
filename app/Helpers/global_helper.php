
<?php
function getAllBusiness(){
    $db = \Config\Database::connect();
    $builder = $db->table("businesses");
    $result = $builder->get()->getResultArray();
    return $result ;    
}
function getResultArray( $tableName, $where = array(), $returnArr = true){
    
    $db = \Config\Database::connect();
    $builder = $db->table($tableName);
    if($where){

        $query = $builder->getWhere( $where );
    }else{

        $query = $builder->get();
    }

    if($returnArr){
        $result = $query->getResultArray();
    }else{
        $result = $query->getResult();
    }

    return $result;    
}