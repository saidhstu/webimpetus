
<?php
function getAllBusiness(){

    $db = \Config\Database::connect();
    $builder = $db->table("user_business");
    $userBusiness = $builder->where("user_id", $_SESSION["uuid"])->get()->getResultArray();
    $builder = $db->table("businesses");
    if($userBusiness){
        $allBusinesssId = json_decode(@$userBusiness[0]["user_business_id"]);
        if($allBusinesssId){
            $result = $builder->whereIn("uuid", $allBusinesssId)->get()->getResultArray();
        }else{
            $result = $builder->where("default_business", 1)->get()->getResultArray();   
        }
    }else{
        
        $result = $builder->where("default_business", 1)->get()->getResultArray();
    }


    return $result ;    
}

function getResultArray( $tableName, $where = array(), $returnArr = true){
    
    $db = \Config\Database::connect();
    $builder = $db->table($tableName);

    $query = $builder->where( "uuid_business_id", session('uuid_business') );
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
function getRowArray( $tableName, $where = array(), $returnArr = false){

    $db = \Config\Database::connect();
    $builder = $db->table($tableName);
    if($where){

        $query = $builder->getWhere( $where );
    }else{

        $query = $builder->get();
    }

    if($returnArr){
        $result = $query->getRowArray();
    }else{
        $result = $query->getRow();
    }

    return $result;    
}
function getUserInfo(){

    $db = \Config\Database::connect();
    $builder = $db->table("users");
    $query = $builder->getWhere( ["id" => $_SESSION['uuid']] );
    $result = $query->getRow();

    return $result;    
}
function findMaxFieldValue($tableName, $field){

    $db = \Config\Database::connect();
    $builder = $db->table($tableName);
    $query = $builder->selectMax($field );
    $order_number = $query->get()->getRowArray()[$field];

    return $order_number;    
}

function readableFieldName($fieldName)
{
    return implode(' ', array_map('ucfirst', explode('_', $fieldName)));
}

function getWithOutUuidResultArray( $tableName, $where = array(), $returnArr = true, $order_by = "", $direction="DESC"){
    
    $db = \Config\Database::connect();
    $builder = $db->table($tableName);

    if( strlen($order_by) > 0){
        $query = $builder->orderBy($order_by, $direction);
    }
    
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

function totalRows( $tableName, $where = array(), $returnArr = true){
    
    $db = \Config\Database::connect();
   

    $buseness = array( "uuid_business_id" =>  session('uuid_business'));
    $where = array_merge($buseness, $where);
 
    
    $builder = $db->table($tableName);
    $builder->select("id");
    $query = $builder->getWhere( $where );

    $res = $query->getResult();

    // echo $db->getLastQuery();

    return count($res);
}