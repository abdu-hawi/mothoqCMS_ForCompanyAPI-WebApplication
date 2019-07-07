<?php

if(!isset($_POST['str_id']) || !isset($_POST['str_stat'])) die ('NOT Correct');

$str_id = $_POST['str_id'];
$str_stat = $_POST['str_stat']; 
include '../include_db/db.php';
$stmt_str = mysqli_query($tf_handle,"UPDATE `tbl_order_system` SET `isStr` = '$str_stat' WHERE `order_id` = '$str_id'");
if($stmt_str)
echo 'ok';
////header('location:main.php');


?>