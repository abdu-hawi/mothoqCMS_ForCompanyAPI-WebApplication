<?php

if(isset($_POST["id"]) ){
	$id_del = $_POST["id"];
    include '../include_db/db.php';
	$stmt_del = mysqli_query($tf_handle,"UPDATE `tbl_order_system` SET `inTrash` = 1 WHERE `order_id` = '$id_del'");
	if($stmt_del)
	//echo json_encode('ok');
    echo 'ok';
}
?>