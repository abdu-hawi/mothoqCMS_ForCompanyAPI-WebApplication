<?php

$user_id =  $_POST['x'];

require_once("../include_db/db.php");
$stmt = mysqli_query( $tf_handle ,"SELECT * FROM `isalert` WHERE `user_id` = $user_id AND `is_alert` = 1");
$total_rows = mysqli_num_rows($stmt);
if($total_rows > 0) echo $total_rows;

?>