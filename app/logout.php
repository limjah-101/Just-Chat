<?php
include "../init.php";

$helper = new Base_class;
$user_id = $_SESSION["user_ID"];
$stmt = $helper->normal_query("UPDATE users SET status = 0 WHERE id = ?", [$user_id]);
if ($stmt){
    session_destroy();
    header("Location: ../sign-in");
}