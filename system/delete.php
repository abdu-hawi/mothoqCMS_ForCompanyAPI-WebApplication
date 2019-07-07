<?php

if(isset($_POST["id"]) ){
	$id_del = $_POST["id"];
    include '../include_db/db.php';
	$stmt_del = mysqli_query($tf_handle,"DELETE FROM `tbl_order_system` WHERE `order_id` = '$id_del'");
	if($stmt_del)
		mysqli_query($tf_handle,"DELETE FROM `tbl_order_system_item` WHERE `order_id` = '$id_del'");
	//header('location:main.php');
    echo 'ok';
}
?>