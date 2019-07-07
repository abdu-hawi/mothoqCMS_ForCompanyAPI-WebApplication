<?php
require_once ('insert_db.php');

$response = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if( isset($_POST['name']) and isset($_POST['password'])  ){
        $result = userLogin($_POST['name'] , $_POST['password'] );
        if($result){
            $row = get_email_by_name($_POST['name']);
            $response['error'] = false;
            $response['id'] = $row['user_id'];
            $response['name'] = $row['user_name'];
            $response['email'] = $row['user_email'];
        }else{
            $response['error'] = true;
            $response['msg'] = 'name or pass is not correct';
        }
    }else{
        $response['error'] = true;
        $response['msg'] = 'All filed required';
    }
}else{
    $response['error'] = true;
    $response['msg'] = 'Cannot connect to server';
}

echo json_encode($response);

?>