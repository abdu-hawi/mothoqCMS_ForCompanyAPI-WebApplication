<?php

$response = array();

if(isset($_POST["dd"])){
    $id = $_POST["dd"] ;

    include '../include_db/db.php';
    //AND `invoice_status` = 1 AND `inTrash` = 0
    $myData = array();
    $stmt = $tf_handle->prepare( "SELECT * FROM `product`
    WHERE `user_id` = ?  ORDER BY `date_invoice` DESC");
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc() ){
        $myData [] = $row ; 
    }
 
    echo json_encode($myData, JSON_UNESCAPED_UNICODE);
}
else{
    $response['error'] = true;
    $response['com_name'] = 'Cannot connect to server';
    echo json_encode($response);
}

/*

    $id = 7 ;

    include '../include_db/db.php';
    
    $myData = array();
    $stmt = $tf_handle->prepare( "SELECT * FROM `product`
    WHERE `user_id` = ?  ORDER BY `date_invoice` DESC");
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc() ){
        $myData [] = $row ; 
    }
 
    echo json_encode($myData, JSON_UNESCAPED_UNICODE);
 */   
?>