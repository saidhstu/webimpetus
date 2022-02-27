
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

function getWithOutUuidResultArray( $tableName, $where = array(), $returnArr = true){
    
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