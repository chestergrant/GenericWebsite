<?php

$db = new mysqli("localhost", "chegra", "pK2ZunQVbNTX9N5c", "incentivize_weightloss");
if ($db->connect_errno) {
    printf("Connect failed:\n");
    exit();
}


function niceArray($result){
 $user_arr = array();
 if($result){
     // Cycle through results
    while ($row = $result->fetch_assoc()){
        $user_arr[] = $row;
    }
    // Free result set
    $result->close();
   
 }
 return $user_arr;
}

function emptyStr($str){
    if(!isset($str)){
        return true;
    }
    if(trim($str) == ""){
        return true;
    }
    return false;
}
?>
