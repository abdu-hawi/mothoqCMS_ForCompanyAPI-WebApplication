<?php

$response = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['ord_id']) ){
		// stmt
		$id = $_POST['ord_id'];
		include '../include_db/db.php';
    
		$myData = array();
		$stmt = $tf_handle->prepare( "SELECT * FROM `tbl_order_system_item` WHERE `order_id` = ? ORDER BY `order_id` DESC");
		$stmt->bind_param('i',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData [] = $row ; 
		}
	 
		echo json_encode($myData, JSON_UNESCAPED_UNICODE);
		
        
    }else{
        $response['error'] = true;
        $response['msg'] = 'Check Arguments';
    }
}else{
    $response['error'] = true;
    $response['msg'] = 'Cannot connect to server';
}



echo json_encode($response);

/*
// stmt
		$id = ord_id;
		include '../include_db/db.php';
    
		$myData = array();
		$stmt = $tf_handle->prepare( "SELECT * FROM `tbl_order_system_item` WHERE `order_id` = ? ORDER BY `order_id` DESC");
		$stmt->bind_param('i',$id);
		$stmt->execute();
		$result = $stmt->get_result();
		while($row = $result->fetch_assoc() ){
			$myData [] = $row ; 
		}
	 
		echo json_encode($myData, JSON_UNESCAPED_UNICODE);
		
*/
?>