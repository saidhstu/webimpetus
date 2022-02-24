<?php 

function pre($data){
    echo "<pre>";print_r($data);
}
function prd($data){
    echo "<pre>";print_r($data);die;
}
function render_date($time, $type="input"){

    if(empty($time)){
        return "";
    }
    if( $type == "date_time"){

        $date = date("d M Y H:i:s", $time);
    }else if( $type == "input"){
        $date = date("m/d/Y", $time);

    }else{
        $date = date("d M Y", $time);

    }

    return $date;
}

function getCurrency($key){

    $key = $key-1;
    $list=["GBP", "USD", "EUR"];

    return $list[$key];
}
function getStatus($key){

    $key = $key-1;
    $list=["Active", "Completed"];

    return $list[$key];
}
?>