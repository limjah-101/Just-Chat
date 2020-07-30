<?php
include "../init.php";
$helper = new Base_class;
$status = 1;

/**
 * FETCH ONLINE USERS ID'S
 */
if($helper->normal_query("SELECT id FROM users WHERE status = ?", [$status])){
    
    $users = $helper->count_rows();
    echo json_encode(["users" => $users]);
}