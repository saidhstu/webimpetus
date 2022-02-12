<?php 

function pre($data){
    echo "<pre>";print_r($data);
}
function prd($data){
    echo "<pre>";print_r($data);die;
}
function render_date($time){

    $date = date("d M Y H:i:s", $time);

    return $date;
}
?>