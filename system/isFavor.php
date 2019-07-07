<?php

if(!isset($_POST['fav_id']) || !isset($_POST['fav_stat'])) die ('NOT Correct');

$fav_id = $_POST['fav_id'];
$fav_stat = $_POST['fav_stat']; 
include '../include_db/db.php';
$stmt_fav = mysqli_query($tf_handle,"UPDATE `tbl_order_system` SET `isFav` = '$fav_stat' WHERE `order_id` = '$fav_id'");
if($stmt_fav)
echo 'ok';
////header('location:main.php');


?>