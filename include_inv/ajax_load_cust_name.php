<?php
include "../include_db/db.php";

	if(!isset($_POST['id']))
		return false;
	
	$id_post = intval($_POST['id']);
	$out_put = '';
	GLOBAL $tf_handle;
	
	$sql = mysqli_query($tf_handle,"SELECT * FROM `users` WHERE `user_id` = '$id_post' ");
	
	while($rows = mysqli_fetch_assoc($sql) ){
		$name = $rows['user_name'];
		$out_put .= '<b>إسم الشركة / العميل</br></b><input type="text" name="order_recive_name" id="order_recive_name" class="form-control input-sm"
	 value="'.$name.'" readonly />';
	}
	
	
	echo $out_put;
?>